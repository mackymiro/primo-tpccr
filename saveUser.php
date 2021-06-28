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
		$sqls="DELETE FROM NM_Users WHERE UserID='$_GET[txtID]'";
		ExecuteQuerySQLSERVER ($sqls,$conWMS);
		
		$sqls="DELETE FROM NM_UsersProcesses WHERE  UserID='$_GET[txtID]'";
		ExecuteQuerySQLSERVER ($sqls,$conWMS);
		
		$sqls="DELETE FROM NM_UsersWorkflows WHERE UserID='$_GET[txtID]'";
		ExecuteQuerySQLSERVER ($sqls,$conWMS);
		
		$sqls="DELETE FROM NM_UsersProjects WHERE UserID ='$_GET[txtID]'";
		ExecuteQuerySQLSERVER ($sqls,$conWMS);
		
		$sql="DELETE FROM tbluser WHERE ID='$_GET[txtID]'";
		ExecuteQuery($sql,$con);
		
		$sql="DELETE FROM tblUserAccess WHERE UserID='$_GET[txtID]'";
		ExecuteQuery($sql,$con);
			
	}
	
	else{
		if ($_POST['UID']!=''){
			$UserID = $_POST['UID'];
			$sql="Update tbluser SET UserName='$_POST[UserName]',password='$_POST[password]',Name='$_POST[Name]',UserType='$_POST[UserType]' WHERE ID='$_POST[UID]'";
			 
			ExecuteQuery($sql,$con);
			$sqls="Update NM_Users SET LoginName='$_POST[UserName]',password='$_POST[password]',FullName='$_POST[Name]',UserLevel='$UserLevel',RoleID='$RoleID',ShiftID=1 ,Disabled=0,FacilityID=1,ManagerUserID=22 WHERE UserID='$_POST[UID]'";
			
			ExecuteQuerySQLSERVER ($sqls,$conWMS);
		}
		else{
			$sql="INSERT INTO tbluser (UserName,password,Name,UserType) VALUES ('$_POST[UserName]','$_POST[password]','$_POST[Name]','$_POST[UserType]')";
			ExecuteQuery($sql,$con);
			
			
			
			$UserID = GetFieldValue("Select MAX(id) as UserID From tbluser ORDER BY id DESC","UserID",$con);
			 
			$sqls="INSERT INTO NM_Users (UserID,LoginName,password,FullName,UserLevel,RoleID,ShiftID,Disabled,FacilityID,ManagerUserID) VALUES ('$UserID','$_POST[UserName]','$_POST[password]','$_POST[Name]','$UserLevel','$RoleID',1,0,1,22)";
			ExecuteQuerySQLSERVER ($sqls,$conWMS);
			
			
			
			$sqls="INSERT INTO NM_UsersWorkflows (UserID,WorkflowId) VALUES ('$UserID',$WorkflowID)";
			ExecuteQuerySQLSERVER ($sqls,$conWMS);
			
			$sqls="INSERT INTO NM_UsersProjects (UserID,ProjectID) VALUES ('$UserID',1)";
			ExecuteQuerySQLSERVER ($sqls,$conWMS);
			
		}
		
		$sql="DELETE FROM tblusertask WHERE UserID='$UserID'";
		ExecuteQuery($sql,$con);
		$sqls="DELETE FROM NM_UsersProcesses WHERE UserID ='$UserID'";
		ExecuteQuerySQLSERVER ($sqls,$conWMS);

		if(!empty($_POST['chk'])) {
			foreach($_POST['chk'] as $check) {
				$BatchID=$check; 
				
				$sql="INSERT INTO tblusertask (UserID,TaskID) VALUES ('$UserID','$BatchID')";
				 ExecuteQuery($sql,$con);

				 $sqls="INSERT INTO NM_UsersProcesses (UserID,ProcessID) VALUES ('$UserID','$BatchID')";
					ExecuteQuerySQLSERVER ($sqls,$conWMS);
			}
		}
		
	}

	
	
?>
 


  <script language="javascript">
	 
			window.location = "UserList.php";
		</script>

  