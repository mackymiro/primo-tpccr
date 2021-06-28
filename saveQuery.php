<?php
 
include "conn.php";
error_reporting(0);
session_start();

$fileName = $_FILES["txtAttachFile"]["name"]; // The file name
$fileTmpLoc = $_FILES["txtAttachFile"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["txtAttachFile"]["type"]; // The type of file it is
$fileSize = $_FILES["txtAttachFile"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["txtAttachFile"]["error"]; // 0 for false... and 1 for true

$UserID=$_SESSION['login_user'];


if (!$fileTmpLoc) { // if file not chosen
    echo "ERROR: Please browse for a file before clicking the upload button.";
    exit();
}
 

if(move_uploaded_file($fileTmpLoc, "images/User/$UserID.jpg")){
    echo "$fileName upload is complete";
} else {
    echo "move_uploaded_file function failed";
}
?>