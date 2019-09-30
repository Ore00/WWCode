<?php
/*
* * Copyright (C) 2018 Women Who Code - Linda McGraw
*
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program; if not, write to the Free Software
* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
*/
error_reporting('E_NONE');
try{



}catch(Exception $e){
  $error .= $e->getMessage();
}

?>
<!DOCTYPE html>
<html>
<head>
  <?php
  try{
    require_once("view/includes/header.inc");
    //include_once("includes/my_icons.inc");
  }catch(Exception $e){
    $error .= $e->getMessage();
  }
  ?>
  <link rel="stylesheet" href="view/css/dashboard.css">
</head>
<body class="w3-white">
  <?php require_once("view/includes/navbar.inc") ?>

  <div class="container">
      <div class='page-header'><h1>Our Couples</h1></div>
    <div class="col-sm-12 well">

        <?php
        if(isset($error)){   echo "<span class='alert warning'>Message: " . $error . "</span>";}
        if(isset($tbl)){
          echo $tbl;
        }
        ?>


      <!-- </div> -->
      <div id="table2" class="row">
        <div class="col-sm-12">
          <?php


          if(isset($error) && $error != ""){
           echo"<div> $error </div>";
          }

            foreach($couples as $couple){

             $groom_first_name =  $couple["groom_first_name"];
             $bride_first_name =  $couple["bride_first_name"];
             $couple_id = $couple["couple_id"];


             echo "<h3><a href='?type=couple&couple=" . $couple_id ."'>".  $groom_first_name . " & " . $bride_first_name  . '</a><h3/>';

            }
          ?>
        </div>
      </div>

    </div>

  <!-- <script src="view/js/dashboard.js"></script> -->
  <!-- <script src="view/js/simple.js"></script> -->

</body>
</html>
