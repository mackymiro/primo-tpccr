<?php
error_reporting(0);
  include ("conn.php");
  
  $XMLTemplate=$_POST['XMLTemplate'];
	$XMLTemplate= str_replace("'","''",$XMLTemplate);
	 
			$sql="Update tblxmltemplate SET XMLTemplate='$XMLTemplate'";
		 

	ExecuteQuery($sql,$con);
 
	
?>
 
    <script language="javascript">
	 
			window.location = "TransformationSettings.php";
		</script>
