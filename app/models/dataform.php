<?php

Class Dataform{

	public function __construct() {
        $this->DB = new Database();
    }

	/*function states()
	{
		$DB = new Database();

		$data = [];		
		$query = "select * from us_states where status = 'A'";
		$data = $this->DB->read($query, $data);
		//show($data);
		if(is_array($data))
		{
			foreach ($data as $key => $value) {
				$statelist[$value->id] = $value->description; 
				//$statelist[$value->id] = $value->state_name; 
			}

		}else{
			$_SESSION['error'] = "Something Wrong";
		}
		
		return $statelist;
	}*/

	function loadingcities()
	{		
		$state = key($_POST);
		$data = [];
		$query = "select * from us_cities where ID_STATE = '$state' and STATUS = 'A'";
		$data = $this->DB->read($query, $data);
		//show($data);

		if (is_array($data)) {
			foreach ($data as $key => $value) {
				$citieslist[$value->ID] = $value->CITY; 
			}
		}
		$html = '';
		$html .= "<div class='row mb-3'>";
		$html .= "<label for='inputText' class='col-sm-3 col-form-label'>City</label>";
		$html .= "<div class='col-sm-9'>";
		$html .= "<select class='form-control' id='city' style='width: 100%;'>";
		$html .= "<option value='' selected=''>-Please choose a city-</option>";
		foreach ($citieslist as $key => $value) {
          $html .= "<option value='".$key."'>".$value."</option>";
        }
        $html .= "</select>";
        $html .= "</div>";
        $html .= "</div>";
        echo $html;
		
	}

	function postbyuser($dataparams)
	{
		//show($dataparams);
		$table = $dataparams['table'];
		$query = "select * from $table where ";
		$totalparams = count($dataparams['params']);	
		$x = 0;
		$qstring = '';
		//show($dataparams);
		if ($totalparams>0){
			foreach($dataparams['params'] as $key => $value) { 
				$qstring .= $value; 
				$x = $x + 1;
				if ($x < $totalparams){
					$qstring .= ' and ';
				}				
			}			
		}
		$query = $query.$qstring;
		//echo $query."<br>";
		$data = [];
		$datares = $this->DB->read($query, $data);
		//print_r($datares);
		if (!$datares) {
			return 0;
		}else{
			return $datares;
		}
		
	}

	function masterquery($param)
	{		
		//echo $state;
		$data = [];
		$query = "select * from $param where status = 'A' order by orderlevels asc";
		$data = $this->DB->read($query, $data);
		//echo $query;
		if(is_array($data))
		{
			foreach ($data as $key => $value) {
				$type[$value->id] = $value->description; 
			}

		}else{
			$_SESSION['error'] = "Something Wrong";
		}
		return $type;		
	}

	function saves1(){
		$DB = new Database();
		$POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		//show($POST);
		//$POST = json_decode($_POST['data']);
		//$data = json_decode(file_get_contents('php://input'), true);
		unset($validate);
		$validate['count'] = 0;
		foreach($POST as $key => $value){
			if ($key != 'submit') {
				if(empty($value)) {
					$validate[$key] = 0;
					$validate['count'] = $validate['count'] + 1; 
					//echo "H->: ".$validate['count'].$key." -> ".$value;
				}else{
					$validate[$key] = $value;
				}
			}
		}
		//show($validate);
		if ($validate['count'] > 0) {
			$validate['message'] = "<span class='alert alert-warning'><b>Please enter: ";

        	foreach ($validate as $key => $value) {
        		if ($key != 'count') {
        			if (empty($value)) {
        				$validate['message'] .= $key." / ";        				
        			}
        		}
        	}
        	$validate['message'] .= "</b></span>";
        	//echo $validate['message'];

			return 0;
		}else{

			//New fields need to be added just for updates
			if(!isset($POST['proc'])){
				$data = [];
				$data = [
					'id' => NULL,
		            'user_id' => trim($_SESSION['user_id']),
		            'title' => NULL,
		            'type' => trim($POST['type']),
		            'category' => trim($POST['category']),
		            'datepost' => date("Y-m-d H:i:s"),
		            'status' => '1',
		        ];

				$query = "insert into post(id,user_id,title,type,category,datepost,status) values (:id,:user_id,:title,:type,:category,:datepost,:status)";
				$data = $DB->write($query, $data);
				
				if ($data == 1) {
					//Last insert Id
					$data = [
			            'user_id' => trim($_SESSION['user_id']),
			            'status' => '1'
			        ];
					$query = "select * from post where user_id = :user_id and status = :status order by datepost desc limit 1";
					$data = $this->DB->read($query, $data);

					$_SESSION['post_id'] = $data[0]->id;
					return 1; 
					//return $data[0]->id;

				}else{
					return 0;
				}			
				
				//return 1;	

			}elseif($POST['proc']== "f2"){
				$dataquery['table'] = 'post';
				$dataquery['params']['user_id'] = 'user_id = '.$_SESSION['user_id'];
				$dataquery['params']['status'] = 'status in (1,2)';	
				$dataquery['params']['id'] = 'id = '.$_SESSION['post_id'];	

				//show($dataquery);
				$dataform = $this->postbyuser($dataquery);

				//show($dataform);
				//show($POST);
				$data = [];
				$data = [
		            'description' => $POST['description'],
		            'company' => trim($POST['company']),
		            'position' => trim($POST['position']),
		            'vacancies_id' => trim($POST['vacancies']),
		            'experience_id' => trim($POST['experience']),
		            'clevel_id' => trim($POST['clevel']),
		            'elevel_id' => trim($POST['elevel']),
		            'work_location' => trim($POST['work_location']),
		            'state_id' => trim($POST['state']),
		            'city_id' => trim($POST['city']),
		            'datepost' => date("Y-m-d H:i:s"),
		            'status' => '2',
		            'low' => trim($_POST['lestim']),
		            'high' => trim($_POST['hestim']),
		            'pmntype' => trim($_POST['pmntype']),
		            'id' => $dataform[0]->id,	
		            'user_id' => $_SESSION['user_id']	            
		        ];

		        //show($data);
		        $query = "update post set description = :description, company = :company, position = :position, vacancies_id = :vacancies_id, experience_id = :experience_id, clevel_id = :clevel_id, elevel_id = :elevel_id, work_location = :work_location, state_id = :state_id, city_id = :city_id, datepost = :datepost, status = :status, low = :low, high = :high, pmntype = :pmntype where id = :id and user_id = :user_id";
				
				$data = $DB->write($query, $data);
				return 1;
			}	  
		} 
	}

	function getPostdata($paramx){
		$DB = new Database();

		$data = [
		    'id' => $paramx
		];
		$query = "select * from post where id = :id";		
		$data = $DB->read($query, $data);		

		return $data;
	}

	function getselect($tname, $idselected, $fieldname, $postid){
		//table name / idselected db / fieldname
		if (is_null($idselected)) {
			$idselected = 0;
		}
		$DB = new Database();
		$html = '';	
		$data = [
		    'id' => 0
		];
		if ($tname == "us_states") {	
			$inputcity = '';	
			$addelem = 0;	
			$query = "select * from $tname where STATUS = 'A'";
			$data = $DB->read($query, $data);
			//show($data);
			//echo $idselected;
			if ($idselected > 0) {
				$html .= "<select class='form-control' id='$fieldname' name='$fieldname' style='width: 100%;' onchange='chgSt();' disabled>";
			}else{
				$html .= "<select class='form-control' id='$fieldname' name='$fieldname' style='width: 100%;' onchange='chgSt();'>";
			}
			$html .= "<option value=''>- Select a State -</option>";
			foreach ($data as $key => $value) {
				if ($data[$key]->ID == 0) {
					$data[$key]->ID = '';
				}

				if (is_numeric($idselected)) {
					if ($idselected == $data[$key]->ID) {
						$html .= "<option value='".$data[$key]->ID."' selected>".$data[$key]->STATE_NAME."</option>";

						$datap = [
						    'idp' => $postid
						];

						$query = "select cit.city, cit.id FROM `post` as p, us_cities as cit where p.id = :idp AND p.city_id = cit.id";
						$datar = $DB->read($query, $datap);
						//echo count($datar);
						if (count($datar) > 0) {
							$inputcity .= "<div id='cityaux'><span></span><input type='text' class='form-control' id='citytxt' name='citytxt' value='".$datar[0]->city."' readonly></div><input type='hidden' id='city' name='city' value='".$datar[0]->id."' /><button type=button class='btn btn-primary' id='resetbutton' onclick='resetDD();'>Change Location</button>"; 
							$addelem = 1;
							//echo "A".$addelem;
						}else{
							$addelem = 0;
						}

					}else{
						$html .= "<option value='".$data[$key]->ID."'>".$data[$key]->STATE_NAME."</option>";
					}
				}else{
					$html .= "<option value='".$data[$key]->ID."'>".$data[$key]->STATE_NAME."</option>";
				}
			}
			$html .= "</select>";
			//echo $addelem;
			if ($addelem > 0) {
				$html .= $inputcity;
			}
		}else{
			$query = "select * from $tname where id >= :id";
			$data = $DB->read($query, $data);
			$html .= "<select class='form-control' id='$fieldname' name='$fieldname' style='width: 100%;'>";
			foreach ($data as $key => $value) {
				if ($data[$key]->id == 0) {
					$data[$key]->id = '';
				}
				
				if (is_numeric($idselected)) {
					if ($idselected == $data[$key]->id) {
						$html .= "<option value='".$data[$key]->id."' selected>".$data[$key]->description."</option>";
					}else{
						$html .= "<option value='".$data[$key]->id."'>".$data[$key]->description."</option>";
					}
				}else{
					$html .= "<option value='".$data[$key]->id."'>".$data[$key]->description."</option>";
				}
			}
			$html .= "</select>";
		}
		
		return $html;
	}

	function gettextbox($text){
		$html = "";
		$html .= "<textarea class='form-control' id='description' name='description' style='width: 100%; max-width: 100%;' rows='18'>".$text."</textarea>";
        return $html;
    }

	function chgStatus(){
		$DB = new Database();
		$data = [
            'status' => '3',
            'id' => array_key_first($_POST),
            'user_id' => trim($_SESSION['user_id'])
        ];
		$query = "update post set status = :status where id = :id and user_id = :user_id";
		$data = $DB->write($query, $data);

		return 1;
	}

	function convertdates($datetcnv){
		$todayDate = date('Y-m-d H:i:s');
		
		$datetime1 = new DateTime($datetcnv);
		$datetime2 = new DateTime($todayDate);

		$interval = $datetime1->diff($datetime2);

		// Access the difference in days, hours, minutes, and seconds
		$daysDifference = $interval->days;
		$hoursDifference = $interval->h;
		$minutesDifference = $interval->i;
		$secondsDifference = $interval->s;

		if ($daysDifference > 1) {
			$postedby = $daysDifference." days ago";
		}else{
			if ($hoursDifference < 2) {
				$postedby = "Just Posted";
			}else{
				$postedby = $hoursDifference." hours ago";
			}
		}

		$finaldconvert = $postedby;
		return $finaldconvert;
	}

	function dashboard($data){
		//show($data[4]);
		$html = '';
		if(is_array($data)){
			foreach ($data as $key => $value) {
				if (isset($data[$key]->state_id)) {
					if ($data[$key]->state_id > 0) {
						$dataquery['table'] = 'us_states';
						$dataquery['params']['id'] = 'id = '.$data[$key]->state_id;
						$dataformstate = $this->postbyuser($dataquery);						
					}
				}
				
				if (isset($data[$key]->city_id)) {			
					if ($data[$key]->city_id > 0) {
						$dataquery['table'] = 'us_cities';
						$dataquery['params']['id'] = 'id = '.$data[$key]->city_id;
						$dataformcity = $this->postbyuser($dataquery);						
					}
				}

				$html .= "<tr>";
					if (empty($data[$key]->position)) {	          	
						$html .= "<td><a href='posting/s2/".$data[$key]->id."' class='text-primary'>Post In Progress</a></td>";
					}else{
						$html .= "<td><a href='posting/s2/".$data[$key]->id."' class='text-primary'>".$data[$key]->position."</a></td>";
					}
					$postby = $this->convertdates($data[$key]->datepost);
					$html .= "<td>".$postby."</td>";
					$location = '';
					if (!empty($dataformcity[0]->CITY)) { $location = $dataformcity[0]->CITY; }
					if (!empty($dataformstate[0]->STATE_NAME)) { $location .= ', '.$dataformstate[0]->STATE_NAME; }
					
					$html .= "<td>".$location."</td>";
					$html .= "<td>".$data[$key]->vacancies_id."</td>";
					$html .= "<td>";
					if ($data[$key]->status == 1) {
						$html .= "<span class='badge bg-warning'>Pending</span>";
					}else{
						$html .= "<span class='badge bg-success'>Approved</span>";
					}
					$html .= "</td>";
				$html .= "</tr>";				
				unset($dataformcity);
				unset($dataformstate); 
	        }	        
        
		}else{
			$html = '';
		}
        return $html;
	}
}