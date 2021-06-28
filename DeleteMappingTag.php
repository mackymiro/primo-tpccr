<?php
error_reporting(0);
include ("conn.php");
  
$ID=$_GET['ID'];
$sql="DELETE FROM tbltagmapping WHERE MappingID='$ID'";
ExecuteQuery($sql,$con);
 
	
?>
 
<script language="javascript">
	window.location = "TransformationSettings.php";
</script>
