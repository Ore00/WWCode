<?php

$state_codes = array("AL","AK","AZ","AR","CA","CO","CT","DE","DC","FL","GA","HI","ID","IL","IN","IA","KS","KY","LA","ME","MD","MA","MI");
array_push($state_codes, "MN","MS","MO","MT","NE","NV","NH","NJ","NM","NY","NC","ND","OH","OK","OR","PA","RI","SC","SD","TN","TX","UT","VT","VA","WA","WV","WI","WY");


function cleanData($data)
{
   $data = trim($data);
    $data = stripslashes($data);
   $data = htmlspecialchars($data);
  

   return $data;
}
?>
