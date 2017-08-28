<?php
session_start();
require("phrases_class.php");


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

//object creation

	$phrases_game = new phrases_game;
	$phrases_game->game_type = "lesson_game_phrases";

	//echo $alphabet_game->game_type;

	$_SESSION["phrases_game"] = serialize($phrases_game);

	//$result = mysqli_query($conn, "SELECT * FROM alphabet WHERE letter_number BETWEEN $lesson AND 26 ORDER BY rand() LIMIT 16");


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
			<div class="panel panel-default">
				<div class="panel-body">';
				$counter = 0;

					$result = mysqli_query($conn, "SELECT * FROM lesson_game_phrases");

					echo mysql_error();

					$rowcount=mysqli_num_rows($result);					

					while($counter < $rowcount){

					$row = mysqli_fetch_row($result);

					$lesson = (string)$row[0];
					$lesson_name = (String)$row[1];
					//echo $lesson;

							echo '
							<a class="thumbnail strip animated" data-lesson="'.$lesson.'" href="./learn_phrases.php?q='.$lesson.'&g=lesson_game_phrases" id="'.$lesson.'">
					 			'.$lesson_name.'
						    		<p class="signed-word"> hello there my name is hendrix</p>
						   	</a>
						   	';
						   	$counter++;
						}

				$conn->close();
				

			echo '</div>
			</div>
		</div>
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

	
	});
</script>
</html>

'?>