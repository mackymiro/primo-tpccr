<?php
  include ("conn.php");
   error_reporting(0);

   $Mainpage=$_POST['Mainpage'];

   if ($Mainpage!=''){
		$Mainpage=1;
	}
	else{
		$Mainpage=0;
	}
  
	if ($_GET['TransType']=='Delete'){
		 
		 $sql="Delete From tblreport WHERE ReportID='$_POST[UID]'";
			 
			ExecuteQuery($sql,$con);
			
	}
	
	else{
		if ($_POST['UID']!=''){
			$sql="Update tblreport SET ReportName='$_POST[ReportName]',ReportDescription='$_POST[ReportDescription]',ReportSource='$_POST[ReportSource]',MainPage='$Mainpage' WHERE ReportID='$_POST[UID]'";
			 
			ExecuteQuery($sql,$con);
			 
		}
		else{
			$sql="INSERT INTO tblreport (ReportName,ReportDescription,ReportSource,MainPage) VALUES ('$_POST[ReportName]','$_POST[ReportDescription]','$_POST[ReportSource]','$Mainpage')";
			ExecuteQuery($sql,$con);
			
			
			
			 
			
		}
		
		 
	}

	
	
?>
 


<script language="javascript">
	window.location = "ReportManagement.php";
</script>