<?php

Class Profile extends Controller
{
	function index($page = '')
	{
		$data['page_title'] = "Profile";		
		/*$posts = $this->loadModel("posts");
		$result = $posts->get_all();

		$pagination = $this->loadModel("pagination");
		$data['prev_page'] = $pagination->generate_link($pagination->current_page_number() - 1);
		$data['next_page'] = $pagination->generate_link($pagination->current_page_number() + 1);

		$data['posts'] = $result;
		$data['posts'] = $result;
		$image_class = $this->loadModel("image_class");

		if(is_array($data['posts']))
		{
			foreach ($data['posts'] as $key => $value) {
				$data['posts'][$key]->image = $image_class->get_thumbnail($data['posts'][$key]->image);
			}
		}*/
		$user = $this->loadModel("user");
		//show($_SESSION);
		if(!$result = $user->check_logged_in())
		{
			header("Location:". ROOT . "login");
			die;
		}
		//show($_SESSION);
		/*$dataquery['table'] = 'post';
		$dataquery['params']['user_id'] = 'user_id = '.$_SESSION['user_id'];
		$dataquery['params']['status'] = 'status > 0';	
		$dataform = $this->loadModel("dataform");
		$postbyuser = $dataform->postbyuser($dataquery);
		$data['postbyuser'] = $postbyuser;
		$data['tablepost'] = $dataform->dashboard($data['postbyuser']);*/
		$data["user"] = $_SESSION;
		$this->view("landlist/profile", $data);
	}

	function s1(){	
		$user = $this->loadModel("user");
		if(!$result = $user->check_logged_in())
		{
			header("Location:". ROOT . "login");
			die;
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//$datauser['cities'] = $datauser->saveprofile($_POST);
			$data['resultprof'] = $user->saveprofile($_POST);
		}
	}

	function s2(){	
		$user = $this->loadModel("user");
		if(!$result = $user->check_logged_in())
		{
			header("Location:". ROOT . "login");
			die;
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//$datauser['cities'] = $datauser->saveprofile($_POST);
			$data['resultprof'] = $user->savedataprofile($_POST);
		}
	}

}