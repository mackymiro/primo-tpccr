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
  <title>Tpccr</title>
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
              <span class="hidden-xs"><?= $_SESSION['EName'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                 <?= $_SESSION['EName'];?>
                  <small><?= $_SESSION['UserType'];?></small>
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
        Task Configuration (<?= $_GET['Name'];?>)
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Task Configuration</li>
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
			<form method="post" action="UpdateConfig.php">
			<?php
			$sql="SELECT * FROM tbltaskeditorsetting Where TaskID='$_GET[UID]'";
 
			if ($result=mysqli_query($con,$sql))
			{
			// Fetch one and one row
				while ($row=mysqli_fetch_row($result))
				{
					$SOURCE=$row[1];
					$Styling=$row[2];
					$XMLEditor=$row[3];
					$SequenceLabeling=$row[4];
					$TextCat=$row[5];
					$DataEntry=$row[6];
					$TreeView=$row[7];
					$MenuGroup=$row[8];
          $sgmlTransformation = $row[9];
          
				}
			}
			if ($SOURCE==1){
				$SOURCE='checked';
			}
			else{
				$SOURCE='';
			}
			if ($Styling==1){
				$Styling='checked';
			}
			else{
				$Styling='';
			}
			if ($XMLEditor==1){
				$XMLEditor='checked';
			}
			else{
				$XMLEditor='';
			}
			if ($SequenceLabeling==1){
				$SequenceLabeling='checked';
			}
			else{
				$SequenceLabeling='';
			}
			if ($TextCat==1){
				$TextCat='checked';
			}
			else{
				$TextCat='';
			}
			if ($DataEntry==1){
				$DataEntry='checked';
			}
			else{
				$DataEntry='';
			}
			if ($TreeView==1){
				$TreeView='checked';
			}
			else{
				$TreeView='';
			}
      if($sgmlTransformation == 1){
        $sgmlTransformation = 'checked';
      }else{
        $sgmlTransformation = '';
      } 
			
			?>
			<div class="box-body">
			<b>Editor Setting</b><br>
				 <input type="checkbox"  name="SOURCE"  <?= $SOURCE;?>> Source<BR>
				 <input type="checkbox"  name="Styling"  <?= $Styling;?>> Styling<BR>
				 <input type="checkbox"  name="XML_Editor"  <?= $XMLEditor;?>> XML Editor<BR>
				 <input type="checkbox"  name="SequenceLabeling"  <?= $SequenceLabeling;?>> Sequence Labeling<BR>
				 <input type="checkbox"  name="TextCat"  <?= $TextCat;?>> Text Categorization<BR>
				 <input type="checkbox"  name="DataEntry"  <?= $DataEntry;?>> Data Entry<BR>
				 <input type="checkbox"  name="TreeView"  <?= $TreeView;?>> Golden Gate<BR>
         <input type="checkbox"  name="SGMLTransformation"  <?= $sgmlTransformation; ?>> SGML Transformation<BR>
				 <input type="hidden" name="TaskID" value="<?= $_GET['UID'];?>">
				 <input type="hidden" name="ProcessCode" value="<?= $_GET['ProcessCode'];?>">
			</div>
			<div class="box-body">
			<b>Menu Group</b><br>
				<select name="MenuGroup" style="width: 300px;">
					<option value="ACQUIRE">ACQUIRE</option>
					<option value="ENRICH">ENRICH</option>		 
					<option value="DELIVER">DELIVER</option>
					<option value="<?= $MenuGroup;?>" selected><?= $MenuGroup;?></option>
				</select>
			</div>
			
            <div class="box-body">
			<b>ML Setting</b>
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
				  <th  width="20px"><input type="Checkbox" id="chk_new"  onclick="checkAll('chk');" ></th>
                  <th>Domain Name</th>
				  <th>Auto-load</th>
                </tr>
                </thead>
                <tbody>
				<?php
				$sql="SELECT * FROM tblmlconfig";
				if ($result=mysqli_query($con,$sql))
				  {
				  // Fetch one and one row
				  while ($row=mysqli_fetch_row($result))
					{
						$Val='';
						$mlID=$row[0];
						$AutoLoad='';
						$sql1="SELECT * FROM tbltaskml WHERE TaskID='$_GET[UID]' AND MLID='$mlID'";
						 
						if ($result1=mysqli_query($con,$sql1))
						{
							while ($row1=mysqli_fetch_row($result1))
							{
								$Val=$row1[0];
								$AutoLoad=$row1[3];
							}
						}
				?>
                <tr>
				<?php
				if ($Val==''){
					?>
					 <td width="20px"><input type="Checkbox" id="chk" name="chk[]" value="<?php echo $row[0];?>"></td>
				<?php
				}
				else{
					?>
					 <td width="20px"><input type="Checkbox" id="chk" name="chk[]" value="<?php echo $row[0];?>" checked></td>
					<?php
				}
				?>
				 
                  <td><?php echo $row[1];?></td>
				  <?php
					if ($AutoLoad==0){
						?>
						 <td ><input type="Checkbox" id="chk" name="AutoLoad[]" value ="<?php echo $row[0];?>"></td>
					<?php
					}
					else{
						?>
						 <td ><input type="Checkbox" id="chk" name="AutoLoad[]" value="<?php echo $row[0];?>" checked></td>
						<?php
					}
					?>
                </tr>
				<?php
					}
				}
				?>	  
                </tbody>
                <tfoot>
                <tr>
					<th><button type="submit" class="btn btn-block btn-default">Save</button></th>
					<th></th>
					<th></th>
                </tr>
                </tfoot>
              </table>
			  
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
