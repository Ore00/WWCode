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
    if(!class_exists("DBQuery")){

      require_once(base_path .'/vendor/DBQuery.php');
    }

    if(!class_exists("Events")){
      require_once("model/Events.php");
    }
  require_once("view/includes/getFile.php");
  require_once("view/includes/web_settings.inc");

   if(isset($_GET['eID'])){
    $eventId = $_GET['eID'];
  }else{
     $eventId = 1;
  }
    $events = new Events();
    $mrows = $events->get_all_weddings();
    $tbl = getReportDetails($eventId, "DataList", True, "dashboard");
    $tblReport = getReportDetails($eventId, "DataListReport", True, "report");

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
<body class="w3-platinum">
<?php require_once("view/includes/navbar.inc") ?>

<div class="container">

          <div id="metrics" class="row w3-center">
        <div id="metric-one" class="col-sm-3">
          <div class="well">
            <h4>Invitations</h4>
            <p id="countInvitations"></p>
          </div>
        </div>
        <div id="metric-two" class="col-sm-3">
          <div class="well">
            <h4>Responses</h4>
            <p id="countResponses"></p>
          </div>
        </div>
        <div id="metric-three" class="col-sm-3">
          <div class="well">
            <h4>Reserved</h4>
            <p id="countRSVPs"></p>
          </div>
        </div>
        <div id="metric-four" class="col-sm-3">
          <div class="well">
            <h4>Available</h4>
            <p id="countAvailable"></p>
          </div>
        </div>
    </div>

   <div id="charts" class="row">
        <div class="col-sm-4 w3-center">
          <div class="well">  <h6>Invitation Responses</h6>
             <canvas id="responseChart" class="miniChart"> </canvas></div>
          </div>
        <div class="col-sm-4 w3-center">
          <div class="well">
              <h6>Reserved by Type</h6>
          <canvas id="rsvpChart" class="miniChart"></canvas>
        </div>
        </div>
        <div class="col-sm-4 w3-center">
          <div class="well">
            <h6>Seat Avaliablility</h6>
              <canvas id="availChart" class="miniChart"> </canvas>
          </div>
        </div>
   </div>


            <div id="dashTBL" class="col-sm-12 table-responsive well w3-padding-12">
                <button id="buttonExport" class="button btn_export w3-round-large"><i class="fa fa-file-excel-o"></i> Export</button>
                <?php
                  if(isset($error)){   echo "<span class='alert warning'>Message: " . $error . "</span>";}
                            if(isset($tbl)){
                              echo $tbl;
                    }
                ?>
          </div>

      <!-- </div> -->
      <div id="table2" class="row">
        <div class="col-sm-12">
          <?php
          if(isset($tblReport) && $tblReport != "No RSVPs were not found."){
             echo $tblReport;
          }
          ?>
        </div>
      </div>

</div>

<script type="text/javascript" src="view/js/jquery-1-8-2.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

<script>

$(document).ready(function () {
  $("#DataListReport").hide();
  $("#buttonExport").click(function(){
      $("#DataListReport").show();
    $("#DataListReport").css('visibility','hidden');
      $("#DataListReport").table2csv({
        separator: ',',
        newline: '\n',
        quoteFields: true,
        excludecolumns: '',
        excludeRows: '',
        filename: 'ReservationList.csv'
      });
      $("#DataListReport").hide();
  });
 $("#DataListReport").DataTable({
     "bPaginate": false,
     "bInfo": false,
     "bFilter": false,
     "bLengthChange": false,
     "dom": 'Bfrtip'
   });
  $("#DataList").DataTable({
  "bPaginate": true,
  "bInfo": true,
  "bFilter": true,
  "bLengthChange": false,
  "iDisplayLength": 5,
  "dom": 'Bfrtip'

  });

});

</script>
<script src="view/js/dashboard.js"></script>
<!-- <script src="view/js/simple.js"></script> -->
<script src="view/js/table2csv.js"></script>
</body>
</html>
