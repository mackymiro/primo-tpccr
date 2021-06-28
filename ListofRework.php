<?php
include "conn.php";
error_reporting(0);
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



$search=$_GET['Search'];

if ($search==''){
  $search=$_POST['Search'];
}

if ($search==''){
  $search='STYLING';
}

$StateName=$_GET['QAID'];


if ($StateName==''){
  $StateName=$_POST['QAID'];
}
 

$dtFrom=$_GET['From'];

if ($dtFrom==''){
  $dtFrom=$_POST['From'];
}

if ($dtFrom==''){
  $dtFrom =date("m/d/Y");
}


$dtTo=$_GET['To'];

if ($dtTo==''){
  $dtTo=$_POST['To'];
}

if ($dtTo==''){
  $dtTo =date("m/d/Y");
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
  
  <script src="code/highcharts.js"></script>
<script src="code/modules/data.js"></script>
<script src="code/modules/drilldown.js"></script>
<script type="text/javascript" language="JavaScript">

        function SetTextBoxValue($prVal) {
    
            document.getElementById('BatchID').value = $prVal;

        }
     function SetTextBoxValue1($prVal) {
       
            document.getElementById('BatchID1').value = $prVal;

        }
      function SetTextBoxValue2($prVal) {
       
            document.getElementById('BatchID2').value = $prVal;

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
         Rework list
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Rework list</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
  
   
        <div class="col-md-12">
          <div class="box box-primary">
		 
            <div class="box-header with-border">
			<!-- <form method="post" action="">
               From:<input type="Month" Name="From" value="<?php echo $pFrom;?>"> To: <input type="Month" Name="To" value="<?php echo $pTo;?>"> <button type="submit" class="btn btn-primary small"><i class="fa  fa-search"></i> Search</button>
			 </form> -->
          <form method="post" action="">
          Filter by: <input type="hidden" name="Search" value="STYLING">
        <!--   <input name="From" type="Date" value="<?=$dtFrom;?>"> <input name="To" type="Date" value="<?=$dtTo;?>"> -->
          <select name="QAID" id="QAID">
        <?php
        


        if ($_SESSION['UserType']=='Admin'){
          $strSQL="SELECT DISTINCT QAID FROM primo_view_Jobs INNER JOIN tblXMLFilename ON primo_view_jobs.Filename = tblXMLFilename.BatchFileName Where  ProcessCode IN ('STYLING') AND statusstring ='DONE' AND STATUS='Rework'";    
        }
        else{
          $strSQL="SELECT DISTINCT QAID FROM primo_view_Jobs INNER JOIN tblXMLFilename ON primo_view_jobs.Filename = tblXMLFilename.BatchFileName  Where  ProcessCode IN ('STYLING') AND statusstring ='DONE' AND STATUS='Rework' AND ReworkBy='$_SESSION[login_user]'";   

        }



        $objExec= odbc_exec($conWMS,$strSQL);
    
        $prDateFrom = $dtFrom.' 11:59:59 PM';
        $prDateTO = $dtTo.' 12:00:00 AM';

        while ($row = odbc_fetch_array($objExec)) 
        {
             $QAID=$row["QAID"];
          ?>
                <option value="<?php echo  $QAID;?>"><?php echo  $QAID;?></option>
                 
              <?php

              if ($QAID==$StateName){
                ?>
                <option value="<?php echo $QAID;?>" selected><?php echo $QAID;?></option>
            <?php
                }
                }
                ?>
              </select> 
              <button type="submit" class="btn btn-primary small"><i class="fa  fa-search"></i> Search</button> 
            </div>
            </form>
            <!-- /.box-header -->
  <form method="post" action="Deliver1.php">
			<div class="box-body">
            <div class="box-body">

              <input type="hidden" value="<?php echo $QAID;?>" name="ClusterName">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                <?php
                if ($_SESSION['UserType']=='Admin'){
                  ?>
                <th><input type="Checkbox" id="chk_new"  onclick="checkAll('chk');" ></th>
                <?php
                }
                ?>
                  <th>Assigned To</th>
                  <th>Rework Status</th>
                  <th>QA ID</th>
                  <th>JobName</th>
                  <th>Actual Filename</th>
                  <th>Filename</th>
                   
                  <th>User (Styling)</th>
                 
                  <th>State</th>
                  <th>Date Registered</th>
                </tr>
                </thead>
                <tbody>
				<?php
				$prDateFrom = $dtFrom.' 12:00:00 AM';
        $prDateTO = $dtTo.' 11:59:59 PM';
         if ($_SESSION['UserType']=='Admin'){
          $strSQL="SELECT DISTINCT JobId, BatchId,QAID, JobName, ProcessCode, StatusString, AssignedTo, LastUpdate, Filename, JobId, State, ActualFile, HoldRemarks, DateRegistered, Status, ReworkBy,ReworkStatus  FROM primo_view_Jobs INNER JOIN tblXMLFilename ON primo_view_jobs.Filename = tblXMLFilename.BatchFileName Where  ProcessCode IN ('STYLING') AND statusstring ='DONE' AND STATUS='Rework'  AND QAID='$StateName'";    
        }
        else{
          $strSQL="SELECT  DISTINCT JobId, BatchId,QAID, JobName, ProcessCode, StatusString, AssignedTo, LastUpdate, Filename, JobId, State, ActualFile, HoldRemarks, DateRegistered, Status, ReworkBy,ReworkStatus FROM primo_view_Jobs INNER JOIN tblXMLFilename ON primo_view_jobs.Filename = tblXMLFilename.BatchFileName  Where  ProcessCode IN ('STYLING') AND statusstring ='DONE' AND STATUS='Rework' AND ReworkBy='$_SESSION[login_user]'  AND QAID='$StateName'";   

        }
        $isComplete=1;
        // echo $strSQL;
				$objExec= odbc_exec($conWMS,$strSQL);
		
				while ($row = odbc_fetch_array($objExec)) 
				{
      $status=$row["StatusString"];
				//$objResult=odbc_fetch_array($objExec,$i);   
      $BatchID=$row["Filename"];
      $ReworkBy=$row["ReworkBy"];
      $filename="uploadFiles/".$row["Filename"];
      $ReworkStatus=$row["ReworkStatus"];

      if ($ReworkStatus!="Completed"){
        $isComplete=0;
      }
?>
                <tr>
        <?php
        if ($_SESSION['UserType']=='Admin'){
        ?>
          <td> <input type="Checkbox" id="chk" name="chk[]" value="<?php echo $row["JobId"];?>"></td>
        <?php
        }
        ?>
                  <td>
                <?php
                echo $ReworkBy;
                  ?>
                  </td>
                   <td><?php echo $row["ReworkStatus"];?></td>
                  <td><?php echo $row["QAID"];?></td>
                  <td><a href="index.php?file=<?php echo $filename;?>&BatchID=<?php echo $row["BatchId"];?>&Status=Completed&Task=Rework" target="_blank"><?php echo $row["JobName"];?></a></td>
                  <td><?php echo $row["ActualFile"];?></td>
                  <td><?php echo $row["Filename"];?></td>
                  
                  <td><?php echo $row["AssignedTo"];?></td>
                  
                  <td><?php echo $row["State"];?></td>
                  <td><?php echo $row["DateRegistered"];?></td>
                   
                </tr>
            <?php
            }
            ?>
                </tbody>
              </table>

              <?php
          if ($_SESSION['UserType']=='Admin'){
            if ($isComplete==1){
            ?>
         <p align="right">
            <button type="submit" class="btn btn-warning"><i class="fa  fa-send"></i> Download</button></p>
          <?php
            }
          }
          ?>
              </form>
              
            </div>
      
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

  function AssignBatch(){

    var elements = document.getElementById("batchallocation").elements;
      
      for (var i = 0, element; element = elements[i++];) {
          if (element.type === "hidden")
             
             saveAssignment(element.value);
      }
    alert("Batches successfully assigned!");
  }

  function saveAssignment(BatchID){
    
      var f = document.getElementById("User"+BatchID);
     
    var strUser = f.options[f.selectedIndex].value;



      var jTextArea=BatchID+"@@@"+strUser;

      var data = 'data='+encodeURIComponent(jTextArea);
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
               // alert (xmlhttp.responseText);
        }
      }
      xmlhttp.open("POST","AllocateToUser.php",true);
            //Must add this request header to XMLHttpRequest request for POST
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      
      xmlhttp.send(data);
  }



