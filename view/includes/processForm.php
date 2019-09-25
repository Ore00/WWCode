<?php

/*
 * Copyright (C) 2018 Websani - Linda McGraw
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
Try{
$err = "";
$msg = "";
$connInfo = "";
$insertID = "";
$affectedRows = "";
$client = "MonaLisa Cash Wedding "  . filter_input(INPUT_POST, "client") ;
$email = filter_input(INPUT_POST, "email");
$name = filter_input(INPUT_POST, "name");
$guest = filter_input(INPUT_POST, "guest");
$events = filter_input(INPUT_POST, "events");
$rsvp_val = filter_input(INPUT_POST, "rsvp_val");
$msg_rsvp = '';
if($email !=  "" && $name  !=  "" && $guest !=  "" && $events  != "" && $rsvp_val  !=  ""){
        require_once("DBQuery.php");
        $con = new DBQuery();
        if($con->sql_error()  == false){
           //see if email exitS

           $sqlCheck = "select * from wedding_rsvps where client_name='" . $client . "' and email='" . $email. "'";
           $result = $con->query($sqlCheck);
           //if no error get the number of records
           if($con->sql_error()  == false){$numCheck = $con->numRows($result);}
           $queryType = ($numCheck == 1) ? "Update" : "Insert";

           if($queryType == "Insert"){
           //insert row
              $sql = "INSERT INTO `wedding_rsvps` (`client_name`, `full_name`, `email`, `Guests`, `Events`, `RSVP`,`Create_date`)
              VALUES ( '" . $client .  "', '" . $name  .  "', '" . $email .  "', '" . $guest  .  "', '" .$events  .  "',  '" . $rsvp_val  .  "', CURRENT_TIMESTAMP)";
           }else{
             //update row
              $sql = "UPDATE `wedding_rsvps` SET `full_name` = '" . $name  .  "',  `Guests` = '" . $guest  .  "' ,  `Events` = '" . $events  .  "',  `RSVP` = '" . $rsvp_val  .  "'
               WHERE `client_name` ='" . $client . "' and email='" . $email. "'";
           }
            $con->link->query($sql);
            //check to see if the sql error
            if($con->sql_error() == false){
              $msg_rsvp = ($rsvp_val == "Going") ? "RSVP" : "feedback";
               if($queryType == "Insert"){
                   $insertID = $con->lastInsertedID();
               }else{
                   $affectedRows = $con->affectedRows();
               }
            }else{$err = $con->sql_error();}

       }else{
            $err = $con->sql_error();
       }
           if($insertID > 0){
             $msg = $name . ", we have received your " . $msg_rsvp . ".";
               $dataArray = array($email, $name, $events, $guest, $rsvp_val, $insertID);
           }elseif($con->state() == "00000"){
             $msg = $name . ", we have received your updates.";
               $dataArray = array($email, $name, $events, $guest, $rsvp_val, $affectedRows);
           }elseif($affectedRows !=-1){
             $msg = $name . ", we have received your submission.";
               $dataArray = array($email, $name, $events, $guest, $rsvp_val, $affectedRows);
           }
           else{
             $err .= "The system couldn't process your request at this time.";
           }


}else{
    $err = "System couldn't process the input supplied, because one or more values are missing.";
}
echo json_encode([ "userInfo" => $dataArray, "sysError" => $err, "msg" => $msg]);
}catch(Exception $e){
    $emsg = $e->getMessage();
    echo json_encode(["sysError" => $emsg]);
}
