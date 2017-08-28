<!DOCTYPE HTML>
<html>
<head>
	<script type="text/javascript" src="./assets/js/jquery-2.1.3.js"></script>
	<script type="text/javascript" src="./assets/js/bootstrap.js"></script>

	<link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/output/site.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/animate.css">

</head>
<body>
	<div class="site">
		<div class="site-container">
			<div class="panel panel-default" style="width:50%; margin-left:25%">
				<ul class="list-group">
					<li class="list-group-item"><a href="./lesson_abc.php">ABC</a></li>
					<li class="list-group-item"><a href="./lesson_phrases.php">Phrases</a></li>
				</ul>
			</div>
			<div class="panel panel-default" style="visibility:hidden;">
<?php
$dirf    = './assets/images';
$dir = scandir($dirf);
foreach($dir as $file) {
if(($file!='..') && ($file!='.')) {
    $img = "./assets/images/$file";
    $img = str_replace ( ' ', '%20', $img);// = preg_replace('/ /s', ' ', $img); 
    echo "<img src=".$img." style='height:10px'>";
  }
}
echo "';"
?>
			</div>
			</div>

		</div>
</body>
<script type="text/javascript">
$(document).ready(function(){
	if (document.readyState === "complete") { alert("hello"); }
});
</script>
</html>