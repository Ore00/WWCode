<?php

try{

$path = str_replace("test", "", __DIR__);
require($path . "/model/Couples.php");

$couple = new Couples(101);
//$couple->set_value("couple_id", 1);
$couple->set_value("groom_first_name", "John");
$couple->set_value("groom_last_name", "Doe");
$couple->set_value("groom_email", "johndoe@example.com");
$couple->set_value("bride_first_name", "Jane");
$couple->set_value("bride_last_name", "Lucky");
$couple->set_value("bride_email", "janelucky@example.com");
$couple->set_value("primary_contact", "Bride");
$couple->set_value("couple_state", "AR");

echo "This couple id is " . $couple->get_couple_id() . PHP_EOL;
echo "Couple " . $couple->get_bride_first_name() . " & " . $couple->get_groom_first_name() . PHP_EOL;
echo "Couple primary contact is " . $couple->get_primary_contact() . PHP_EOL;
echo "Couple State is " . $couple->get_couple_state() . PHP_EOL;

}catch(Exception $e){
    echo $e->getMessage() . PHP_EOL;

}

?>
