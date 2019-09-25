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

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="view/css/bootstrap.min.css">
  <script src="view/js/jquery.min.js"></script>
  <script src="view/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 550px}

    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }

    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;}
    }
  </style>
</head>

<body>

	<nav class="navbar navbar-inverse visible-xs">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#">Logo</a>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav">
	        <li class="active"><a href="#">Dashboard</a></li>
	        <li><a href="#">Age</a></li>
	        <li><a href="#">Gender</a></li>
	        <li><a href="#">Geo</a></li>
	      </ul>
	    </div>
	  </div>
	</nav>
	<div class="container-fluid">
	  <div class="row content">

			<br>

			<div class="col-sm-9">
				<div class="well">
					<div class="col-sm-3 sidenav hidden-xs">
			      <h2>Logo</h2>
			      <ul class="nav nav-pills nav-stacked">
			        <li class="active"><a href="#section1">Dashboard</a></li>
			        <li><a href="#section2">Age</a></li>
			        <li><a href="#section3">Gender</a></li>
			        <li><a href="#section3">Geo</a></li>
			      </ul><br>
			    </div>
<?php

echo "<h2>Listing of Couples</h2>";

if(isset($error) && $error != ""){
	echo"<div> $error </div>";
}

	 foreach($couples as $couple){

		$groom_first_name =  $couple["groom_first_name"];
		$bride_first_name =  $couple["bride_first_name"];
		$couple_id = $couple["couple_id"];


	 	echo "<a href='?couple=" . $couple_id ."'>".  $groom_first_name . " " . $bride_first_name  . '</a><br/>';

	 }


?>
</div>
</div>
</div>
</div>
</body>
</html>
