<?php

Class Checkout extends Controller
{
	function index($page = '')
	{

		$data['page_title'] = "Checkout";		
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
		if(!$result = $user->check_logged_in())
		{
			header("Location:". ROOT . "login");
			die;
		}
		$this->view("landlist/checkout", $data);
	}

}