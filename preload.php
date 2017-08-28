<?php

$dirf    = './assets/images';
$dir = scandir($dirf);
foreach($dir as $file) {
echo "preloads = '";
if(($file!='..') && ($file!='.')) {
    echo "images/$file" . ",";
  }
}
echo "';"
?>

preloads = preloads.split(",")
var tempImg = []

for(var x=0;x<preloads.length;x++) {
    tempImg[x] = new Image()
    tempImg[x].src = preloads[x]
}

setTimeout("tempImg = []", 5000);

?>