<nav class="navbar navbar-expanded progress-bar-success">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo"?type=dashboard&couple=" . $_GET['couple'] . "&eID=".$eventId; ?>"><i class="fa fa-heart iconLogo"></i> Our Wedding </a>
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
                echo"<li><a href='?type=dashboard&couple=". $row['couple_id']. "&eID=" . $row['event_id'] ."'>" . $row['couple']."</a></li>";
              }
           }
            ?>
          </ul>
        </li>

      </ul>

    </div>
  </div>
</nav>
<br>
