<?php
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
    

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<?php
$ConfigName=$_GET['Configuration'];
$ConfigName = str_replace(" ","",$ConfigName);
$ConfigName = str_replace(" ","",$ConfigName);
$ConfigName=$ConfigName."Configuration";
?>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="icon" href="innodata.png">
</head>
<body class="hold-transition fixed  ">
<div class="wrapper">

    <section class="content-header">
      <h1>
        <?php echo $_GET['Configuration'];?>
        
      </h1>
      
      <p></p>
    </section>

  <!-- Content Wrapper. Contains page content -->
   
      <div class="row">
  
   <?php


$sql="SELECT * FROM tblmlconfig";

?>
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
               
            <div class="box-body" >
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  
                  <th>SourceURL</th>
                  <th>Filename</th>
                  <th>Court</th>
                  <th>Case No.</th>
                  <th>Case Name</th>
                  <th>Note</th>
                  <th>Priority</th>
                  <th>Date Registered</th>
                  <th> </th>
                </tr>
                </thead>
                <tbody>
<?php

			 
        $strSQL = "SELECT * from view_Collections where ConfigName='".$ConfigName."'";

      $_SESSION['strSQL'] = $strSQL;
				$objExec= odbc_exec($conWMS,$strSQL);
				while ($row = odbc_fetch_array($objExec)) 
				{



          $nFilename=pathinfo($row["Filename"], PATHINFO_FILENAME);
          $ext = pathinfo($row["Filename"], PATHINFO_EXTENSION);

          $sFilename =$nFilename.".".$ext;


?>
                <tr>
                  <td><?php echo $row["RefID"];?></td>
                  <!-- <td><?php echo $row["SourceUrl"];?></td> -->
                  <td><?php echo $row["SourceURl"];?></td>
                  <td><?php echo $sFilename;?></td>
                  <td><?php echo $row["Court"];?></td>
                  <td><?php echo $row["CaseNumber"];?></td>
                  <td><?php echo $row["CaseName"];?></td>
                  <td><?php echo $row["Note"];?></td>
                  <td><?php echo $row["PriorityNo"];?></td>
                  
                  <td><?php echo $row["DateCreated"];?></td>
                <?php

                  echo "<td id=".$sFilename."><button id='btnRegister' onclick='FileRegistration(\"".$sFilename."\")'>Register</button></td>";
                   ?>  
  
                </tr>
      				  <?php
      				}
      			?>	  
                </tbody>
                
              </table>
            </div>
            <br>
            <a href="exporttoexcel.php" target="_blank">Export To Excel</a>
            
            <!-- /.box-body -->
           
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
   
 
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
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

<script type="text/javascript">
  function FileRegistration(Filename){
    var response=document.getElementById(Filename);
       
      var jTextArea = "";
      response.innerHTML="";
      var data = 'Filename='+encodeURIComponent(Filename);
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){

          response.innerHTML="Registered";
        }
      }
      xmlhttp.open("POST","FileRegistration.php",true);
            //Must add this request header to XMLHttpRequest request for POST
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      
      xmlhttp.send(data);
  }
</script>
</body>
</html>
