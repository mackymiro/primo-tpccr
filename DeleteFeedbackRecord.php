<?php
include "conn.php";
error_reporting(0);
session_start();

$ErrorID = $_POST['data'];
 
 

ExecuteQuerySQLSERVER("Delete FROM tblFeedback WHERE FeedbackID='".$ErrorID."'",$conWMS);

ExecuteQuerySQLSERVER("Delete FROM tblFeedbackComment WHERE FeedbackID='".$ErrorID."'",$conWMS);


?>