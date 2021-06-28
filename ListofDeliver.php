<?php
include "conn.php";
// error_reporting(0);
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
<body class="hold-transition fixed skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
     <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
     <span class="logo-mini"><img src="innodata.png" class="img-circle"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg pull-left"><img src="innodata.png" class="img-circle" alt="User Image">&nbsp;<b>T</b>pccr</span>
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
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
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
        List of Delivered Document
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">List of Completed Document</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
  
  
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <form method="post" action="">
                <div>
                <label> Jurisdiction:</label>
                    <select name="Search" id="Search" >
                      <?php
                      $sql="Select DISTINCT Jurisdiction From tblJurisdiction ORDER BY Jurisdiction";
                    $rs=odbc_exec($conWMS,$sql);
                        $ctr = odbc_num_rows($rs);
                        while(odbc_fetch_row($rs))
                        {
                          $Val=odbc_result($rs,"Jurisdiction");
                          echo "<option value='".$Val."'>".$Val."</option>";
                        }
                        
                        if ($_POST['Search']==''){
                              echo "<option value='' selected>All</option>";
                        }
                        else{
                              echo "<option value='".$_POST['Search']."' selected>".$_POST['Search']."</option>"; 
                              echo "<option value='' >All</option>";
                        }

                      ?> 
                    </select>
                  <button type="submit" class="btn btn-primary x-small"><i class="fa  fa-search"></i> Search</button> 
                  </div>
                </form>
               
            </div>
            <!-- /.box-header -->
            <div class="box-body">
      <form method="post" action="Deliver.php">
     
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
          <?php
          if ($_SESSION['UserType']=='Admin'){
            ?>
          <th><input type="Checkbox" id="chk_new"  onclick="checkAll('chk');" ></th>
          <?php
          }
          ?>
                  <th>Batch Name</th>
                  <th>Jurisdiction</th>
                  <th>Source URL</th>
                  <th>Source Title</th>
                  <th>FileName</th>
                  <th>Title</th>
                  <th>Register</th>
                  <th>Type</th>
                  <th>Priority</th>
                  <th>Topic</th>
                  <th>Sub Topic</th>
                  <th>Originating Date</th>
                  <th>State Date</th>
                  <th>Status</th>
                  <th>User</th>
                  <th>Last Update</th>
                </tr>
                </thead>
                <tbody>
        <?php
        
 

        if ($_SESSION['UserType']=='Admin'){

          if ($_POST['Search']==''){
            $strSQL="SELECT * FROM primo_view_Record Where JobStatus='Submitted'";  
          }
          else{
            $strSQL="SELECT * FROM primo_view_Record Where JobStatus='Submitted' AND Jurisdiction='".$_POST['Search']."'";   
          }
         
        }
        else{
          if ($_POST['Search']==''){
            $strSQL="SELECT * FROM primo_view_Record Where JobStatus='Submitted'  AND AssignedTo='$_SESSION[login_user]'";  
          }
          else{

             $strSQL="SELECT * FROM primo_view_Record Where JobStatus='Submitted'  AND AssignedTo='$_SESSION[login_user]' AND Jurisdiction='".$_POST['Search']."'";  
          }
         
        }

        // }
        // else{
        //  $strSQL="SELECT * FROM primo_view_Jobs INNER JOIN tblRecord ON primo_view_Jobs.Filename =tblRecord.Filename Where  ProcessCode IN ('QC') AND statusstring ='DONE' AND AssignedTo='$_SESSION[login_user]' AND JOBNAME NOT IN (SELECT  JObname FROM primo_view_Jobs Where ProcessCode='TRANSMISSION' AND statusstring ='DONE' ) ORDER BY JOBName";  
        // }
        // $strSQL="Select * from tblRecord";
            $_SESSION['strSQL']=$strSQL;
        $objExec= odbc_exec($conWMS,$strSQL);
        
         $Jobname='';
        while ($row = odbc_fetch_array($objExec)) 
        {
        $filename="uploadFiles/".$row["Filename"];
        //$objResult=odbc_fetch_array($objExec,$i);   
       
        ?>
                <tr>

        <?php

        if ($_SESSION['UserType']=='Admin'){
        ?>
          <td> <input type="Checkbox" id="chk" name="chk[]" value="<?php echo $row["RecordID"];?>"></td>
        <?php
        }
        ?>
          
              <td><a href="index.php?file=<?php echo $filename;?>&BatchID=<?php echo $row["BatchId"];?>&Status=Completed"><?php echo $row["JobName"];?></a></td>
              <td><?php echo $row["Jurisdiction"];?></td>
              <td><?php echo $row["SourceURL"];?></td>
              <td><?php echo $row["SourceTitle"];?></td>
              <td><?php echo $row["Filename"];?></td>
              <td><?php echo $row["Title"];?></td>
              <td><?php echo $row["Register"];?></td>
              <td><?php echo $row["Type"];?></td>
              <td><?php echo $row["Priority"];?></td>
              <td><?php echo $row["Topic"];?></td>
              <td><?php echo $row["SubTopics"];?></td>
              <td><?php echo $row["OriginatingDate"];?></td>
              <td><?php echo $row["StateDate"];?></td>
              <td><?php echo $row["Status"];?></td>
              <td><?php echo $row["AssignedTo"];?></td> 
              <td><?php echo $row["LastUpdate"];?></td> 
          </tr>
        <?php
       
        }
        ?>    
                </tbody>
                
              </table>
        
        <?php
          if ($_SESSION['UserType']=='Admin'){
            ?>
         <p align="right">
            <!-- <button type="submit" class="btn btn-warning"><i class="fa  fa-send"></i> Deliver</button></p> -->
          <?php
          }
          ?>
           <a href="ExportToexcel.php" onclick="return theFunction();" target="_blank" class="pull-right">Export To Excel</a> 
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
</body>
</html>
