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
  include_once("env.inc");
  include_once("model/Events.php");

  if(count($couple) > 0){
    $event = new Events();

    $groom_first_name =  $couple["groom_first_name"];
    $bride_first_name =  $couple["bride_first_name"];

    $name = $groom_first_name . " & " . $bride_first_name;
    $couple_id = $couple["couple_id"];
    $story = $couple["couple_story"];
    $couple_event = $event->get_event_details($event->get_events_by_couple($couple_id));


  }
 }catch(Exception $e){
     $err =  $e->getMessage();
 }

?>

<!DOCTYPE html>
<html>
<title><?php echo $name; ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="view/css/w3.css">
<link rel="stylesheet" href="view/css/google_font.css">
<!-- add ins -->
<link rel="stylesheet" href="view/css/bootstrap.css">
<link rel="stylesheet" href="view/css/bootstrap.min.css">
<link rel="stylesheet" href="view/css/simple.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<style>
body,h1,h2{font-family: "Raleway", sans-serif}
body, html {height: 100%}
p {line-height: 2}
.bgimg, .bgimg2 {
    min-height: 100%;
    background-position: center;
    background-size: cover;
}
.bgimg {background-image: url("view/images/wedding_couple.jpg")}
.bgimg2 {background-image: url("view/images/flowers.jpg")}
</style>
<body>

<!-- Header / Home-->
<header class="w3-display-container w3-wide bgimg w3-grayscale-min" id="home">
  <div class="w3-display-middle w3-text-white w3-center">
    <h1 class="w3-jumbo"><?php echo $name; ?></h1>
    <h2>Are getting married</h2>
    <h2><b><?php echo $couple_event["wedding_date"]; ?></b></h2>
  </div>
</header>

<!-- Navbar (sticky bottom) -->
<div class="w3-bottom w3-hide-small">
  <div class="w3-bar w3-white w3-center w3-padding w3-opacity-min w3-hover-opacity-off">
    <a href="#home" style="width:25%" class="w3-bar-item w3-button">Home</a>
    <a href="#us" style="width:25%" class="w3-bar-item w3-button"><?php echo $name; ?></a>
    <a href="#wedding" style="width:25%" class="w3-bar-item w3-button">Wedding</a>
    <a href="#rsvp" style="width:25%" class="w3-bar-item w3-button w3-hover-black">RSVP</a>
  </div>
</div>

<!-- About / Jane And John -->
<div class="w3-container w3-padding-64 w3-pale-red w3-grayscale-min" id="us">
  <div class="w3-content">
    <h1 class="w3-center w3-text-grey"><b><?php echo $name; ?></b></h1>
    <img class="w3-round w3-grayscale-min" src="view/images/wedding_couple2.jpg" style="width:100%;margin:32px 0">
    <p><i><?php echo $story; ?></i></p><br>
    <p class="w3-center"><a href="#wedding" class="w3-button w3-black w3-round w3-padding-large w3-large">Wedding Details</a></p>
  </div>
</div>

<!-- Background photo -->
<div class="w3-display-container bgimg2">
  <div class="w3-display-middle w3-text-white w3-center">
    <h1 class="w3-jumbo">You Are Invited</h1><br>
    <h2>Of course..</h2>
  </div>
</div>

<!-- Wedding information -->
<div class="w3-container w3-padding-64 w3-pale-red w3-grayscale-min w3-center" id="wedding">
  <div class="w3-content">
    <h1 class="w3-text-grey"><b>THE WEDDING</b></h1>
    <img class="w3-round-large w3-grayscale-min" src="view/images/wedding_location.jpg" style="width:100%;margin:64px 0">
    <div class="w3-row">
      <div class="w3-half">
        <h2>When</h2>
        <p>Wedding Ceremony - <?php echo $couple_event["wedding_time"]; ?></p>
        <?php
         if( in_array("Reception", $couple_event)){
           echo"<p>Reception & Dinner - " . $couple_event["reception_time"] . "</p>";
         }
        ?>
      </div>
      <div class="w3-half">
        <h2>Where</h2>
        <p><?php echo $couple_event["wedding_venue"] . "<br>"; ?>
          <?php echo $couple_event["wedding_address"]; ?></p>

        <?php
         if( in_array("Reception", $couple_event)){
           echo"<p>" . $couple_event["reception_venue"] . "<br>";
           echo $couple_event["reception_address"] . "</p>";
         }
        ?>
      </div>
    </div>
  </div>
</div>

<!-- RSVP section -->
<div class="w3-container w3-padding-64 w3-pale-red w3-center w3-wide" id="rsvp">
  <h1>HOPE YOU CAN MAKE IT!</h1>
  <p class="w3-large">Kindly Respond By <?php echo $couple_event["reply_date"] . "<br>"; ?></p>
  <p class="w3-xlarge">
    <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-round w3-red w3-opacity w3-hover-opacity-off" style="padding:8px 60px">RSVP</button>
  </p>
</div>

<!-- RSVP modal -->
<div id="id01" class="w3-modal">
  <div class="w3-modal-content w3-card-4 w3-animate-zoom w3-round-xxlarge" style="padding:20px;max-width:600px">
    <div class="w3-container w3-white w3-center">
      <h2 class="w3-xxxlarge">Are You Attending?</h2>
 <span id="closebtn" onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
      <form  id="rsvp_form" class=" w3-padding-64">
        <div class="w3-row-padding">
          <div id="formStatus" class=w3-full></div>
          <div class="w3-half">
            <input class="w3-input w3-border form-control" id="name"  name="name" type="text" placeholder="Full Name" onclick="this.className = 'form-control'">
          </div>
          <div class="w3-half">
            <input class="w3-input w3-border form-control" id="email" name="email" type="email" placeholder="Email"  onclick="this.className = 'form-control'">
          </div>
        </div>
        <br>
        <div class="w3-row-padding">
          <div class="w3-half">
            <select class="w3-select w3-border form-control" id="guest" name="guest" onclick="this.className = 'form-control'">
              <option value="" disabled selected>Number in party:</option>
              <option value="01">01</option>
              <option value="02">02</option>
            </select>
          </div>
          <div class="w3-half">
            <select class="w3-select w3-border form-control" id="events" name="events" onclick="this.className = 'form-control'">
             <option value="" disabled selected>Event:</option>
              <option value="All Events">All Events</option>
              <option value="Wedding">Wedding</option>
              <option value="Reception">Reception</option>
            </select>
          </div>
        </div>

      </form>
      <p id="msg_closed_rsvp" class="w3-text-red" style=display:none><strong>RSVP is now closed.</strong></p>
      <p><i>Sincerely, <?php echo $name ?></i></p>
      <div class="w3-row w3-padding-large">
        <div class="w3-half w3-center">
          <button id="btnGoing" onclick="processForm('Going')" type="button" class="w3-button w3-block w3-black w3-hover-black form-control">Going</button>
        </div>
        <div class="w3-half w3-center">
          <!-- document.getElementById('id01').style.display='none' -->
          <button id="btnNotGoing" onclick="processForm('Not Going')" type="button" class="w3-button w3-block w3-gray form-control">Cannot Go</button>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Footer -->
<footer class="w3-center w3-black w3-padding-16">
  <p>Powered by <a href="<?php echo site_url;?>" title="<?php echo owner_name;?>" target="_blank" class="w3-hover-text-green"><?php echo owner_name;?></a></p>
</footer>
<div class="w3-hide-small" style="margin-bottom:32px"> </div>
<script src="view/js/jquery-3.1.1.js"></script>
<script src="view/js/simple.js"></script>
</body>
</html>
