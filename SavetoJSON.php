<?php
 include ("conn.php");
$Filename=$_POST['filename'];
$isExist = GetWMSValue("Select RecordID from tblRecord Where Filename ='".$Filename."'",'RecordID',$conWMS);



$Title=$_POST['Title'];
$Title = str_replace("'", "''", $Title);
$OriginatingDate=$_POST['OriginatingDate'];
$Register=$_POST['Register'];
$Type=$_POST['Type'];
$Priority=$_POST['Priority'];
$Topic=$_POST['Topic'];
$Status=$_POST['Status'];
$StateDate=$_POST['StateDate'];
$Remarks=$_POST['Remarks'];
$Remarks = str_replace("'", "''", $Remarks);
if ($isExist!=''){
	 
	$sqls ="Update [dbo].[tblRecord] SET [Filename]='".$Filename."' ,[Title]='".$Title."' ,[Register]='".$Register."' ,[Type]='".$Type."' ,[Priority] ='".$Priority."',[Topic]='".$Topic."' ,[OriginatingDate] ='".$OriginatingDate."',[StateDate]='".$StateDate."',[Status]='".$Status."',Remarks='".$Remarks."' WHERE RecordID='".$isExist."'";
}
else{
	$sqls ="INSERT INTO [dbo].[tblRecord] ([Filename] ,[Title] ,[Register] ,[Type] ,[Priority] ,[Topic] ,[OriginatingDate] ,[StateDate] ,[Status] ,[JobStatus],Remarks)     VALUES ('".$Filename."' ,'".$Title."' ,'".$Register."' ,'".$Type."','".$Priority."' ,'".$Topic."' ,'".$OriginatingDate."','".$StateDate."','".$Status."','NEW','".$Remarks."')";	
}
 
echo $sqls;
 ExecuteQuerySQLSERVER ($sqls,$conWMS);


?>