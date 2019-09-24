<?php

try{

$path = str_replace("test", "", __DIR__);
require($path . "/env.inc");
require(base_path . "/model/Couples.php");
require(base_path . "/model/Events.php");
require(base_path . "/model/RSVPs.php");

$couple = new Couples();
//$couple->set_value("couple_id", 1);
$couple->set_value("groom_first_name", "John");
$couple->set_value("groom_last_name", "Doe");
$couple->set_value("groom_email", "johndoe@example.com");
$couple->set_value("bride_first_name", "Jane");
$couple->set_value("bride_last_name", "Lucky");
$couple->set_value("bride_email", "janelucky@example.com");
$couple->set_value("primary_contact", "Bride");
$couple->set_value("couple_address", "12 Main st");
$couple->set_value("couple_city", "Little Rock");
$couple->set_value("couple_state", "AR");
$couple->set_value("couple_zip", "72200");
// $couple->set_value("create_date", "CURRENT_TIMESTAMP");
// $couple->set_value("last_update_date", "CURRENT_TIMESTAMP");
$couple->create();

echo "This couple id is " . $couple->get_couple_id() . PHP_EOL;
echo "Couple " . $couple->get_bride_first_name() . " & " . $couple->get_groom_first_name() . PHP_EOL;
echo "Couple primary contact is " . $couple->get_primary_contact() . PHP_EOL;
echo "Couple State is " . $couple->get_couple_state() . PHP_EOL;

/*test events class */
$event = new Events();
$event->set_value("name", "John & Jane\'s a Day to Remember");
$event->set_value("couple_id", $couple->get_couple_id());
$event->set_value("master_event_id", '0');
$event->set_value("type", "Wedding");
$event->set_value("start_date_time", "2020-07-12 15:00:00");
$event->set_value("end_date_time", "2020-07-12 18:00:00");
$event->set_value("reply_by_date", "2020-07-12 18:00:00");
$event->set_value("address", "12 Chapel ln");
$event->set_value("city", "Dallas");
$event->set_value("state", "TX");
$event->set_value("zip", "75200");
$event->set_value("create_date", "CURRENT_TIMESTAMP");
$event->set_value("last_update_date", "CURRENT_TIMESTAMP");
$event->create();
echo $event->get_type() . " : " . $event->get_name() . " ID: " . $event->get_event_id() . PHP_EOL;
echo $event->get_address() . " " . $event->get_city() . ", " . $event->get_state() . " " . $event->get_zip() . PHP_EOL;

/*test rsvps class*/
$rsvp = new RSVPs();
$rsvp->set_value("event_id", $event->get_event_id());
$rsvp->set_value("first_name", "Bob");
$rsvp->set_value("last_name", "Example");
$rsvp->set_value("email", "bob@example.com");
$rsvp->set_value("events", "All Events");
$rsvp->set_value("status", "Going");
$rsvp->set_value("number_in_party", "3");
$rsvp->set_value("create_date", "CURRENT_TIMESTAMP");
$rsvp->set_value("last_update_date", "CURRENT_TIMESTAMP");
$rsvp->create();
echo "rspv id: " .  $rsvp->get_rsvp_id();
echo " Guest: " . $rsvp->get_first_name() . " " . $rsvp->get_last_name() . PHP_EOL . "Contact: " . $rsvp->get_email() . PHP_EOL;
echo "Event(s): " . $rsvp->get_events() . " : " . $rsvp->get_status() . " # in party: " . $rsvp->get_number_in_party() . PHP_EOL;
 $rsvp->set_value("number_in_party", "2");
$rsvp->update( $rsvp->get_rsvp_id());

 echo "rspv id: " .  $rsvp->get_rsvp_id();
 echo " #In Party: " . $rsvp->get_number_in_party() . PHP_EOL;

}catch(Exception $e){
    echo $e->getMessage() . PHP_EOL;

}

?>
