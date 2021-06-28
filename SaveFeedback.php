<?php
include "conn.php";

session_start();

$UserName=$_SESSION['login_user'];

$BookID =$_SESSION['JobID'];
$idVal = 'FB-'.date("mdY").'-';
$sDate= date("Y-m-d h:i:sa");

$FeedbackID=GenerateBookID("Select Top 1 * From tblFeedback Where FeedbackID like '%".$idVal."%' ORDER BY FeedbackID DESC",$idVal,"FeedbackID",$conWMS);

$LevelofIssue = $_POST['LevelofIssue'];
$TypeOfIssue = $_POST['TypeOfIssue'];
$Description = $_POST['Description'];
$Description = str_replace("'", "''", $Description);

ExecuteQuerySQLSERVER("INSERT INTO tblFeedback (BookID, FeedbackID, TypeOfIssue,LevelofIssue, Description, DateRegistered, RegisteredBy
) VALUES ('".$BookID."','".$FeedbackID."','".$TypeOfIssue."','".$LevelofIssue."','".$Description."','".$sDate."','".$UserName."')",$conWMS);
 

?>