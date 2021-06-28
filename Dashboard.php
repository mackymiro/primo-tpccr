<?php
include "conn.php";
error_reporting(0);
session_start();
	if ($_SESSION['login_user']==''){
		 header("location: login.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tpccr </title>
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
  <script src="code/highcharts-3d.js"></script>
<script src="code/modules/data.js"></script>
<script src="code/modules/drilldown.js"></script>
 

<script src="bower_components/ckeditor/4.10.1/ckeditor.js"></script>
</head>

<body class="hold-transition fixed skin-blue sidebar-mini" >
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <?php

     if ($_SESSION['UserType']=='Admin'){
       echo '<a href="NewContent.php" class="logo">';
      }
      else{
        echo '<a href="Dashboard.php" class="logo">';
      }
      ?>
     


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

               <?php
            $UserId = $_SESSION['login_user'];
             if (file_exists("images/user/".$UserId.".jpg")) {  
              ?>
              <img src="images/user/<?=$UserId;?>.jpg"  class="user-image" alt="">
              <?php
             }
             else{
              ?>
               
               <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <?php
             }
              ?>
              <span class="hidden-xs"><?php echo $_SESSION['EName'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
            <?php
            $UserId = $_SESSION['login_user'];
             if (file_exists("images/user/".$UserId.".jpg")) {  
              ?>
              <img src="images/user/<?=$UserId;?>.jpg"  class="img-circle" alt="">
              <?php
             }
             else{
              ?>
               
               <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
              <?php
             }
              ?>
                <p>
                  <?php echo $_SESSION['EName'];?>
                  <small> <a href="#"  data-toggle='modal' data-target='#modal-success'>Update profile pic</a></small>
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
         Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
<?php
$dtTo= $_POST['dtTo'];
$dtFrom= $_POST['dtFrom'];
 
if ($dtTo==''){
  $dtTo =date("m/d/Y");
}
 
if ($dtFrom==''){
  $dtFrom =date("m/d/Y"); 
}

$prDateFrom = $dtFrom.' 12:00:00 AM';
$prDateTO = $dtTo.' 11:59:59 PM';
$username=$_SESSION['login_user'];
  $NewChapters=  GetWMSValue("Select Count(*) as TotalCount from primo_view_jobs  Where StatusString='New' AND LastUpdate>='$prDateFrom' AND LastUpdate<='$prDateTO' AND ProcessCode='STYLING' and SourceURL<>'test'","TotalCount",$conWMS);
 
  if ($NewChapters==''){
    $NewChapters=0;
  }

   $OnGoing=  GetWMSValue("Select Count(*) as TotalCount from  primo_view_jobs  Where StatusString IN ('Allocated','Started','Ongoing') AND LastUpdate>='$prDateFrom' AND LastUpdate<='$prDateTO' AND ProcessCode='STYLING' And AssignedTo='$username'","TotalCount",$conWMS);
 
  if ($OnGoing==''){
    $OnGoing=0;
  }

   $Hold=  GetWMSValue("Select Count(*) as TotalCount from  primo_view_jobs  Where StatusString='Hold' AND LastUpdate>='$prDateFrom' AND LastUpdate<='$prDateTO' AND ProcessCode='STYLING' And AssignedTo='$username'","TotalCount",$conWMS);
 
  if ($Hold==''){
    $Hold=0;
  }
    $Transmitted=  GetWMSValue("Select Count(*) as TotalCount from primo_view_jobs  Where StatusString='Done' AND LastUpdate>='$prDateFrom' AND LastUpdate<='$prDateTO' AND ProcessCode='STYLING' And AssignedTo='$username'","TotalCount",$conWMS);
 
  if ( $Transmitted==''){
     $Transmitted=0;
  }
?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $NewChapters;?></h3>

              <p>New Batches</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            <a style="cursor: pointer"  class="small-box-footer" href="ChapterList.php?dtFrom=<?php echo $prDateFrom; ?>&dtTo=<?php echo $prDateTO; ?>&Status=New" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbar=yes,resizable=yes,width=950,height=650'); return false;">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo  $OnGoing;?></h3>

              <p>On-Going</p>
            </div>
            <div class="icon">
              <i class="fa  fa-ellipsis-h"></i>
            </div>
             <a style="cursor: pointer"  class="small-box-footer" href="ChapterList.php?dtFrom=<?php echo $prDateFrom; ?>&dtTo=<?php echo $prDateTO; ?>&Status=On-Going" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbar=yes,resizable=yes,width=950,height=650'); return false;">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $Hold;?></h3>

              <p>Hold</p>
            </div>
            <div class="icon">
              <i class="fa fa-hand-stop-o "></i>
            </div>
             <a style="cursor: pointer"  class="small-box-footer" href="ChapterList.php?dtFrom=<?php echo $prDateFrom; ?>&dtTo=<?php echo $prDateTO; ?>&Status=Hold" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbar=yes,resizable=yes,width=950,height=650'); return false;">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $Transmitted;?></h3>

              <p>Completed</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a style="cursor: pointer"  class="small-box-footer" href="ChapterList.php?dtFrom=<?php echo $prDateFrom; ?>&dtTo=<?php echo $prDateTO; ?>&Status=Done" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbar=yes,resizable=yes,width=950,height=650'); return false;">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>



<div class="row">
<?php

$array = explode(',',GenerateGraphData($dtFrom,$dtTo,'New','ADM',$conWMS));
  $iCount=1;
   foreach ($array as $value)
  {
    if ($iCount==1){
      $A1=$value;
    }
    elseif ($iCount==2){
      $A2=$value;
    }
    elseif ($iCount==3){
      $A3=$value;
    }
    $iCount++;
  }
    
  $array = explode(',',GenerateGraphData($dtFrom,$dtTo,'On-Going','ADM',$conWMS));
  $iCount=1;
   foreach ($array as $value)
  {
    if ($iCount==1){
      $A6=$value;
    }
    elseif ($iCount==2){
      $A7=$value;
    }
    elseif ($iCount==3){
      $A8=$value;
    }
    $iCount++;
  }
   
  $array = explode(',',GenerateGraphData($dtFrom,$dtTo,'Hold','ADM',$conWMS));
  $iCount=1;
   foreach ($array as $value)
  {
    if ($iCount==1){
      $A11=$value;
    }
    elseif ($iCount==2){
      $A12=$value;
    }
    elseif ($iCount==3){
      $A13=$value;
    }
    $iCount++;
  }
   
    $array = explode(',',GenerateGraphData($dtFrom,$dtTo,'Done','ADM',$conWMS));
  $iCount=1;
   foreach ($array as $value)
  {
    if ($iCount==1){
      $A16=$value;
    }
    elseif ($iCount==2){
      $A17=$value;
    }
    elseif ($iCount==3){
      $A18=$value;
    }
    $iCount++;
  }
   




?>
        <div class="col-md-9">
          <div class="box box-primary">
            <form method="post">
            <div class="box-header with-border">
		          <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>

                  <input type="date" class="form-control" name="dtFrom" style="width: 200px" value="<?php echo $dtFrom;?>"><input type="date" class="form-control" name="dtTo" style="width: 200px" value="<?php echo $dtTo;?>"><button  class="form-control" style="width: 50px">Go</button>
                </div>
            </div>
            </form>
            <!-- /.box-header -->
          			<div class="box-body">
          				<div id="container"></div>

                 
                  <script type="text/javascript">
                    Highcharts.chart('container', {
                        chart: {
                            type: 'column',
                             options3d: {
                                  enabled: true,
                                  alpha: 15,
                                  beta: 15,
                                  viewDistance: 200,
                                  depth: 40
                              },
                              marginTop: 80,
                              marginRight: 40,
                              height:450
                        },
                        title: {
                            text: 'Batches Summary'
                        },
                         
                        plotOptions: {
                            column: {
                                depth: 25
                            }
                        },
                        xAxis: {
                            categories: ['Batches'],
                            labels: {
                                skew3d: true,
                                style: {
                                    fontSize: '16px'
                                }
                            }
                        },
                        yAxis: {
                            title: {
                                text: null
                            }
                        },
                         series: [{
                              name: 'New',
                              data: [<?php echo $A1;?>],
                              stack: 'male'
                          }, {
                              name: 'On-Going',
                              data: [<?php echo $A6;?>],
                              stack: 'male'
                          }, {
                              name: 'On-Hold',
                              data: [<?php echo $A11;?>],
                              stack: 'male'
                          }, {
                              name: 'Transmitted',
                              data: [<?php echo $A16;?>],
                              stack: 'male'
                          }]
                    });
                        </script> 
                  
            </div>
          
          </div>
          <!-- /. box -->

        </div>
          <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-header">
                  <h3 class="box-title">Today's Performance</h3>
                   <div class="box-tools pull-right">
                  <button type="button" class="btn  btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
                </div>
                <div class="box-body">

                  <?php 
                   
                    $Quota=  GetWMSValue("Select Quota from wms_WorkFlowProcesses Where ProcessID=7","Quota",$conWMS);

                    
                    $pdtTo =date("m/d/Y");
                 
                    $pdtFrom =date("m/d/Y"); 
                 
                  $pDateFrom = $pdtFrom.' 12:00:00 AM';
                  $pDateTO = $pdtTo.' 11:59:59 PM';
                  $username=$_SESSION['login_user'];

                    $Completed=  GetWMSValue("Select Count(*) as TotalCount from primo_view_jobs  Where StatusString='Done' AND LastUpdate>='$pDateFrom' AND LastUpdate<='$pDateTO' AND ProcessCode='DATAEXTRACTION' And AssignedTo='$username'","TotalCount",$conWMS);
 
                     $Productivity = ($Completed/$Quota)*100;

                  ?>

                    <div class="progress-group">
                      <span class="progress-text">Productivity</span>
                      <span class="progress-number"><b> <a style="cursor: pointer"  class="small-box-footer" href="TATPerformance.php?dtFrom=<?php echo $prDateFrom; ?>&dtTo=<?php echo $prDateTO; ?>&Status=Completed" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbar=yes,resizable=yes,width=950,height=650'); return false;"><?php echo $Completed;?></b>/<?php echo $Quota;?></a></span>

                      <div class="progress sm">
                        <div class="progress-bar progress-bar-aqua" style="width: <?php echo  $Productivity;?>%"></div>
                      </div>
                    </div>
                     
                </div>
                  
              </div>
              
               <div class="box box-solid">
                <div class="box-header">
                  <h3 class="box-title">Top Performer</h3>
                   <div class="box-tools pull-right">
                  <button type="button" class="btn  btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
                </div>
                <div class="box-body">

                  <?php 
                    
                    
                    
                  // $pdtTo =date("m/d/Y");
                 
                  // $pdtFrom =date("m/d/Y"); 

                  $pdtFrom= $_POST['dtTo'];
                  $pdtFrom= $_POST['dtFrom'];
                   
                  if ($pdtFrom==''){
                    $pdtFrom =date("m/d/Y");
                  }
                   
                  if ($pdtFrom==''){
                    $pdtFrom =date("m/d/Y"); 
                  }
                 
                  $pDateFrom = $pdtFrom.' 12:00:00 AM';
                  $pDateTO = $pdtTo.' 11:59:59 PM';
                  
                  ?>

                     <ul class="products-list product-list-in-box">
<?php
    $sql ="select Top 5 UserName,EmployeeName, AVG(X3) As X3 from wms_view_ProductivityUserWithX3 WHERE Date>='$pDateFrom' AND Date<='$pDateTO' Group By EmployeeName,UserName ORDER BY X3 DESC";
 
    $rs=odbc_exec($conWMS,$sql);
    $ctr = odbc_num_rows($rs);
    while(odbc_fetch_row($rs))
    {
    
   
?>
                    <li class="item">
                        <div class="product-img">
                          <?php

                          $UserId=odbc_result($rs,"UserName");
                           
                          if (file_exists("images/User/".$UserId.".jpg")) {  

                          ?>

                          <img src="images/User/<?=$UserId;?>.jpg" class="img-circle" alt="">
                          <?php
                        }
                          else{
                          ?>
                          <img src="images/default.jpg" alt=""  class="img-circle">
                          <?php
                          }
                          ?>

                        </div>
                        <div class="product-info">
                          <a href="javascript:void(0)" class="product-title">
                            <span class="label label-info pull-right"><?=odbc_result($rs,"X3");?></span></a>
                          <span class="product-description">
                               <?=odbc_result($rs,"EmployeeName");?>
                              </span>
                        </div>
                      </li>
                     
<?php
 }
    
?>
                    </ul>
                     
                </div>
                  
              </div>
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
 
 <div class="modal modal-info fade" id="modal-success">
        <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Profile Picture</h4>
          </div>
          <div class="modal-body">
              <div class="form-group" id="divAttachment">
                <label>Profile Pic</label><br>
                  <input type="file" class="form-control" id="txtAttachFile"  >
              </div>

          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
          <button type="Submit" class="btn btn-outline" data-dismiss="modal" onclick="saveQuery()">Save</button>
          </div>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<script>

   function _getVal(el){
  return document.getElementById(el);
}

function saveQuery(){
  var file = _getVal("txtAttachFile").files[0];
  
 
  var formdata = new FormData();
  formdata.append("txtAttachFile", file);
  
  var ajax = new XMLHttpRequest();
 
  ajax.open("POST", "saveQuery.php");
  ajax.send(formdata);
  setTimeout(LoadContent, 1000);
  alert("Query is successfully added!");
}

  function DisplayImageAttachment(){
        
      var response=document.getElementById("FileList");
      //var jTextArea=document.getElementById("jTextArea").value;
      response.innerHTML=="";
      prBookID=document.getElementById("BookID").value;
      var jTextArea = prBookID+"/" +"Images";
      var data = 'data='+encodeURIComponent(jTextArea);
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
          response.innerHTML=xmlhttp.responseText;
        }
      }
      xmlhttp.open("POST","ReadFile.php",true);
            //Must add this request header to XMLHttpRequest request for POST
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      
      xmlhttp.send(data);
      
  }
  
</script>

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
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
 <script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
  
</body>
</html>
