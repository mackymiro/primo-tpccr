<?php
error_reporting(0);
  include ("conn.php");
  
  $XMLTemplate=$_POST['XMLTemplate'];
	$XMLTemplate= str_replace("'","''",$XMLTemplate);
	 
			$sql="INSERT INTO tbltagmapping (StyleName,StartTag,EndTag) VALUES ('$_POST[StyleName]','$_POST[StartTag]','$_POST[EndTag]')";
		 

	ExecuteQuery($sql,$con);
 
	
?>
 
    <script language="javascript">
	 
			window.location = "TransformationSettings.php";
		</script>
