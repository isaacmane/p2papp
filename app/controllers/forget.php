<?php

Class Forget extends Controller
{
	function index($page = '')
	{
		
		$data['page_title'] = "Forget";
		//unset($_SESSION);
		$this->view("landlist/forget", $data);
	}
}