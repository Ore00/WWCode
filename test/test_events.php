<?php

try{

$path = str_replace("test", "", __DIR__);
require($path . "/env.inc");

require(base_path . "/model/Events.php");

$event = new Events(1);
var_dump($event->get_Event_Types($event->get_event_id()));
$event->delete();
// echo $event->get_type() . " : " . $event->get_name() . " ID: " . $event->get_event_id() . PHP_EOL;
// echo $event->get_address() . " " . $event->get_city() . ", " . $event->get_state() . " " . $event->get_zip() . PHP_EOL;



}catch(Exception $e){
    echo $e->getMessage() . PHP_EOL;
}
 ?>
