<?php

try{

$path = str_replace("test", "", __DIR__);
require($path . "/env.inc");

require(base_path . "/model/Couples.php");
$story = "You all know Jamie and I. And we all know you. We are getting married lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.";
$couple = new Couples();
//var_dump($couple->get_all());
$couple->set_value("groom_first_name", "Jamie");
$couple->set_value("groom_last_name", "Doe");
$couple->set_value("groom_email", "jamiedoe@example.com");
$couple->set_value("bride_first_name", "Sue");
$couple->set_value("bride_last_name", "Lucky");
$couple->set_value("bride_email", "suelucky@example.com");
$couple->set_value("primary_contact", "Bride");
$couple->set_value("couple_address", "1 Ace ln");
$couple->set_value("couple_city", "Atlanta");
$couple->set_value("couple_state", "GA");
$couple->set_value("couple_zip", "65462");
$couple->set_value("couple_story", $story);
echo $couple->create() . PHP_EOL;



}catch(Exception $e){
    echo $e->getMessage() . PHP_EOL;
}
?>
