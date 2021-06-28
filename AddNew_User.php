<?php
include "conn.php";
error_reporting(0);
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
<body class="hold-transition fixed skin-blue sidebar-mini">
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
        User List
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="UserList.php"><i class="fa fa-dashboard"></i> User Maintenance</a></li>
        <li class="active">User List</li>
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
              
			   <form role="form" method="Post" Action="saveUser.php">
                  <div class="col-lg-6">
                      <div class="form-group">
                        <label >User Type</label>
                        <select class="form-control" name="UserType">
							<option value="Admin">Admin</option>
							<option value="Operator">Operator</option>
							 <option value="QA">QA</option>
							<?php 
							if ($UserType!=''){
								?>
								<option value="<?php echo $UserType;?>" selected><?php echo $UserType;?></option>
								<?php
							}
							?>
							
                        </select>
                      </div>
					  <div class="form-group">
                        <label>Name</label>
						 <input type="text" class="form-control" placeholder="Name" name="Name" value="<?php echo $Name;?>">
                      </div>
                      <div class="form-group">
                        <label>User name</label>
						 <input type="text" class="form-control" placeholder="User Name" name="UserName" value="<?php echo $UserName;?>">
                      </div>
					  <div class="form-group">
                        <label>Password</label>
						 <input type="password" class="form-control" placeholder="password" name="password" value="<?php echo $Password;?>">
                      </div>
					   <div class="form-group">
                        <label>Task</label>
						<table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
				   <th></th>
                  <th>Process</th>
                   
                  
                </tr>
                </thead>
				 <tbody>
				<?php
				$strSQL="SELECT wms_Processes.ProcessId,ProcessCode,Description FROM   wms_WorkFlowProcesses INNER JOIN wms_Processes ON   wms_WorkFlowProcesses.ProcessId= wms_Processes.ProcessId Where WorkflowID=$WorkflowID ORDER BY RefID ASC";
				$objExec= odbc_exec($conWMS,$strSQL);
		
				 
				while ($row = odbc_fetch_array($objExec)) 
				{
					$TaskID=$row["ProcessId"];
					$Val='';

          if ($UID==''){
            $Val='';
          }
          else{
            $sql1="SELECT * FROM tblusertask WHERE TaskID='$TaskID' AND UserID='$UID'";
 
            if ($result1=mysqli_query($con,$sql1))
            {
              while ($row1=mysqli_fetch_row($result1))
              {
                $Val=$row1[0];
              }
            }
          }
						
					?>
					
					
				<tr>
					
                  <?php
				if ($Val==''){
					?>
					 <td width="20px"><input type="Checkbox" id="chk" name="chk[]" value="<?php echo $row["ProcessId"];?>"></td>
				<?php
				}
				else{
					?>
					 <td width="20px"><input type="Checkbox" id="chk" name="chk[]" value="<?php echo $row["ProcessId"];?>" checked></td>
					<?php
				}
				?>
                  <td><?php echo $row["Description"];?></td> 
				  
				  </td>
                </tr>
					<?php
				}
				?>	 
				</tbody>
                 
                 
              </table>
                      </div>
					  
                  </div>
           
              </div>
              <!-- /.box-body -->

				  <div class="box-footer">
				  <input type="hidden" class="form-control" placeholder="" name="UID" value="<?php echo $UID;?>">
				   
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
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