</script>      
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

  <form method="post" action="AllocateBatchToUser.php">
      <div class="modal modal-primary fade" id="modal-success">
        <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Allocate Batch to User</h4>
          </div>
          <div class="modal-body">
           <input type="hidden" class="form-control" name="BatchID" id="BatchID" value="<?php echo "$BatchID";?>">
          <p>Are you sure you want to allocate this batch?</p>

          User Name:

            <select name="UserName" class="form-control select2" style="width: 100%;">
              <?php

            $strSQL="SELECT  * from tbluser where UserType='Operator'";
           if ($result=mysqli_query($con,$strSQL))
              {
              // Fetch one and one row
                while ($row=mysqli_fetch_array($result))
                {
                  $UserID=$row["id"];
                  $UserName=$row["UserName"];
                  echo "<option value=$UserID>$UserName</option>";
                   
                }
              }
              ?>
            </select>
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
          <button type="Submit" class="btn btn-outline">Allocate</button>
          </div>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </form>

     <form method="post" action="Rework.php">
      <div class="modal modal-primary fade" id="modal-Unhold">
        <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Rework Batch</h4>
          </div>
          <div class="modal-body">
           <input type="hidden" class="form-control" name="BatchID" id="BatchID1" value="<?php echo "$BatchID";?>">
          <p>Are you sure you want to reset this file?</p>

           
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
          <button type="Submit" class="btn btn-outline">Rework</button>
          </div>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </form>
 
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
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
