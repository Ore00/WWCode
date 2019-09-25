<?php

/*
 * Copyright (C) 2018 Women Who Code - Linda McGraw
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

  if(!class_exists("DBQuery")){

    require_once(  '../../vendor/DBQuery.php');

  }
  if(!class_exists("RSVPs")){
    require_once("../../model/RSVPs.php");
  }

  $err = "";
  $msg = "";
  $client = filter_input(INPUT_POST, "client");
  $rsvp = new RSVPs();
  $rows = $rsvp->get_all($client);
  $dataArray = array();

     $num = (isset($rows)) ? count($rows) : 0;
     $rsvpLimit =  100;
     $inviationsSent =  250;
     $totalResponses = $num;
     $goingCountWedding = 0;
     $notGoingCountWedding = 0;
     $goingCountReception = 0;
     $notGoingCountReception = 0;
     $goingTotal = 0;
     $errorTotalCount = 0;
     if ($num > 0 ){
       foreach($rows as $row){
            //Count for Wedding Going
            if($row["status"] == "Going"){
              $goingTotal = $goingTotal + $row["Total"];
            }
            //Count for Wedding Going
            if($row["events"] != "Reception" && $row["status"] == "Going"){
              $goingCountWedding = $goingCountWedding + $row["Total"];
            }
            //Count for Wedding Not Going
            if($row["events"] == "Reception" && $row["status"] == "Going"){
              $notGoingCountWedding = $notGoingCountWedding + $row["Total"];
            }
            //Count for Wedding Not Going
            if($row["events"] == "Wedding" && $row["status"] == "Not Going"){
              $notGoingCountWedding = $notGoingCountWedding + $row["Total"];
            }
            //Count for Reception Going
            if($row["events"] != "Wedding" && $row["status"] == "Going"){
              $goingCountReception = $goingCountReception + $row["Total"];
            }
            //Count for Reception Not Going
            if($row["events"] == "Wedding" && $row["status"] == "Going"){
              $notGoingCountReception = $notGoingCountReception + $row["Total"];
            }
            //Count for Reception Not Going
            if($row["events"] == "Reception" && $row["status"] == "Not Going"){
              $notGoingCountReception = $notGoingCountReception + $row["Total"];
            }
            if($row["status"] == "" ){
              $errorTotalCount = $errorTotalCount + $row["Total"];
            }
       }
    
          $dataArray = array($errorTotalCount, $goingCountWedding, $notGoingCountWedding,
          $goingCountReception, $notGoingCountReception, $goingTotal, $totalResponses,
          $inviationsSent, $rsvpLimit);
      }
   //}

   echo json_encode([ "reportInfo" => $dataArray, "sysError" => $err, "msg" => $msg, "sent_client" => $client]);

}catch(Exception $e){
    $emsg = $e->getMessage();
    echo json_encode(["sysError" => $emsg]);
}
