<?php
Class Search extends Controller
{
	function index($page = '')
	{

	}

	function whatSrch()
	{ 
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			//show($_POST);
			$datawsrch = $this->loadModel("datasearch");
			$param = $datawsrch->whatSrch($_POST);
			//show($param);
		}
	}

	function whereSrch()
	{ 
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			//show($_POST);
			$datawsrch = $this->loadModel("datasearch");
			$param = $datawsrch->whereSrch($_POST);
			//show($param);
		}
	}

	function jobs()
	{ 
		$user = $this->loadModel("user");
		if(!$result = $user->check_logged_in()){
			header("Location:". ROOT . "login");
			die;
		}else{
			if ($_SERVER["REQUEST_METHOD"] == "GET") {
				//show($_GET);
				$datawsrch = $this->loadModel("datasearch");
				$data = $datawsrch->jobsSrch($_GET);			
				$this->view("landlist/results", $data);
				//show($param);
			}
		}
	}

	function fullresult()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$datawsrch = $this->loadModel("datasearch");
			$data = $datawsrch->jobId($_POST);
		}
	}
}


?>