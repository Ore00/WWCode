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
//error_reporting('E_NONE');
try{
  include_once("../../env.inc");
  if(!class_exists("RSVPs")){
    require_once("../../model/RSVPs.php");
  }
$err = "";
$msg = "";
$connInfo = "";
$insertID = "";
$affectedRows = "";
$client = filter_input(INPUT_POST, "client") ;
$email = filter_input(INPUT_POST, "email");
$first_name = filter_input(INPUT_POST, "first_name");
$last_name = filter_input(INPUT_POST, "last_name");
$guest = filter_input(INPUT_POST, "guest");
$events = filter_input(INPUT_POST, "events");
$rsvp_val = filter_input(INPUT_POST, "rsvp_val");
$msg_rsvp = ($rsvp_val == "Going") ? "RSVP" : "feedback";
$queryType ="Insert";

if($email !=  "" && $first_name  !=  ""  && $last_name  !=  "" && $guest !=  "" && $events  != "" && $rsvp_val  !=  "" && $client  !=  ""){

    $rsvp_lookup = new RSVPs();
    $lookup = $rsvp_lookup->get_by_email($client, $email);
    $numCheck = (isset($lookup["rsvp_id"])) ? 1 : 0;
    $queryType = ($numCheck == 1) ? "Update" : "Insert";

           $rsvp = new RSVPs();
           $rsvp->set_value("event_id", $client);
           $rsvp->set_value("first_name", $first_name);
           $rsvp->set_value("last_name", $last_name);
           $rsvp->set_value("email", $email);
           $rsvp->set_value("events", $events);
           $rsvp->set_value("status", $rsvp_val);
           $rsvp->set_value("number_in_party", $guest);
           $rsvp->set_value("create_date", "CURRENT_TIMESTAMP");
           $rsvp->set_value("last_update_date", "CURRENT_TIMESTAMP");

           if($queryType == "Insert"){
           //insert row
              $insertID  = $rsvp->create();

           }else{
             //update row
            $affectedRows = $rsvp->update($lookup['rsvp_id']);
           }

           if($insertID > 0){
             $msg = $first_name . ", we have received your " . $msg_rsvp . ".";
               $dataArray = array($email, $first_name, $last_name, $events, $guest, $rsvp_val, $insertID);
           }elseif($affectedRows == "00000"){
             $msg = $first_name . ", we have received your updates.";
               $dataArray = array($email, $first_name, $last_name, $events, $guest, $rsvp_val, $affectedRows);
           }elseif($affectedRows !=-1){
             $msg = $first_name . ", we have received your submission.";
               $dataArray = array($email,  $first_name, $last_name, $events, $guest, $rsvp_val, $affectedRows);
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
