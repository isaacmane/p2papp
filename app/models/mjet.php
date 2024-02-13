
<?php
//echo dirname(__FILE__)."<br>";
require '../mailjet-apiv3-php-no-composer/vendor/autoload.php';
use \Mailjet\Resources;

function sendMsgMj($url, $pemail, $r){

	$template = '';
	$template .= "Hello ".$pemail."<br><br>";
	$template .= "Somebody requested a new password for the JList account associated with ".$pemail."."."<br><br>";
	$template .= "No changes have been made to your account yet."."<br><br>";
	$template .= "You can reset your password by clicking the link below: "."<br><br>";
	$template .= "<a href='".$url."chgpassword?e=".$pemail."&v=".$r."'>Change Password</a><br><br>";
	$template .= "If you did not forget your password, please disregard this email."."<br><br>";
	$template .= "Yours,"."<br>";
	$template .= "The Jlist Team";

	$mj2 = new \Mailjet\Client('f1ab3098e861e4535a4a42412faec2de','8b3367e982f0972f697163899f9d4c3d',true,['version' => 'v3.1']);
	$body = [
		'Messages' => [
		  [
		    'From' => [
		      'Email' => "admin@datadealhub.com",
		      'Name' => "JList"
		    ],
		    'To' => [
		      [
		        'Email' => $pemail,
		        'Name' => "LandList"
		      ]
		    ],
		    'Subject' => "JList / Recover Password",
		    //'TextPart' => $message,
		    'TextPart' => "Recover Password EOM -->",
		    'HTMLPart' => $template,
		    'CustomID' => "AppGettingStartedTest"
		  ]
		]
	];
	$response = $mj2->post(Resources::$Email, ['body' => $body]);

	$x = $response->getData();   

	return $x;
}

function sendMsgConfirm($url, $pemail, $r){
	$template = '';
	$x = '';
	$template .= "Hello ".$pemail."<br><br>";
	$template .= "Thank you for registering."."<br><br>";
	$template .= "Your account has been created successfully."."<br><br>";
	$template .= "User Details: "."<br>";
	$template .= "Username: ".$pemail."<br><br>";
	//"<a href='".$url."chgpassword?e=".$pemail."&v=".$r."'>Change Password</a><br><br>";
	$template .= "Please <a href='".$url."signup/confirmRegstr/".$pemail."$".$r."'>[ click here ]</a> to confirm your email address and activate your account.<br>";
	$template .= "Best Regards,"."<br><br>";
	$template .= "The Jlist Team";

	$mj2 = new \Mailjet\Client('f1ab3098e861e4535a4a42412faec2de','8b3367e982f0972f697163899f9d4c3d',true,['version' => 'v3.1']);
	$body = [
		'Messages' => [
		  [
		    'From' => [
		      'Email' => "admin@datadealhub.com",
		      'Name' => "JList"
		    ],
		    'To' => [
		      [
		        'Email' => $pemail,
		        'Name' => "LandList"
		      ]
		    ],
		    'Subject' => "JList / Confirm Registration",
		    //'TextPart' => $message,
		    'TextPart' => "Recover Password EOM -->",
		    'HTMLPart' => $template,
		    'CustomID' => "AppGettingStartedTest"
		  ]
		]
	];
	$response = $mj2->post(Resources::$Email, ['body' => $body]);	

	$x = $response->getData();   
	if (strcmp($x['Messages'][0]['Status'], 'success') == 0) {
		return TRUE;
	}
	return FALSE;
}

function changeEmailAccount($url, $pemail, $r){
	$template = '';
	$x = '';
	$template .= "Hello ".$pemail."<br><br>";
	$template .= "We receive a request to change the email associated to your account with JList"."<br><br>";
	$template .= "User Details: "."<br>";
	$template .= "Username/New Email: ".$pemail."<br><br>";
	//"<a href='".$url."chgpassword?e=".$pemail."&v=".$r."'>Change Password</a><br><br>";
	$template .= "Please copy and paste this code ".$r." to confirm the change.<br><br>";
	$template .= "Best Regards,"."<br><br>";
	$template .= "The Jlist Team";

	$mj2 = new \Mailjet\Client('f1ab3098e861e4535a4a42412faec2de','8b3367e982f0972f697163899f9d4c3d',true,['version' => 'v3.1']);
	$body = [
		'Messages' => [
		  [
		    'From' => [
		      'Email' => "admin@datadealhub.com",
		      'Name' => "JList"
		    ],
		    'To' => [
		      [
		        'Email' => $pemail,
		        'Name' => "LandList"
		      ]
		    ],
		    'Subject' => "JList / Change Email",
		    //'TextPart' => $message,
		    'TextPart' => "Recover Password EOM -->",
		    'HTMLPart' => $template,
		    'CustomID' => "AppGettingStartedTest"
		  ]
		]
	];
	$response = $mj2->post(Resources::$Email, ['body' => $body]);	

	$x = $response->getData();   
	if (strcmp($x['Messages'][0]['Status'], 'success') == 0) {
		return TRUE;
	}
	return FALSE;
}
 

?>