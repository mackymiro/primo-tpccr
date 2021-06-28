<?php
error_reporting(0);
  include ("conn.php");

	if ($_GET['TransType']=='Delete'){
		$sql="DELETE FROM tblATC WHERE ID='$_GET[txtID]'";
		ExecuteQuerySQLSERVER($sql,$conWMS);
	}
	else{
		if ($_POST['UID']!=''){
			$sql="Update tblATC SET SearchString='$_POST[Search]',ReplaceString='$_POST[Replace]' WHERE id='$_POST[UID]'";
			ExecuteQuerySQLSERVER($sql,$conWMS);
		}
		else{
			$sql="INSERT INTO tblATC (SearchString,ReplaceString) VALUES ('$_POST[Search]','$_POST[Replace]')";
			ExecuteQuerySQLSERVER($sql,$conWMS);
		}
	}

	 
	
	
?>
<script language="javascript">
window.location = "ATC.php";
</script>

