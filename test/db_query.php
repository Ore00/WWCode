<?php
$path = str_replace("test", "", __DIR__);
require($path . "/env.inc");
require_once(base_path . "/vendor/DBQuery.php");
$con = new DBQuery();

$email = "tede@example6.com";
$client = 3;

if($con->sql_error()  == false){
  //see if email exitS

  $sqlCheck = "select * from rsvps where events='Wedding' and event_id='" . $client . "' and email='" . $email. "'";
  $result = $con->query($sqlCheck);
  //if no error get the number of records
  if($con->sql_error() == false){
    $numCheck = $con->numRows($result);
    if($numCheck == 1){
        $row = $con->fetchAssoc($result);
    }
    $queryType = ($numCheck == 1) ? "Update" : "Insert";
    var_dump($row);
  }else{
    throw new Exception($con->sql_error());
  }

}
?>
