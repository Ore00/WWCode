<?php

  if(!isset($eventId)){
    $eventId = 1;
  }


?>
<nav class="navbar navbar-expanded progress-bar-success">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

       <!-- echo"?type=dashboard&couple=" . $_GET['couple'] . "&eID=".$eventId; -->

      <a class="navbar-brand" href="home"><i class="fa fa-heart iconLogo"></i> Our Wedding </a>
      <input type="hidden" id="eID" value="<?php echo $eventId; ?>">
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right" id="eventSelector" >

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Events <i class="fa fa-caret-down"></i></a>
          <ul class="dropdown-menu">
            <?php
            if(isset($mrows) && count($mrows) > 0){
              foreach($mrows as $row){

                echo"<li><a href='dashboard?couple=". $row['couple_id']. "&eID=" . $row['event_id'] ."'>" . $row['couple']."</a></li>";
              }
           }
            ?>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="nav-item">
          <a class="nav" href='CouplesList'> Couples </a>
          </li>
      </ul>
    </div>
  </div>

</nav>
<br>
