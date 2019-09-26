<?php


try{

$path = str_replace("test", "", __DIR__);
require($path . "/env.inc");

require(base_path . "/model/RSVPs.php");

$rsvp = new RSVPs();

$rsvp_lookup = new RSVPs();
$event_id = 3;
$email = "tede@example6.com";
$lookup = $rsvp_lookup->get_by_email($event_id, $email);
var_dump($lookup);
$numCheck = (isset($lookup["rsvp_id"])) ? 1 : 0;
echo $numCheck . PHP_EOL;
//var_dump($rsvp->get_all(1));
/*
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

/test updating number in party
$rsvp = new RSVPs(1);
var_dump($rsvp->read(1)) . PHP_EOL;
$rsvp->set_value("number_in_party", "4");
$rsvp->update( $rsvp->get_rsvp_id());
var_dump($rsvp->get_all(1));

*/
$rsvp->delete();


}catch(Exception $e){
    echo $e->getMessage() . PHP_EOL;
}
 ?>
