<?php

try{

include_once("env.inc");
include_once("model/Model.php");
include_once("model/Events.php");

class Controller {
	public $model;
	public $url;
	public $path;
	public $query;
	protected $request;

	public function __construct()
    {
        $this->model = new Model();
      	$this->url = $_SERVER['REQUEST_URI'];
        $this->request = $this->get_request($this->url);
				$this->path = $this->get_path($this->url);
				$this->query = $this->get_query($this->url);
    }

	public function invoke()
	{

		if(strpos($this->path, "dashboard") || strpos($this->query, "dashboard"))
		{
			include 'view/Dashboard.php';
		}
		elseif(strpos($this->path, "couple") || strpos($this->query, "couple"))
		{
			// show the requested couple
			$couple = $this->model->get_couple($_GET['couple']);
			include 'view/Couples.php';
		}
		elseif(strpos($this->path, "home") || strpos($this->query, "home"))
		{
			//  show a list of all available couples
			$events = new Events();
			$mrows = $events->get_all_weddings();
			$couples = $this->model->get_couple_list();
			include 'view/CoupleList.php';

		}
		else
		{
		 	//echo"<h3>See readme file or click here for <a href='?type=home'>Home</a></h3>";
			//  show a list of all available couples
			$events = new Events();
			$mrows = $events->get_all_weddings();
			$couples = $this->model->get_couple_list();
			include 'view/CoupleList.php';

		}
	}

	protected function get_request($url){
		 $url = explode('/', $url);
		 $url = array_filter($url);
		 $url = array_merge($url, array());
		 return $url;
	}
	protected function get_path($url){
		 $url = parse_url($this->url);
			return $url["path"];
	}

	protected function get_query($url){
		 $url = parse_url($this->url);
		 return (isset($url["query"])) ? $url["query"] : "";
	}
}

}catch(Exception $e){
    $error = $e->getMessage() . PHP_EOL;
}

 ?>
