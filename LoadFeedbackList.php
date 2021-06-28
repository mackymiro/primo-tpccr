<?php
include "conn.php";
error_reporting(0);
session_start();

$post_data =$_SESSION['JobID'];
$Proofing = $_POST['Proofing'];
$Review = $_POST['Review'];


$sql="SELECT * FROM tblFeedback LEFT OUTER JOIN NM_Users ON tblFeedback.RegisteredBy=NM_Users.LoginName Where BookID='$post_data'";

 
$rs=odbc_exec($conWMS,$sql);
$ctr = odbc_num_rows($rs);
echo "<br>";
echo '<table class="table table-bordered table-striped">';
echo "<tr><td><b><u>Feedback ID</u></b></td><td><b><u>Type of Issue</u></b></td><td><b><u>Level of Issue</u></b></td><td><b><u>Description</u></b></td><td><b><u>Date Registered</u></b></td><td><b><u>Registered By</u></b></td><td></td></tr>";
while(odbc_fetch_row($rs))
{
	$FeedbackID=odbc_result($rs,"FeedbackID");
	$TypeOfIssue=odbc_result($rs,"TypeOfIssue");
	$LevelofIssue=odbc_result($rs,"LevelofIssue");
	$Description=odbc_result($rs,"Description");
	$DateRegistered=odbc_result($rs,"DateRegistered");
	$FullName=odbc_result($rs,"FullName");


	echo "<tr>";
	echo '<td>'.$FeedbackID.'</td><td>'.$TypeOfIssue.'</td><td>'.$LevelofIssue.'</td><td>'.$Description.'</td><td>'.$DateRegistered.'</td><td>'.$FullName.'</td><td>';

	if ($Review!=1){
		echo "<button class='btn btn-xs btn-danger'  data-toggle='modal' data-target='#modal-delete' onclick='Javascript:SetTextBoxValue(\"".$FeedbackID."\")'>Delete</button>&nbsp;";
		$TotalComment = GetWMSValue("Select Count(*) as totalCount from tblFeedbackComment Where FeedbackID='$FeedbackID'","totalCount",$conWMS);
		echo "<button class='btn btn-xs btn-info'  data-toggle='modal' data-target='#modal-Comments' onclick='LoadComment(\"".$FeedbackID."\")'>View Comments(".$TotalComment.")</button>";
	}
	
	echo '</td></td></tr>';	

}
echo "</table>";


?>