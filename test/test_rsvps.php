<?php


try{

$path = str_replace("test", "", __DIR__);
require($path . "/env.inc");

require(base_path . "/model/RSVPs.php");

$rsvp = new RSVPs();
//check for existing rsvp by event id and email
/*$event_id = 1;
$email = "bob@example.com";
$lookup = $rsvp->get_by_email($event_id, $email);
var_dump($lookup);
*/
//get all rsvp by event id
var_dump($rsvp->get_all(1));
/*
//create a new rsvp
$rsvp->set_value("event_id", 3);
$rsvp->set_value("first_name", "Jody");
$rsvp->set_value("last_name", "Example");
$rsvp->set_value("email", "jodyy@example.com");
$rsvp->set_value("events", "Reception");
$rsvp->set_value("status", "Going");
$rsvp->set_value("number_in_party", "2");
$rsvp->set_value("create_date", "CURRENT_TIMESTAMP");
$rsvp->set_value("last_update_date", "CURRENT_TIMESTAMP");
echo $rsvp->create() . PHP_EOL;

/test updating number in party by rsvp id
$rsvp = new RSVPs(1);
var_dump($rsvp->read(1)) . PHP_EOL;
$rsvp->set_value("number_in_party", "4");
$rsvp->update( $rsvp->get_rsvp_id());
var_dump($rsvp->get_all(1));

*/
//$rsvp->delete();


}catch(Exception $e){
    echo $e->getMessage() . PHP_EOL;
}
 ?>
