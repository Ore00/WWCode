<?php


try{

$path = str_replace("test", "", __DIR__);
require($path . "/env.inc");

require(base_path . "/model/RSVPs.php");

$rsvp = new RSVPs(1);
var_dump($rsvp->read(1)) . PHP_EOL;
$rsvp->set_value("number_in_party", "2");
$rsvp->update( $rsvp->get_rsvp_id());
var_dump($rsvp->get_all(1));
$rsvp->delete();


}catch(Exception $e){
    echo $e->getMessage() . PHP_EOL;
}
 ?>
