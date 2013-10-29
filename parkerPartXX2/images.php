<?php

$imageFolder = "upload/";
$file_display = array('jpg','jpeg', 'png','gif');
$images = scandir($imageFolder);

// sort by date modified

foreach($images as $file) {
    $temp[$file] = filemtime($imageFolder.$file);    
}

asort($temp);
$images = array_keys($temp);

foreach($images as $file) {
    $file_type = strtolower(end(explode ('.',$file)));
    if($file !== '.' && $file !== '..' && in_array($file_type, $file_display) == true){
        echo $imageFolder, $file,"\n";
    }
}

// echo '<img src="upload/faceplinth.jpg" width="200" /><br/><br/>';
// echo '<img src="upload/Screen Shot 2013-08-01 at 7.45.34 PM.png" width="200" />';

?>