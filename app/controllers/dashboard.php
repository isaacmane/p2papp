<?php

Class Dashboard extends Controller
{
	function index($page = '')
	{
		$data['page_title'] = "Dashboard";		
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
		$dataquery['table'] = 'post';
		$dataquery['params']['user_id'] = 'user_id = '.$_SESSION['user_id'];
		$dataquery['params']['status'] = 'status > 0';	
		$dataform = $this->loadModel("dataform");
		$postbyuser = $dataform->postbyuser($dataquery);
		$data['postbyuser'] = $postbyuser;
		$data['tablepost'] = $dataform->dashboard($data['postbyuser']);
		$this->view("landlist/dashboard", $data);
	}

}