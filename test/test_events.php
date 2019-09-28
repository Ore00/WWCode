<?php

try{

$path = str_replace("test", "", __DIR__);
require($path . "/env.inc");

require(base_path . "/model/Events.php");

$event = new Events();

//var_dump($event->get_event_details($event->get_events_by_couple(1)));

$event->set_value("name", "Jamie & Sue Wedding");
$event->set_value("couple_id", 3);
$event->set_value("master_event_id", '1');
$event->set_value("type", "Reception");
$event->set_value("start_date_time", "2021-09-12 18:00:00");
$event->set_value("end_date_time", "2020-09-12 21:00:00");
$event->set_value("reply_by_date", "2020-07-01 18:00:00");
$event->set_value("address", "1 Courthouse ln");
$event->set_value("city", "New York");
$event->set_value("state", "NY");
$event->set_value("zip", "12345");
$event->set_value("create_date", "CURRENT_TIMESTAMP");
$event->set_value("last_update_date", "CURRENT_TIMESTAMP");
echo $event->create() . PHP_EOL;

//$event->delete();


}catch(Exception $e){
    echo $e->getMessage() . PHP_EOL;
}
 ?>
