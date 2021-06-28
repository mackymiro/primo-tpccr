<?php
  include ("conn.php");
   error_reporting(0);
    if ($_POST[UserType]=='Admin'){
		$UserLevel=9;
		$RoleID=1;
	}
	else{
		$UserLevel=0;
		$RoleID=7;
	}
	if ($_GET['TransType']=='Delete'){
		$sqls="DELETE FROM wms_Projects WHERE ProjectId='$_GET[txtID]'";
		 
		ExecuteQuerySQLSERVER ($sqls,$conWMS);
		 
			
	}
	
	else{
		if ($_POST['UID']!=''){
			$UserID = $_POST['UID'];
			$sql="Update wms_Projects SET ProjectCode='$_POST[ProjectCode]',Description='$_POST[Description]',TimeZone='$_POST[TimeZone]' WHERE ProjectId='$_POST[UID]'";
			 
			ExecuteQuerySQLSERVER($sql,$conWMS);
			 
		}
		else{
			$sql="INSERT INTO wms_Projects (ProjectCode,Description,TimeZone) VALUES ('$_POST[ProjectCode]','$_POST[Description]','$_POST[TimeZone]')";
			echo $sql;
			ExecuteQuerySQLSERVER($sql,$conWMS);

		}		
	}

?>
<script language="javascript">
	window.location = "ProjectSetup.php";
</script>

  