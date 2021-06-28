<?php
include "conn.php";
error_reporting(0);
session_start();

$post_data = $_POST['data'];
$Proofing = $_POST['Proofing'];
$Review = $_POST['Review'];


$sql="SELECT * FROM tblFeedbackComment LEFT OUTER JOIN NM_Users ON  tblFeedbackComment.RegisteredBy=NM_Users.LoginName Where FeedbackID='$post_data'";
 
$rs=odbc_exec($conWMS,$sql);
$ctr = odbc_num_rows($rs);


while(odbc_fetch_row($rs))
{
	$Comment=odbc_result($rs,"Comment");
	$DateRegistered=odbc_result($rs,"DateRegistered");
	  
	$FullName=odbc_result($rs,"FullName");
	$UserId=odbc_result($rs,"RegisteredBy");

	echo '<div class="item">';


	 if (file_exists("images/user/".$UserId.".jpg")) {  
              
        echo '<img src="images/user/'.$UserId.'.jpg"  class="img-circle" alt="">';
    }        
    else{
             
    	echo '<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">';
    }

	// echo '<img src="dist/img/user4-128x128.jpg" alt="user image" class="online">';

	echo '<p class="message">';
	echo '<a href="#" class="name">';
	echo '<small class="text-muted pull-right"><i class="fa fa-clock-o"></i>'.$DateRegistered.'</small>';
	echo $FullName;
	echo '</a><font color="black">';
	echo $Comment;
	echo '</font></p>';
    echo '</div>';
	 
}
 

?>