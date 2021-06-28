<?php
error_reporting(0);
include ("conn.php");
  
$FieldOption=$_POST['FieldOption'];
$FieldOption= str_replace("'","''",$FieldOption);
 
	if ($_GET['TransType']=='Delete'){
		$sql="DELETE FROM tbldataentry WHERE ColumnID='$_GET[txtID]'";
	}
	else{
  
		if ($_POST['UID']!=''){
			$sql="Update tbldataentry SET FieldName='$_POST[FieldName]',FieldType='$_POST[FieldType]',FieldCaption='$_POST[FieldCaption]',FieldOption='$FieldOption' WHERE ColumnID='$_POST[UID]'";
		}
		else{
			$sql="INSERT INTO tbldataentry (FieldName,FieldType,FieldOption,FieldCaption) VALUES ('$_POST[FieldName]','$_POST[FieldType]','$FieldOption','$_POST[FieldCaption]')";
		}
	}

	ExecuteQuery($sql,$con);
	 
	
	
?>
 
<script language="javascript">
	window.location = "DataEntrySettings.php";
</script>
