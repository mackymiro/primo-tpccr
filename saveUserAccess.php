<?php
  include ("conn.php");
  error_reporting(0);
	 
	$sql="SELECT * FROM tblUserAccess Where UserID='$_POST[UID]'";
	$sID="";
	$ACQUIRE=$_POST['ACQUIRE'];
	$ENRICH=$_POST['ENRICH'];
	$DELIVER=$_POST['DELIVER'];
	$USER_MAINTENANCE=$_POST['USER_MAINTENANCE'];
	$EDITOR_SETTINGS=$_POST['EDITOR_SETTINGS'];
	$ML_SETTINGS=$_POST['ML_SETTINGS'];
	$Transmission=$_POST['Transmission'];
	$Transformation=$_POST['Transformation'];
    $AQUISITIONREPORT=$_POST['AQUISITIONREPORT'];
	$CONFIDENCELEVELREPORT=$_POST['CONFIDENCELEVELREPORT'];
	$TaskSetting=$_POST['TaskSetting'];
	$DATAENTRYSETTING=$_POST['DATAENTRYSETTING'];
	$REPORTMANAGEMENT=$_POST['REPORTMANAGEMENT'];
	$PROJECTSETUP=$_POST['PROJECTSETUP'];

	if ($AQUISITIONREPORT!=''){
		$AQUISITIONREPORT=1;
	}
	else{
		$AQUISITIONREPORT=0;
	}
	if ($REPORTMANAGEMENT!=''){
		$REPORTMANAGEMENT=1;
	}
	else{
		$REPORTMANAGEMENT=0;
	}

	if ($ACQUIRE!=''){
		$ACQUIRE=1;
	}
	else{
		$ACQUIRE=0;
	}
	if ($ENRICH!=''){
		$ENRICH=1;
	}
	else{
		$ENRICH=0;
	}
	if ($DELIVER!=''){
		$DELIVER=1;
	}
	else{
		$DELIVER=0;
	}
	if ($USER_MAINTENANCE!=''){
		$USER_MAINTENANCE=1;
	}
	else{
		$USER_MAINTENANCE=0;
	}
	if ($EDITOR_SETTINGS!=''){
		$EDITOR_SETTINGS=1;
	}
	else{
		$EDITOR_SETTINGS=0;
	}
	if ($ML_SETTINGS!=''){
		$ML_SETTINGS=1;
	}
	else{
		$ML_SETTINGS=0;
	}
	if ($Transformation!=''){
		$Transformation=1;
	}
	else{
		$Transformation=0;
	}
	if ($Transmission!=''){
		$Transmission=1;
	}
	else{
		$Transmission=0;
	}
	if ($CONFIDENCELEVELREPORT!=''){
		$CONFIDENCELEVELREPORT=1;
	}
	else{
		$CONFIDENCELEVELREPORT=0;
	}
	
	
	if ($TaskSetting!=''){
		$TaskSetting=1;
	}
	else{
		$TaskSetting=0;
	}

	if ($PROJECTSETUP!=''){
		$PROJECTSETUP=1;
	}
	else{
		$PROJECTSETUP=0;
	}

	if ($DATAENTRYSETTING!=''){
		$DATAENTRYSETTING=1;
	}
	else{
		$DATAENTRYSETTING=0;
	}
	if ($result=mysqli_query($con,$sql))
	{
	// Fetch one and one row
		while ($row=mysqli_fetch_row($result))
		{
			$sID=$row[0];
		}
	}
    
	if ($sID!=''){
		$sql="Update tbluserAccess SET ACQUIRE='$ACQUIRE',ENRICH='$ENRICH',DELIVER='$DELIVER',USER_MAINTENANCE='$USER_MAINTENANCE',EDITOR_SETTINGS='$EDITOR_SETTINGS',ML_SETTINGS='$ML_SETTINGS',TRANSFORMATION='$Transformation',TRANSMISSION='$Transmission',AQUISITIONREPORT='$AQUISITIONREPORT',CONFIDENCELEVELREPORT='$CONFIDENCELEVELREPORT',TaskSetting='$TaskSetting',REPORTMANAGEMENT='$REPORTMANAGEMENT',PROJECTSETUP='$PROJECTSETUP' WHERE UserID='$sID'";
	}
	else{
		$sql="INSERT INTO tbluserAccess ( UserID, ACQUIRE, ENRICH, DELIVER, USER_MAINTENANCE, EDITOR_SETTINGS, ML_SETTINGS,TRANSFORMATION,TRANSMISSION,AQUISITIONREPORT,CONFIDENCELEVELREPORT,TaskSetting,REPORTMANAGEMENT,PROJECTSETUP) VALUES ('$_POST[UID]','$ACQUIRE','$ENRICH','$DELIVER','$USER_MAINTENANCE','$EDITOR_SETTINGS','$ML_SETTINGS','$Transformation','$Transmission','$AQUISITIONREPORT','$CONFIDENCELEVELREPORT','$TaskSetting','$REPORTMANAGEMENT','$PROJECTSETUP')";
	}
	 
	 
	ExecuteQuery($sql,$con);
	$sql="Delete from tbluserreport Where UserID='$_POST[UID]'";
	ExecuteQuery($sql,$con);


if(!empty($_POST['chk'])) {
			foreach($_POST['chk'] as $check) {
				$BatchID=$check; 
				
				$sql="INSERT INTO tbluserreport (ReportID,UserID) VALUES ('$BatchID','$_POST[UID]')";
				 ExecuteQuery($sql,$con);

				 
			}
		}

?>
 

<script language="javascript">
	window.location = "UserList.php";
</script>