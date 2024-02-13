<?php

Class Signup extends Controller
{
	function index($page = '')
	{

		$data['page_title'] = "Signup";
		//unset($_SESSION);

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if(isset($_POST["email"]))
			{
				$user = $this->loadModel("user");
				$user->signup($_POST); 
			}elseif(isset($_POST["username"]) && isset($_POST["email"])){
				$user = $this->loadModel("user");
				$user->login($_POST); 
			}
		}
		

		$this->view("landlist/signup", $data);
	}

	function confirmRegstr($params){	
		$user = $this->loadModel("user");
		if ($user->validateaccount($params)) {
			$this->view("landlist/thanks");
		}

	}

}