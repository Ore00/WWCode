<nav class="navbar navbar-expanded progress-bar-success">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="Dashboard.php"><i class="fa fa-heart iconLogo"></i> Our Wedding </a>
      <input type="hidden" id="eID" value="<?php echo $eventId; ?>">
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right" id="eventSelector" >

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Events <i class="fa fa-caret-down"></i></a>
          <ul class="dropdown-menu">
            <li><a href="?type=dashboard&couple=1&eID=1">Texas</a></li>
            <li><a href="?type=dashboard&couple=1&eID=1">Savannah</a></li>
          </ul>
        </li>

      </ul>

    </div>
  </div>
</nav>
<br>
