<?php
include "conn.php";
error_reporting(0);
session_start();
	if ($_SESSION['login_user']==''){
		 header("location: login.php");
	}
	
	$sql="SELECT * FROM tbltransmission Where ID='$_GET[UID]'";
	 $UID='';
	if ($result=mysqli_query($con,$sql))
	  {
	  // Fetch one and one row
	  while ($row=mysqli_fetch_row($result))
		{
			$UID=$row[0];
			$TransmissionType=$row[1];
			$FTPSite=$row[2];
			$Directory=$row[3];
			$UserName=$row[4];
			$Password=$row[5];
			$EmailAddress=$row[6];
			$CC=$row[7];
			$Subject=$row[8];
			$MailBody=$row[9];
		}
	  }
	  
	  if ($TransmissionType=='MAIL'){
		$DisplayFTP="style='display:none;'";
		$DisplayMail='';
	  }
	  else{
		 $DisplayMail="style='display:none;'";
		$DisplayFTP='';
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
		  <form role="form" method="Post" Action="saveTransmissionSetting.php">
            <div class="box-header with-border">
			 
				<label >Transmission Type</label>
				<select id="Type" class="form-control" name="TransmissionType" style="width:300px;" onchange="toggle(this)">
					<option value="FTP">FTP</option>
					<option value="MAIL">E-mail</option>
					
					<?php 
					if ($TransmissionType!=''){
						?>
						<option value="<?php echo $UserType;?>" selected><?php echo $TransmissionType;?></option>
						<?php
					}
					?>
					
				</select>
			   
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                  <div class="col-lg-6" id="FTP" <?php echo $DisplayFTP;?>>
                      
					  <div class="form-group">
                        <label>FTP Site</label>
						 <input type="text" class="form-control" placeholder="FTP Site" name="FTPSite" value="<?php echo $FTPSite;?>">
                      </div>
                      <div class="form-group">
                        <label>Directory</label>
						 <input type="text" class="form-control" placeholder="Directory" name="Directory" value="<?php echo $Directory;?>">
                      </div>
					  <div class="form-group">
                        <label>UserName</label>
						 <input type="text" class="form-control" placeholder="UserName" name="UserName" value="<?php echo $UserName;?>">
                      </div>
					  <div class="form-group">
                        <label>Password</label>
						 <input type="password" class="form-control" placeholder="Password" name="Password" value="<?php echo $Password;?>">
                      </div>
                  </div>
				
				<div class="col-lg-6" id="Email" <?php echo $DisplayMail;?>>
					<div class="form-group">
                        <label>EmailAddress</label>
						 <input type="text" class="form-control" placeholder="EmailAddress" name="EmailAddress" value="<?php echo $EmailAddress;?>">
                      </div>
					 <div class="form-group">
                        <label>CC</label>
						 <input type="text" class="form-control" placeholder="CC" name="CC" value="<?php echo $CC;?>">
                     </div>
					 <div class="form-group">
                        <label>Subject</label>
						 <input type="text" class="form-control" placeholder="Subject" name="Subject" value="<?php echo $Subject;?>">
                      </div>
					  <div class="form-group">
                        <label>Mail Body</label><br>
						<textarea name="MailBody" cols="120" rows="10"><?php echo $MailBody;?></textarea>
						
						 
                      </div>
					 
				</div>
				
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
			  <input type="hidden" class="form-control" placeholder="" name="UID" value="<?php echo $UID;?>">
               
                <button type="submit" class="btn btn-primary">Save</button>
				<button type="reset" class="btn btn-danger" onclick="location.href='TransmissionSettings.php'">Cancel</button>
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
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script type="text/javascript">
function toggle(select){
   if(select.value=='FTP'){
    document.getElementById('FTP').style.display = "block";
	document.getElementById('Email').style.display = "none";
   } else{
	    document.getElementById('FTP').style.display = "none";
    document.getElementById('Email').style.display = "block";
   }
} 
</script>
</body>
</html>
