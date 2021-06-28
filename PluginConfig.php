<?php
error_reporting(0);
include "conn.php";
session_start();
	if ($_SESSION['login_user']==''){
		 header("location: login.php");
	}
	
$sql="SELECT * FROM tblUserAccess Where UserID=' $_SESSION[UserID]'";
 
if ($result=mysqli_query($con,$sql))
{
// Fetch one and one row
	while ($row=mysqli_fetch_row($result))
	{
		$ACQUIRE=$row[1];
		$ENRICH=$row[2];
		$DELIVER=$row[3];
		$USER_MAINTENANCE=$row[4];
		$EDITOR_SETTINGS=$row[5];
		$ML_SETTINGS=$row[6];
		$TRANSFORMATION=$row[7];
		$TRANSMISSION=$row[8];
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
    <script type="text/javascript">
    function checkAll(checkId){
        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) { 
            if (inputs[i].type == "checkbox" && inputs[i].id == checkId) { 
                if(inputs[i].checked == true) {
                    inputs[i].checked = false ;
                } else if (inputs[i].checked == false ) {
                    inputs[i].checked = true ;
                }
            }  
        }  
    }
</script>
<?php
$TaskID=$_GET['UID'];

if ($TaskID==''){
	$TaskID=$_POST['TaskID'];
}
$Taskname=$_GET['Name'];

if ($Taskname==''){
	$Taskname=$_GET['ProcessCode'];
}

?>
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
        Plug-in Configuration (<?php echo $Taskname;?>)
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Plug-in Configuration</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
               <h3 class="box-title"><button type="button" class="btn btn-block btn-primary"  onClick="window.location='TaskSettings.php';">Back</button></h3>
            </div>
            <!-- /.box-header -->
			<form name="plugin" method="post" action="SavePlugin.php"   enctype="multipart/form-data">
			
			<div class="box-body">
				 <div class="col-lg-6">
				<div class="form-group">
					<label>Plugin Name</label>
					<input type="text" class="form-control" placeholder="Plugin Name" name="PluginName" value="">
				</div>
				<div class="form-group">
					<label>EXE Filename</label>
					<input type="text" class="form-control" placeholder="EXE Name" name="EXEName" value="">
				</div>
				<div class="form-group">
					<label>UI</label>
					<select class="form-control" name="UI">
							<option value="Styling">Styling</option>
							<option value="XMLEditor">XMLEditor</option>
                    </select>
				</div>
				<div class="form-group">
					<label>Plugin Type</label>
					<select class="form-control" name="PluginType">
							<option value="Automation">Automation</option>
							<option value="Validation">Validation</option>
                    </select>
				</div>
				<div class="form-group">
					<label>Setup</label>
					<input type="file" name="txtAttachFile[]" multiple="multiple">
				</div>
				<input type="hidden" name="TaskID" value="<?php echo $TaskID;?>">
				<input type="hidden" name="ProcessCode" value="<?php echo $_GET['ProcessCode'];?>">
				</div>
			</div>
			<div class="box-body">
				<table>
					<thead>
					<tr>
					   <th><button type="submit" class="btn btn-block btn-success">Save</button></th>
						<th></th>
					</tr>
					</thead>
				</table>
			</div>
			 </form>
			 
	<form method="post" action="DeletePlugin.php">
            <div class="box-body">
			 
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
				  <th  width="20px"><input type="Checkbox" id="chk_new"  onclick="checkAll('chk');" ></th>
                   
                  <th>Plugin Name</th>
				  <th>EXE Filename</th>
				  <th>UI</th>
				  <th>Plugin Type</th>
                </tr>
                </thead>
                <tbody>
				<?php
				$sql="SELECT * FROM tbltaskplugin WHERE TaskID='$_GET[UID]'";
				if ($result=mysqli_query($con,$sql))
				  {
				  // Fetch one and one row
				  while ($row=mysqli_fetch_row($result))
					{
						
						$PluginID=$row[0];
						$PluginName=$row[1];
						$PluginEXE=$row[2];
						$PluginUI=$row[3];
						$PluginType=$row[4];
						
					 
				?>
                <tr>
				 
				 
					 <td  width="20px"><input type="Checkbox" id="chk" name="chk[]" value="<?php echo $PluginID?>"></td>
					 <td ><?php echo $PluginName;?></td>
					 <td><?php echo $PluginEXE;?></td>
					 <td ><?php echo $PluginUI;?></td>
					 <td ><?php echo $PluginType;?></td>
				 
                </tr>
				<?php
					}
				}
				?>	  
                </tbody>
                <tfoot>
                <tr>
					<th width="20px"> <button type="submit" class="btn btn-block btn-danger">Delete</button></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
                </tr>
                </tfoot>
              </table>
			 <input type="hidden" name="TaskID" value="<?php echo $TaskID;?>">
				<input type="hidden" name="ProcessCode" value="<?php echo $_GET['ProcessCode'];?>">
            </div>
        </form>   
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
 <div class="modal fade" id="modal-default">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Change Password</h4>
	  </div>
	  <form method="post" action="ChangePassword.php">
	  <div class="box-body">
		 <div class="form-group">
		  <label for="inputEmail3" class="col-sm-2 control-label">Password</label>

		  <div class="col-sm-10">
			<input type="password" class="form-control" id="password"  name="Password"  placeholder="Password">
		  </div>
		</div>
		<div class="form-group">
		  <label for="inputPassword3" class="col-sm-2 control-label">Confirm</label>

		  <div class="col-sm-10">
			<input type="password" class="form-control" id="confirm_password" name="Confirm" placeholder="Confirm" onkeyup="check();">
		  </div>
		</div>
		<span id='message'></span>
		
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
		<input type="submit" class="btn btn-primary" id="Button" value="Change Password">
		<input type="hidden" class="btn btn-primary" name="UserName" value="<?php echo $_SESSION['login_user'];?>">
		<input type="hidden" class="btn btn-primary" name="RedirectPage" value="index.php">
	  </div>
	  </form>
	</div>
	<!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
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
