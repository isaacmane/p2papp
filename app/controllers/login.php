<?php

Class Login extends Controller
{
	function index($page = '')
	{
		$user = $this->loadModel("user");
		if($result = $user->check_logged_in())
		{
			header("Location:". ROOT . "dashboard");
			die;
		}
		
		$data['page_title'] = "Login";
		//unset($_SESSION);
		$this->view("landlist/login", $data);
	}
}