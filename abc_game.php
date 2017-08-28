<?php
session_start();
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

	//$lesson_id = $_GET['q'];

	$lesson = new lesson;
	$lesson = unserialize($_SESSION["lesson_details"]);


	$lesson_id = $lesson->lessonID;

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
		<div class="site-container">';
				$letterCounter = 0;

					$result = mysqli_query($conn, "SELECT * FROM lesson_game_alphabet WHERE lesson_id = $lesson_id");

					echo mysql_error();

					$row = mysqli_fetch_row($result);

					$letters = (string)$row[2];
					$letters = explode(",", $letters);
					shuffle($letters); // this ensures that the array shuffles and that the array is always different

					//will need to create a table with all the letters and their images and get all the data into another array
					//compare the letters with the data to then get the image
					//or we can create another connection in the loop, get all the data and compare the letter from the array to get the image corresponding to that letter

					// do not need to create a new connection, just another query :) 
					$number = 1; // this number will give the panels their specific ID so we can work with them in jquery below.
					
					$lesson_letters = (string)$row[1];
					$lesson_letters = explode(",", $lesson_letters);
					$lesson_letters = implode(" ",$lesson_letters);
					
					echo '<div class="panel panel-default">
					<div class="panel-body">
					<label>Letters you will need to choose.</label>
					<div style="padding-left:45%">"'.$lesson_letters.'"</div>
					</div>
					</div>
					<div class="panel panel-default">
					<div class="panel-body">';
					
						for($x = 0; $x < count($letters); $x++){

							echo '
							<a class="thumbnail strip animated" data-letter="'.$letters[$x].'" href="#" id="'.$number.'">
					 			<img src="./assets/images/'.$letters[$x].'.jpg">
						   	</a>
						   	'; 
						   	$number++;
						   	echo '
							<a class="thumbnail strip inverted" href="#" id="'.$number.'">
					 			<img src="">
						   	</a>';
						   	$number++;
						}

				

				$conn->close();
				

			echo '</div>
			</div>
			<div class="game-panel">
				<label>Chances</label>
				<div class="chances">Chances</div>
				<label>Points</label>
				<div class="points">Points</div>
				<label>Letters correct</label>
				<div class="letters-correct"></div>
				<input type="button" class="pure-button pure-button-primary" value="Submit"></input>
			</div>
			<div class="panel panel-default">
				<div class="panel-body">
					<label>Letters you will need to choose.</label>';
					echo '<div class="sign-letters">"'.$lesson_letters.'"</div>';
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

		$(".pure-button").click(function(){
			var email = prompt("Please enter your email address", "");
			var score = $(".points").html();

			window.open("./save_alphabetgame.php?e="+email+"&s="+score+"");
			window.focus();
		});

		var counter = 0;
		var chances = 6;
		var points = 0;
		$(".chances").html(chances);
		$(".points").html(points);

		var letters = $(".sign-letters").text();


		$(".animated").click(function(e){
				while(counter < 6){
				//console.log(e.currentTarget.lastChild);
					chances = chances - 1;
					
					$(".chances").html(chances);

					counter++;
					//console.log(counter);
					
					var x = e.currentTarget.id;
					//console.log($(this).data("letter"));


					$("#"+x).addClass("flipOutY");

					var currentPage = parseInt(x);

					currentPage++;

					$("#"+x).addClass("flipOutY");

					var data = $("#"+x).find(".signed-word");
					//console.log(data[0].innerHTML);
					//alert(data[0].innerHTML);
					//$("#"+currentPage).addClass("fadeIn");

					setTimeout(function() {
		      			$("#"+currentPage).css("visibility","visible");
		      			$("#"+currentPage).addClass("animated flipInY");

					}, 800);

					$("#"+currentPage).removeClass("animated flipInY");

					for(var x = letters.length; x >= 0; x--){
						if($(this).data("letter") === letters[x]){
							console.log("#"+currentPage);
							$("#"+currentPage).css("background-color", "#00FF00");

							points = points + 25;
							points = Math.round(points);
							$(".points").html(points);
							var correct_letters = $(".letters-correct").html();
							//console.log(correct_letters);
							$(".letters-correct").html(correct_letters + " " + letters[x]);
						}
					}

					if(points == 100 && chances <= 2){
						alert("Well done, full points");
						return false;
					}

					if(chances < 2 && points > 0){
						points = points - 10;
						points = Math.round(points);
						$(".points").html(points);
					}

					return false; //used to stop the page from moving on href="#"
				}
			
			alert("You have used all your chances");

			return false;
			});
	});
</script>
</html>

'?>