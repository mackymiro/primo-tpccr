<?php
error_reporting(0);
include ("conn.php");
  
$MailBody=$_POST['MailBody'];
$MailBody= str_replace("'","''",$MailBody);
 
	if ($_GET['TransType']=='Delete'){
		$sql="DELETE FROM tbltransmission WHERE id='$_GET[txtID]'";
	}
	else{
  
		if ($_POST['UID']!=''){
			$sql="Update tbltransmission SET TransmissionType='$_POST[TransmissionType]',FTPSite='$_POST[FTPSite]',Directory='$_POST[Directory]',UserName='$_POST[UserName]',Password='$_POST[Password]',EmailAddress='$_POST[EmailAddress]',CC='$_POST[CC]',Subject='$_POST[Subject]',MailBody='$MailBody' WHERE id='$_POST[UID]'";
		}
		else{
			$sql="INSERT INTO tbltransmission (TransmissionType,FTPSite,Directory,UserName,Password,EmailAddress,CC,Subject,MailBody) VALUES ('$_POST[TransmissionType]','$_POST[FTPSite]','$_POST[Directory]','$_POST[UserName]','$_POST[Password]','$_POST[EmailAddress]','$_POST[CC]','$_POST[Subject]','$MailBody')";
		}
	}

	ExecuteQuery($sql,$con);
	 
	
	
?>
 
<script language="javascript">
	window.location = "TransmissionSettings.php";
</script>
