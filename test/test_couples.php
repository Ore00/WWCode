<?php

try{

$path = str_replace("test", "", __DIR__);
require($path . "/env.inc");

require(base_path . "/model/Couples.php");
$story = "You all know Fred and I. And we all know you. We are getting married lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.";
$couple = new Couples();
//var_dump($couple->get_all());
$couple->set_value("groom_first_name", "Fred");
$couple->set_value("groom_last_name", "Flinestone");
$couple->set_value("groom_email", "fredflinestone@example.com");
$couple->set_value("bride_first_name", "Wilma");
$couple->set_value("bride_last_name", "Lucky");
$couple->set_value("bride_email", "wilmalucky@example.com");
$couple->set_value("primary_contact", "Groom");
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
