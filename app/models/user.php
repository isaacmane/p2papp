<?php

Class User{

	function login($POST)
	{
		$DB = new Database();
		
		$POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		$flag = 0;

		$data = [
		    'email' => trim($POST['e'])
		];

		$password = $POST['pw'];

		//Validate email
        if (empty($data['email'])) {            
            $error['emailError'] = '* Email address';
            $flag = $flag + 1;
        }

        //Validate empty password
        if(empty($password)){
         	$error['passwordError'] = '* Password';
         	$flag = $flag + 1;
        }

        if($flag > 0){
        	echo '<b>Please enter</b><br>';
        	foreach ($error as $key => $value) {
        		echo $value."<br>";
        	}
        	unset($error); 
        	$flag = 0;        
        }else{
			$query = "select * from users where email = :email limit 1";
			$data = $DB->read($query, $data);
			//show($data);
			if (is_array($data)) {
				// The hashed password retrieved from database
				$hash = $data[0]->password;

				// Verify the hash against the password entered
				$verify = password_verify($password, $hash);
				if($verify)
				{
					//logged in
					$_SESSION['user_id'] = $data[0]->id;
					$_SESSION['user_name'] = $data[0]->username;
					$_SESSION['user_url'] = $data[0]->url_address;

					//print_r($_SESSION);
	    			echo "successfully";

				}else{
					$_SESSION['error'] = "<b>Please check it out</b><br>";
					$_SESSION['error'] .= "Wrong username or/and password<br>";
					$_SESSION['error'] .= "Try again or <a href='".ROOT."forget'>Forget Password</a>";	
					echo $_SESSION['error'];
					unset($_SESSION['error']);
				}
			}else{
				$verify = false;
				$_SESSION['error'] = "<b>This user has not been registered</b><br>";
				$_SESSION['error'] .= "Try with a different user or <br>create a new account at <br><a href='".ROOT."signup'>Create an account</a>";	
				echo $_SESSION['error'];
				unset($_SESSION['error']);
			}

        }
	}

	function forget($POST)
	{
		$DB = new Database();
		
		$POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		$flag = 0;

		//print_r($POST);
		$data = [
		    'email' => trim($POST['e']),
		];

		//print_r($data);
		//Validate email
        if (empty($data['email'])) {            
            $error['emailError'] = 'Email address';
            $flag = $flag + 1;
        }

        if($flag > 0){
        	echo '<b>Please enter</b><br>';
        	foreach ($error as $key => $value) {
        		echo $value."<br>";
        	}
        	unset($error); 
        	$flag = 0;        
        }else{
			$query = "select * from users where email = :email limit 1";

			$datadb = $DB->read($query, $data);
			
			//echo $userid;
			if(is_array($datadb))
			{
				$userid = $datadb[0]->id;
				$msg = "Recover";
				$headers = "From: admin@landlist.com";
				$subject = "Recover Password";
				//mail($data['email'],"Recover Password",$msg,$headers);
				if (mail($data['email'], $subject, $msg, $headers))
				{	
					$rnd = rand(23564553, 27564553);
					$validation_rec_pwd = $rnd;
					$query = "update users set validation_rec_pwd = '$validation_rec_pwd' where id = '$userid'";
					$dataw = $DB->write($query, $data);

					include('mjet.php');	
					$ret = sendMsgMj(ROOT, $data['email'], $rnd);
					//echo $ret['Messages'][0]['Status'];				
					//echo "Message accepted ".$data['email']."<br>";
				}
				else
				{
				    echo "Error: Message not accepted";
				}
			}
			echo "If a matching account was found an email was sent to <b>".$data['email']."</b> to allow you to reset your password.<br><a href='login'>Login</a>";
        }
    }

    function resetpwd($POST){
    	$DB = new Database();

    	$POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		$flag = 0;

		$data = [
		    'email' => trim($POST['e'])
		];

		$password1 = trim($POST['p']);
		$password2 = trim($POST['pr']);

		//Validate email
        if (empty($data['email'])) {            
            $error['emailError'] = '* Email address';
            $flag = $flag + 1;
        }

        //Validate empty password
        if(empty($password1)){
         	$error['passwordError'] = '* Password';
         	$flag = $flag + 1;
        }

        if(empty($password2)){
         	$error['passwordError2'] = '* Password';
         	$flag = $flag + 1;
        }

        if (strcmp($password1, $password2) != 0) {
        	$error['difpwd'] = '* Passwords are different';
        	$flag = $flag + 1;
        }

        $query = "select * from users where email = :email limit 1";
        $datadb = $DB->read($query, $data);

        if(is_array($datadb)){
        	$userid = $datadb[0]->id;

        	$validator1 = trim($POST['v']);
        	$validator2 = trim($datadb[0]->validation_rec_pwd);
        	$result = strcmp($validator1, $validator2);

			if ($result != 0) {
	  			$error['difvalid'] = "* You will have to request change password again. Token is not valid anymore.<br><a href='forget'>Forget Password</a>";
        		$flag = $flag + 1;
			}
        }

        if($flag > 0){
        	echo '<b>Please enter</b><br>';
        	foreach ($error as $key => $value) {
        		echo $value."<br>";
        	}
        	unset($error); 
        	$flag = 0;        
        }else{
        	
			$hash = password_hash($password1, PASSWORD_DEFAULT);
			//echo $hash;
			$data['password'] = $hash;

			$query = "update users set password = '$hash' where id = '$userid'";
			$data = $DB->write($query, $data);
			echo "successfully";
        }
    }
        
	function show($q){
		//echo "<pre>";
		print_r($q);
		//echo "<pre>";
	}

	function signup($POST)
	{
		$DB = new Database();
		unset($_SESSION);
		$POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		$data = [
                'username' => trim($POST['u']),
                'email' => trim($POST['e']),
                'password' => trim($POST['pw']),
                'phone' => trim($POST['ph'])
            ];

        //print_r($data);

        $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
        
        //Validate username on letters/numbers
		if (empty($data['username'])) {
        	$_SESSION['usernameError'] = '* Name';
        }

        //Validate email
        if (empty($data['email'])) {
            $_SESSION['emailError'] = '* Email address';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['emailError'] = 'The correct email format';
        } elseif (strcmp($data['email'], $POST['e2']) !== 0) {
        	$_SESSION['emailError'] = '* The same email on both fields';
        } else {
            //Check if email exists.
            $query = "select * from users where email = :email limit 1";
            $arr['email'] = $data['email'];
			$datares = $DB->read($query, $arr);	

			if(!empty($datares[0]->email)){
				$_SESSION['emailError'] = "* Email is already taken.<br> Try again with a different email or <a href='".ROOT."login'>Login</a> or <a href='".ROOT."forget'>Forget Password</a>";	
				//$flag = 1;			
			}			
        }        

        //Validate phone number 10 digits 
        $justNums = preg_replace("/[^0-9]/", '', $data['phone']);
        $totnum = strlen($justNums);
        if(empty($data['phone'])){
          	$_SESSION['phoneError'] = '* Phone number';
        }elseif($totnum <> 10) {
        	$_SESSION['phoneError'] = 'A valid phone number';
        }else{
        	$data['phone'] = $justNums;
        }

        // Validate password on length, numeric values,
        if(empty($data['password'])){
          $_SESSION['passwordError'] = '* Password';
        } elseif(strlen($data['password']) < 6){
          $_SESSION['passwordError'] = '* Password must be at least 8 characters';
        } elseif (preg_match($passwordValidation, $data['password'])) {
          $_SESSION['passwordError'] = '* Password must be have at least one numeric value and one string';
        } 

        //Terms
        if($POST['t']==0){
        	$_SESSION['termsError'] = '* Accept the terms and conditions';
        	//$flag = 1;
        }

        if (isset($flag)) {
        	if ($flag == 1) {
	        	unset($_SESSION['usernameError']);
	        	unset($_SESSION['emailError']);
	        	unset($_SESSION['passwordError']);
	        	unset($_SESSION['phoneError']);
	        	unset($_SESSION['termsError']);
	        	$flag = 0;
        	}
        }

        //Print error list
        if (isset($_SESSION)) {
        	echo '<b>Please enter</b><br>';
        	foreach ($_SESSION as $key => $value) {
        		echo $value."<br>";
        	}
        }else{
        	$data['url_address'] = get_random_string_max(60);
        	$data['date'] = date("Y-m-d H:i:s");
		  	$rnd = rand(43564553, 47564553);
		  	$data['validation_account1'] = $rnd;
			// The hash of the password that
			// can be stored in the database
			$hash = password_hash($data['password'], PASSWORD_DEFAULT);
			$data['password'] = $hash;

			$query = "insert into users(url_address,username,password,email,phone,date,validation_account1) values (:url_address,:username,:password,:email,:phone,:date,:validation_account1)";

			$datares = $DB->write($query, $data);
			echo "Successfully registered. <br>Please Confirm Registration at Your Email.";
			include('mjet.php');	
			
			$ret = sendMsgConfirm(ROOT, $data['email'], $rnd);
        }    
        
	}

	function validateaccount($p){
		$DB = new Database();
		$rawdata = explode("$", $p);
		$validatecode = $rawdata[1];
		$email = trim($rawdata[0]);
		$data = [
                'email' => $email
            ];
		$query = "select * from users where email = :email limit 1";
        $datadb = $DB->read($query, $data);
        if(is_array($datadb))
		{
			if ($datadb[0]->validation_account1 == $validatecode) {
				$datavalidate = [
					'email' => $email,
		            'validation_account2' => $validatecode		            
		        ];

				$query = "update users set validation_account2 = :validation_account2 where email = :email";
				//echo $query;
				$datares = $DB->write($query, $datavalidate);
				return TRUE;
			}
		}
		return FALSE;
	} 

	function check_logged_in()
	{
		$DB = new Database();
		if(isset($_SESSION["user_url"]))
		{
			$arr['user_url'] = $_SESSION["user_url"];
			$query = "select * from users where url_address = :user_url limit 1";
			
			$data = $DB->read($query, $arr);	
			if(is_array($data))
			{
				//show($data);
				//logged in
				$_SESSION['user_id'] = $data[0]->id;
				$_SESSION['user_name'] = $data[0]->username;
				$_SESSION['user_url'] = $data[0]->url_address;
				$_SESSION['email'] = $data[0]->email;
				$_SESSION['phone'] = $data[0]->phone;

				return true;
			}
		}
		return false;		
	}

	function saveprofile($POST)
	{
		$DB = new Database();
		$origemail = $_SESSION['email'];
		//unset($_SESSION);
		$POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		//show($POST);
		$data = [
                'email' => trim($POST['e'])
            ];
        //show($data); 

		$query = "select * from users where email = :email limit 1";
		//echo $query;
        $datadb = $DB->read($query, $data);
        
		if(is_array($datadb))
		{
			if ($data['email'] == $origemail) {
				$this->savedataprofile($POST);
			}else{
				if($datadb[0]->email != $_SESSION['email']){
					echo "<div class='alert alert-warning'><label class='col-sm-10 col-form-label'>* Email belongs to another profile. Try again with a different email.</label></div>";	
				}
			}
		
		}else{
			$validatecode = rand(93564553, 99999999);
			$datavalidate = [
					'email' => $origemail,
		            'validation_account2' => $validatecode		            
		        ];
			$query = "update users set validation_account2 = :validation_account2 where email = :email";
			$datares = $DB->write($query, $datavalidate);
			include('mjet.php');	
			$ret = changeEmailAccount(ROOT, $data['email'], $validatecode);		
			echo "<div class='alert alert-warning'><label class='col-sm-10 col-form-label'>Check this email (".$data['email']."). Copy and paste the Validation Code to complete the change.</label></div><br>";
			echo "<input type='text' class='form-control' id='validatecd' name='validatecd' value=''>";
			echo "<button type='button' class='btn btn-primary' onclick='vcod()'>Validate Code</button>";			
		}

	}

	function savedataprofile($POST)
	{
		$DB = new Database();
		//show($POST);
		$origemail = $_SESSION['email'];
		//unset($_SESSION);
		$POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$datavalidate = [
			'emailq' => $origemail,
            'user' => trim($POST['u']),
            'email' => trim($POST['e']),
            'phone' => trim($POST['ph'])     
        ];
		$query = "update users set username = :user, email = :email, phone = :phone where email = :emailq";
		$datares = $DB->write($query, $datavalidate);

		echo "<div class='alert alert-warning'><label class='col-sm-10 col-form-label'>Profile saved</label></div><br>";

		return TRUE;

	}

	function logout()
	{
		unset($_SESSION['user_name']);
		unset($_SESSION['user_url']);		
		header("Location:". ROOT . "login");
		die;
	}
}