<?php 
require('game_class.php');
	class alphabet_game implements game{
		public $game_id;
		public $game_type;

		public function save($game_type){
			//printf ("New Record has id %d.\n", $mysqli->insert_id); // will get the id of the saved object which we will need to turn add to the object and session it
			echo "cool stuff";
			
$servername = "localhost";
$password = "killswitchengage";
$username = "devnixgk_root";
$database = "devnixgk_sign_game";
/*
$password = "";
$username = "root";
$database = "sign_game";*/

				$conn = new mysqli($servername, $username, $password, $database);

				mysqli_query($conn, "INSERT INTO alphabet_game VALUES('','$game_type')");

				return $conn->insert_id;

				$conn->close();

		}	

		public function display(){
		}
	}
?> 