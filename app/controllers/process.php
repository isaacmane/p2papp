<?php
Class Process extends Controller
{
	function index($page = '')
	{
		$data['page_title'] = "Signup";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			//print_r($_POST);
			$user = $this->loadModel("user");
			if(isset($_POST["u"])){
				$user->signup($_POST); 
			}elseif(isset($_POST["f"])){
				$user->forget($_POST);
			}elseif(isset($_POST["s"])){
				$user->resetpwd($_POST);
			}else{					
				$user->login($_POST);
			}	
		}
	}

	function cities()
	{ 
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$datacit = $this->loadModel("dataform");
			$data['cities'] = $datacit->loadingcities($_POST);
		}
	}
}