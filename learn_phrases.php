<?php
session_start();
require("phrases_class.php");
require("lesson_class.php");

$servername = "localhost";
$password = "killswitchengage";
$username = "devnixgk_root";
$database = "devnixgk_sign_game";
/*
$password = "";
$username = "root";
$database = "sign_game";*/

$conn = new mysqli($servername, $username, $password, $database);

	if($conn->connect_error){
		echo "error has occured";
	}else{
		echo "";
	}

	$lesson_id = $_GET['q'];

	//object retrieval

	$phrases_game = new phrases_game;
	$phrases_game = unserialize($_SESSION["phrases_game"]);
	
	$game_type = $phrases_game->game_type;

	$phrases_game->game_id = $phrases_game->save($game_type);

	$lesson = new lesson;
	$lesson->lessonID = $lesson_id;
	$_SESSION["phrases_game"] = serialize($phrases_game);
	$_SESSION["lesson_details"] = serialize($lesson);


echo '<html>
<head>
	<script type="text/javascript" src="./assets/js/jquery-2.1.3.js"></script>
	<script type="text/javascript" src="./assets/js/bootstrap.js"></script>

	<link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/output/site.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/animate.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/pure/buttons.css">


</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
 			<div class="container">
 				<ul class="nav navbar-nav">
		            <li class="active"><a href="#">Home</a></li>
		            <li><a href="#contact">Contact</a></li>
		            <li><a href="#social">Social</a></li>
	          </ul>
  			</div>
		</nav>
	<div class="site">
		<div class="site-container">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
		';
		//echo $game_type;

		$result = mysqli_query($conn , "SELECT * FROM $game_type WHERE phrase_id = $lesson_id");

		echo mysql_error();

		$row = mysqli_fetch_row($result);

		$phrases = (string)$row[1];
		$phrases = explode(",", $phrases);

		//echo $letters;

		$counter = 0; // setting counter to 0 so we can ensure that all the letters we are learning are set to the slider correctly against how many letters we will be getting from our database
		//most times it will be 4 letters at a time

		while($counter < count($phrases)){
			echo ' <li data-target="#myCarousel" data-slide-to="'.$counter.'"></li>

			';
			$counter++;

		}
		echo '</ol>

		<div class="carousel-inner" role="listbox">';

		$newCounter = 0;

		while($newCounter < count($phrases)){

				$imagePhrase = $phrases[$newCounter];

				$imageQuery = mysqli_query($conn, "SELECT * FROM phrase_images WHERE phrase = '$imagePhrase'");

				$imgRow = mysqli_fetch_row($imageQuery);

				echo mysql_error();

			echo '<div class="item">
				      <img src="'.$imgRow[2].'" alt="">
				      <div class="item-details">"'.$phrases[$newCounter].'"</div>
				  </div>';
				    $newCounter++;
			}
		$conn->close();
		echo '</div>

				  <!-- Left and right controls -->
				  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				    <span class="sr-only">Next</span>
				  </a>
		</div>

		<a class="pure-button pure-button-primary" value="Submit" href="./phrases_game.php?q='.$lesson_id.'">PLAY!</a>';

		echo '</div>

		<div class="footer">
			<div class="footer-list">
				<ul>
				 	<li><a href="#">What we do</a></li>
				 	<li><a href="#">Meet the devs</a></li>
				 	<li><a href="#"></a></li>
				</ul>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function(){
		console.log("thank you");
		$( ".carousel-indicators li" ).first().addClass("active");
		$(".item").first().addClass("active");
	$(".carousel").each(function(){
		        $(this).carousel({
		            interval: false
		    });
		});
	});
</script>
</html>

'?>