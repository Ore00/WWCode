<?php

try{

include_once("env.inc");
include_once("model/Model.php");

class Controller {
	public $model;
  public $url;

	public function __construct()
    {
        $this->model = new Model();
        $this->url =  $_SERVER['REQUEST_URI'];
    }

	public function invoke()
	{
		if (!isset($_GET['couple']) && !isset($_GET['type']) )
		{
			//  show a list of all available couples
			$couples = $this->model->get_couple_list();
			include 'view/CoupleList.php';
		}
    else if(isset($_GET['type']) && $_GET['type'] == "dashboard" && isset($_GET['couple'])){
       //show dashboard 
      include 'view/Dashboard.php';
    }
		else
		{
			// show the requested couple
			$couple = $this->model->get_couple($_GET['couple']);
			include 'view/Couples.php';
		}
	}
}

}catch(Exception $e){
    $error = $e->getMessage() . PHP_EOL;
}

 ?>
