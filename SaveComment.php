<?php
include "conn.php";
// error_reporting(0);
session_start();

$UserName=$_SESSION['login_user'];

$FeedbackID = $_POST['data'];
 
$sDate= date("Y-m-d h:i:sa");

 

$Comment = $_POST['Comment'];
 
$Comment = str_replace("'", "''", $Comment);


ExecuteQuerySQLSERVER("INSERT INTO tblFeedbackComment ( FeedbackID, Comment,DateRegistered, RegisteredBy
) VALUES ('".$FeedbackID."','".$Comment."','".$sDate."','".$UserName."')",$conWMS);


?>