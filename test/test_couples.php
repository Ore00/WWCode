<?php

try{

$path = str_replace("test", "", __DIR__);
require($path . "/env.inc");

require(base_path . "/model/Couples.php");

$couple = new Couples();
var_dump($couple->get_all());
$couple->delete();


}catch(Exception $e){
    echo $e->getMessage() . PHP_EOL;
}
?>
