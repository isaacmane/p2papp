<?php

Class Chgpassword extends Controller
{
	function index($page = '')
	{
		
		$data['page_title'] = "Change Password";
		//unset($_SESSION);
		$this->view("landlist/chgpassword", $data);
	}
}