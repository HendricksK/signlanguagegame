<?php 
require("lesson_class.php");
require("alphabet_class.php");

$servername = "localhost";
$password = "killswitchengage";
$username = "devnixgk_root";
$database = "devnixgk_sign_game";
/*
$password = "";
$username = "root";
$database = "sign_game";*/

$conn = new mysqli($servername, $username, $password, $database);

session_start();

	$email = $_GET["e"];
	$score = $_GET["s"];

	$lesson = new lesson;
	$lesson = unserialize($_SESSION["lesson_details"]);

	$alphabet_game = new alphabet_game;
	$alphabet_game = unserialize($_SESSION["alphabet_game"]);


	$lessonID = $lesson->lessonID;
	$game_type = $alphabet_game->game_type;
	$game_id = $alphabet_game->game_id;

mysqli_query($conn, "INSERT INTO save_game VALUES('$email', '$game_type', '$lessonID', '$score', '$game_id')");

echo 'Email saved';

$conn->close();

	echo '<a href="./lesson_abc.php">Thank you</a>"';
?> 