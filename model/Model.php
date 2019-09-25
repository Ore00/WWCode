<?php

try{


include_once("env.inc");
include_once("Couples.php");
include_once("Events.php");
include_once("RSVPs.php");

class Model{

 function get_couple($couple_id = 1){
    $couple = new Couples($couple_id);
    return $couple->read($couple_id);

  }
 function get_couple_list(){
   $couple = new Couples();
   return $couple->get_all();
 }

}

}catch(Exception $e){
    echo $e->getMessage() . PHP_EOL;
}


?>
