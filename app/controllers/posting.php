<?php

Class Posting extends Controller
{

	function index($page = '')
	{
		$data['page_title'] = "Posting a Post";	
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
		//$user = $this->loadModel("user");

		/*if(!$result = $user->check_logged_in())
		{
			header("Location:". ROOT . "login");
			die;
		}*/

		$this->check_log();
		$dataquery['table'] = 'post';
		$dataquery['params']['user_id'] = 'user_id = '.$_SESSION['user_id'];
		$dataquery['params']['status'] = 'status = 1';
		$dataform = $this->loadModel("dataform");
		$postbyuser = $dataform->postbyuser($dataquery);
		//show($postbyuser);

		if (is_array($postbyuser)) {
			header("Location:". ROOT . "dashboard");
			die;
		}else{
			$data['type'] = $dataform->masterquery('type');
			$data['category'] = $dataform->masterquery('category');

			$this->view("landlist/posting", $data);
		}
	}
	function check_log(){
		$user = $this->loadModel("user");
		if(!$result = $user->check_logged_in())
		{
			header("Location:". ROOT . "login");
			die;
		}
	}

	function s1(){
		$this->check_log();
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$dataform = $this->loadModel("dataform");
			$data['statusform'] = $dataform->saves1();
			if ($data['statusform'] > 0) {
			    //echo $data['statusform'];
			    echo 'successfully';			    
			}
		}		
	}

	function s2($params){	
		if ($params > 0) {
			$_SESSION['post_id'] = $params;	
		}	
		$this->check_log();
		$data['page_title'] = "Posting a Post";
		$dataform = $this->loadModel("dataform");	
		//$data['states'] = $dataform->states(); 	
		//show($_SESSION);
		if (!isset($_SESSION['post_id'])) {
			$_SESSION['post_id'] = assign_session();
		}
		$data['postdata'] = $dataform->getPostdata($_SESSION['post_id']);		

		if (is_array($data['postdata'])) {
			//show($data);
			$data['type'] = $dataform->getselect('type',$data['postdata'][0]->type, 'type', $_SESSION['post_id']);
			$data['category'] = $dataform->getselect('category',$data['postdata'][0]->category, 'category', $_SESSION['post_id']);
			$data['experience'] = $dataform->getselect('experience',$data['postdata'][0]->experience_id, 'experience', $_SESSION['post_id']);
			$data['elevel'] = $dataform->getselect('edulevels',$data['postdata'][0]->elevel_id, 'elevel', $_SESSION['post_id']);
			$data['clevel'] = $dataform->getselect('careerlevels',$data['postdata'][0]->clevel_id, 'clevel', $_SESSION['post_id']);
			$data['state'] = $dataform->getselect('us_states',$data['postdata'][0]->state_id, 'state', $_SESSION['post_id']);
			$data['pmntype'] = $dataform->getselect('pmntype',$data['postdata'][0]->pmntype, 'pmntype', $_SESSION['post_id']);
			$data['work_location'] = $dataform->getselect('work_location',$data['postdata'][0]->work_location, 'work_location', $_SESSION['post_id']);
			$data['description'] = $dataform->gettextbox($data['postdata'][0]->description); 
			//echo $data['description'];
		}
		//show($data);
		/*
		$data['state'] = 
		$data['city'] = */
		$this->view("landlist/posting2", $data);
	}

	function s3(){
		$this->check_log();
		if ($_SERVER["REQUEST_METHOD"] == "POST") {			
			$dataform = $this->loadModel("dataform");
			$data['statusform'] = $dataform->chgStatus();
			if ($data['statusform'] == 1) {
				echo "successfully";
			}		
		}
	}
}