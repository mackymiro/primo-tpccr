<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/Config.php');
require_once(__ROOT__.'/conn.php');



$RefId = $_POST['RefId'];

$image_data=$_FILES['userImage']['name'];


// make directory						
$path_dir = $_SERVER['DOCUMENT_ROOT']."\\".$ProjectName."\\uploadfiles\\".$RefId;


//GET THE ACTUAL FILE
$ACTUAL_FILE_NAME = $_FILES['userImage']['name'];
$ACTUAL_FILE_NAME = str_replace(' ', '_', $ACTUAL_FILE_NAME);


//Setup our new file path
$newFilePath = $path_dir."/". $ACTUAL_FILE_NAME;

//get temp file to save
$tmpFilePath = $_FILES['userImage']['tmp_name'];

//Upload the file into the temp dir
move_uploaded_file($tmpFilePath, $newFilePath);

?>