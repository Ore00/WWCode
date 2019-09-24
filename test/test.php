<?php

try{

$path = str_replace("test", "", __DIR__);
require($path . "/model/Couples.php");
require($path . "/model/Events.php");


$couple = new Couples(1);
//$couple->set_value("couple_id", 1);
$couple->set_value("groom_first_name", "John");
$couple->set_value("groom_last_name", "Doe");
$couple->set_value("groom_email", "johndoe@example.com");
$couple->set_value("bride_first_name", "Jane");
$couple->set_value("bride_last_name", "Lucky");
$couple->set_value("bride_email", "janelucky@example.com");
$couple->set_value("primary_contact", "Bride");
$couple->set_value("couple_state", "AR");
$couple->set_value("create_date", "CURRENT_TIMESTAMP");
$couple->set_value("last_update_date", "CURRENT_TIMESTAMP");

echo "This couple id is " . $couple->get_couple_id() . PHP_EOL;
echo "Couple " . $couple->get_bride_first_name() . " & " . $couple->get_groom_first_name() . PHP_EOL;
echo "Couple primary contact is " . $couple->get_primary_contact() . PHP_EOL;
echo "Couple State is " . $couple->get_couple_state() . PHP_EOL;

/*test events class */
$event = new Events(1);
$event->set_value("name", "John & Jane's a Day to Remember");
$event->set_value("couple_id", $couple->get_couple_id());
$event->set_value("type", "Wedding");
$event->set_value("start_date_time", "2020-07-12 15:00:00");
$event->set_value("end_date_time", "2020-07-12 18:00:00");
$event->set_value("address", "12 Chapel ln");
$event->set_value("city", "Dallas");
$event->set_value("state", "TX");
$event->set_value("zip", "75200");
$event->set_value("create_date", "CURRENT_TIMESTAMP");
$event->set_value("last_update_date", "CURRENT_TIMESTAMP");

echo $event->get_type() . " : " . $event->get_name() . PHP_EOL;
echo $event->get_address() . " " . $event->get_city() . ", " . $event->get_state() . " " . $event->get_zip() . PHP_EOL;
}catch(Exception $e){
    echo $e->getMessage() . PHP_EOL;

}

?>
