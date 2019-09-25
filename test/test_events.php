<?php

try{

$path = str_replace("test", "", __DIR__);
require($path . "/env.inc");

require(base_path . "/model/Events.php");

$event = new Events();

//var_dump($event->get_event_details($event->get_events_by_couple(1)));

$event->set_value("name", "Fred & Wilma Forever");
$event->set_value("couple_id", 2);
$event->set_value("master_event_id", '1');
$event->set_value("type", "Reception");
$event->set_value("start_date_time", "2020-07-12 18:00:00");
$event->set_value("end_date_time", "2020-07-12 21:00:00");
$event->set_value("reply_by_date", "2020-05-01 18:00:00");
$event->set_value("address", "12 Chapel ln");
$event->set_value("city", "Atlanta");
$event->set_value("state", "GA");
$event->set_value("zip", "65462");
$event->set_value("create_date", "CURRENT_TIMESTAMP");
$event->set_value("last_update_date", "CURRENT_TIMESTAMP");
echo $event->create() . PHP_EOL;

//$event->delete();


}catch(Exception $e){
    echo $e->getMessage() . PHP_EOL;
}
 ?>
