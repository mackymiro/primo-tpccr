<?php
include "conn.php";
// error_reporting(0);
session_start();
	if ($_SESSION['login_user']==''){
		 header("location: login.php");
	}
	
	$sql="SELECT * FROM tblUser Where ID='$_GET[UID]'";
	 $UID='';
	if ($result=mysqli_query($con,$sql))
	  {
	  // Fetch one and one row
	  while ($row=mysqli_fetch_row($result))
		{
			$UID=$row[0];
			$UserName=$row[1];
			$Password=$row[2];
			$Name=$row[3];
			$UserType=$row[4];
		}
	  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>primo</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="icon" href="innodata.png">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
     <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
     <span class="logo-mini"><img src="innodata.png" class="img-circle"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg pull-left"><img src="innodata.png" class="img-circle" alt="User Image">&nbsp;<b>p</b>rimo</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
     <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['EName'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                 <?php echo $_SESSION['EName'];?>
                  <small><?php echo $_SESSION['UserType'];?></small>
                </p>
              </li>
              <!-- Menu Body -->
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
				   <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
					Change Password
				  </button>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
<?php
include ("sideBar.php");
?>
  <!-- Content Wrapper. Contains page content -->
 
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       User Access
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="UserList.php"><i class="fa fa-dashboard"></i> User Maintenance</a></li>
        <li class="active">User Access</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
  
   <?php


$sql="SELECT * FROM tblUser";

?>
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <p><b>User Name:</b><?php echo $_GET['Name'];?></p>
			   <form role="form" method="Post" Action="saveUserAccess.php">
			   
			   <?php
			   $sql="SELECT * FROM tblUserAccess Where UserID='$_GET[UID]'";
			   $ACQUIRE="";
				$ENRICH="";
				$DELIVER="";
				$USER_MAINTENANCE="";
				$EDITOR_SETTINGS="";
				$ML_SETTINGS="";
				$Transformation="";
				$Transmission="";
				$AQUISITIONREPORT="";
				$CONFIDENCELEVELREPORT="";
				$DATAENTRYSETTING="";
				$REPORTMANAGEMENT="";
				$PROJECTSETUP="";

			   if ($result=mysqli_query($con,$sql))
				{
				// Fetch one and one row
					while ($row=mysqli_fetch_array($result))
					{
						$ACQUIRE=$row["ACQUIRE"];
						$ENRICH=$row["ENRICH"];
						$DELIVER=$row["DELIVER"];
						$USER_MAINTENANCE=$row["USER_MAINTENANCE"];
						$EDITOR_SETTINGS=$row["EDITOR_SETTINGS"];
						$ML_SETTINGS=$row["ML_SETTINGS"];
						$TRANSFORMATION=$row["TRANSFORMATION"];
						$TRANSMISSION=$row["TRANSMISSION"];
						$AQUISITIONREPORT=$row["AQUISITIONREPORT"];
						$CONFIDENCELEVELREPORT=$row["ConfidenceLevelReport"];
						$TASKSETTING=$row["TaskSetting"];
						$DATAENTRYSETTING=$row["DataEntrySetting"];
						$REPORTMANAGEMENT=$row["REPORTMANAGEMENT"];
						$PROJECTSETUP=$row["PROJECTSETUP"];

					}
				}

				if ($PROJECTSETUP==1){
					$PROJECTSETUP='checked';
				}
				else{
					$PROJECTSETUP='';
				}

				if ($REPORTMANAGEMENT==1){
					$REPORTMANAGEMENT='checked';
				}
				else{
					$REPORTMANAGEMENT='';
				}
				if ($AQUISITIONREPORT==1){
					$AQUISITIONREPORT='checked';
				}
				else{
					$AQUISITIONREPORT='';
				}
				if ($ACQUIRE==1){
					$ACQUIRE='checked';
				}
				else{
					$ACQUIRE='';
				}
				
				if ($ENRICH==1){
					$ENRICH='checked';
				}
				else{
					$ENRICH='';
				}
				
				if ($DELIVER==1){
					$DELIVER='checked';
				}
				else{
					$DELIVER='';
				}
				
				if ($USER_MAINTENANCE==1){
					$USER_MAINTENANCE='checked';
				}
				else{
					$USER_MAINTENANCE='';
				}
				
				if ($EDITOR_SETTINGS==1){
					$EDITOR_SETTINGS='checked';
				}
				else{
					$EDITOR_SETTINGS='';
				}
				
				if ($ML_SETTINGS==1){
					$ML_SETTINGS='checked';
				}
				else{
					$ML_SETTINGS='';
				}
				if ($TRANSFORMATION==1){
					$TRANSFORMATION='checked';
				}
				else{
					$TRANSFORMATION='';
				}
				if ($TRANSMISSION==1){
					$TRANSMISSION='checked';
				}
				else{
					$TRANSMISSION='';
				}
			   
			   if ($CONFIDENCELEVELREPORT==1){
					$CONFIDENCELEVELREPORT='checked';
				}
				else{
					$CONFIDENCELEVELREPORT='';
				}
				if ($DATAENTRYSETTING==1){
					$DATAENTRYSETTING='checked';
				}
				else{
					$DATAENTRYSETTING='';
				}
				
			   if ($TASKSETTING==1){
					$TASKSETTING='checked';
				}
				else{
					$TASKSETTING='';
				}
			   ?>
			   
			   
					 <input type="checkbox"  name="ACQUIRE"  <?php echo $ACQUIRE;?>>ACQUIRE <BR>
					 <input type="checkbox" name="ENRICH"  <?php echo $ENRICH;?>>ENRICH<BR>
					 <input type="checkbox"  name="DELIVER"  <?php echo $DELIVER;?>>DELIVER<BR>
					 <input type="checkbox" name="USER_MAINTENANCE"   <?php echo $USER_MAINTENANCE;?>>USER MAINTENANCE<BR>					   
					 <input type="checkbox"  name="EDITOR_SETTINGS" <?php echo $EDITOR_SETTINGS;?>>EDITOR SETTINGS <BR>
					 <input type="checkbox" name="ML_SETTINGS"   <?php echo $ML_SETTINGS;?>>ML SETTINGS<BR>
					 <input type="checkbox" name="Transformation"   <?php echo $TRANSFORMATION;?>>TRANSFORMATION SETTINGS<BR>
					 <input type="checkbox" name="Transmission"   <?php echo $TRANSMISSION;?>>TRANSMISSION SETTINGS<BR>
					 <input type="checkbox" name="PROJECTSETUP"   <?php echo $PROJECTSETUP;?>>PROJECT SETUP<BR>
					 <input type="checkbox" name="TaskSetting"   <?php echo $TASKSETTING;?>>TASK SETTINGS<BR>
					  <input type="checkbox" name="DATAENTRYSETTING"   <?php echo $DATAENTRYSETTING;?>>DATAENTRYSETTINGT<BR>
					  <input type="checkbox" name="REPORTMANAGEMENT"   <?php echo $REPORTMANAGEMENT;?>>REPORT MANAGEMENT<BR>

					 <input type="checkbox" name="AQUISITIONREPORT"   <?php echo $AQUISITIONREPORT;?>>ACQUISITION REPORT<BR>
					 <input type="checkbox" name="CONFIDENCELEVELREPORT"   <?php echo $CONFIDENCELEVELREPORT;?>>CONFIDENCE LEVEL REPORT<BR>
					 <br>
					 <br>
					 <p><b>User Report</b></p>

					<table id="example2" class="table table-bordered table-hover">
					<thead>
					<tr>
					<th></th>
					<th>Report Name</th>
					</tr>
					</thead>
					<tbody>
					<?php
					$strSQL="SELECT * From tblreport";

					if ($result=mysqli_query($con,$strSQL))
					{
					// Fetch one and one row
					while ($row=mysqli_fetch_row($result))
					{
						$ReportID=$row[0];
						$Val='';

					$sql1="SELECT * FROM tbluserreport WHERE ReportID='$ReportID' AND UserID='$UID'";

					if ($result1=mysqli_query($con,$sql1))
					{
					while ($row1=mysqli_fetch_row($result1))
					{
						$Val=$row1[0];
					}
					}
					?>


					<tr>

					<?php
					if ($Val==''){
					?>
					<td width="20px"><input type="Checkbox" id="chk" name="chk[]" value="<?php echo $ReportID;?>"></td>
					<?php
					}
					else{
					?>
					<td width="20px"><input type="Checkbox" id="chk" name="chk[]" value="<?php echo $ReportID;?>" checked></td>
					<?php
					}
					?>
					<td><?php echo $row[1];?></td> 

					</td>
					</tr>
					<?php
					}
					}
					?>	 
					</tbody>


					</table>
					 
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
			  <input type="hidden" class="form-control" placeholder="" name="UID" value="<?php echo $_GET['UID'];?>">
               
                <button type="submit" class="btn btn-primary">Save</button>
				<button type="reset" class="btn btn-danger" onclick="location.href='UserList.php'">Cancel</button>
              </div>
           
          </div>
		          
              </form>
			  
            </div>
            
            <!-- /.box-body -->
           
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
 
 
  <!-- /.content-wrapper -->
  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
       
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
         

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
       
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

 <script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
