<?php
include "conn.php";
error_reporting(0);
	session_start();
	$fileVal=$_GET['file'];
	if ($fileVal==''){
		$fileVal=$_SESSION['file'];
	}
	$_SESSION['file']=$fileVal;
	$sFileVal =explode('/',$fileVal);
	
	$Task=$_GET['Task'];
	if ($Task==''){
		$Task=$_SESSION['Task'];
	}
	$_SESSION['Task']=$Task;
	
	if ($_SESSION['login_user']==''){
		 header("location: login.php");
	}
	
	
	$BatchID=$_GET['BatchID'];
	if ($BatchID==''){
		$BatchID=$_SESSION['BatchID'];
		
	}
		$_SESSION['BatchID']=$BatchID;
	
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
$Status=$_GET['Status'];
if(isset($_POST['submit'])){//to run PHP script on submit
	if(!empty($_POST['Classification'])){
		$file= explode('.',$sFileVal[1]);
		
		$sText ='';
	// Loop to store and display values of individual checked checkbox.
		foreach($_POST['Classification'] as $selected){
			$sText=$sText.$selected."\r\n";
		}
		file_put_contents("uploadfiles/$file[0].cls", $sText);
	}	
}

//GET TASK ID

$sql="SELECT * FROM wms_Processes Where ProcessCode='$Task'";	
					
	$rs=odbc_exec($conWMS,$sql);
	 
	while(odbc_fetch_row($rs))
	{
		$TaskID=odbc_result($rs,"ProcessID");
	}

//GET taskeditorsetting
$sql="SELECT * FROM tbltaskeditorsetting Where TaskID='$TaskID'";
 
if ($result=mysqli_query($con,$sql))
{
// Fetch one and one row
	while ($row=mysqli_fetch_row($result))
	{
		$Source=$row[1];
		$Styling=$row[2];
		$XMLEditor=$row[3];
		$SequenceLabeling=$row[4];
		$TextCategorization=$row[5];
		$DataEntry=$row[6];
		$TreeView=$row[7];
	}
}
	
?>
<!DOCTYPE html>
<html class="no-js">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
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
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<link rel="stylesheet" href="plugins/iCheck/all.css">
	
	
	 
	
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<script type="text/javascript">
  function resizeIframe(obj){
     obj.style.height = 0;
     obj.style.height = '80%';
  }
</script>

 
<?php
$file= explode('.',$sFileVal[1]);

if (file_exists("uploadfiles/$file[0].xml")) {   
	$sXML = file_get_contents("uploadfiles/$file[0].xml");
	//$sXML=_utf8_decode($sXML);
 
}
?>
 
  
<script src="bower_components/ckeditor/4.10.1/ckeditor.js"></script>
 
<script>
function myFunction95() {
    var x = document.getElementById("myDIV95");
	var x1 = document.getElementById("myDIV80");
	var x2 = document.getElementById("myDIV79");
	var x3 = document.getElementById("myDIVEdited");
	
    
	x.style.display = "block";
	x1.style.display = "none";
	x2.style.display = "none";
	x3.style.display = "none";
}
function myFunction80() {
    var x = document.getElementById("myDIV95");
	var x1 = document.getElementById("myDIV80");
	var x2 = document.getElementById("myDIV79");
    var x3 = document.getElementById("myDIVEdited");
	
	x1.style.display = "block";
	x.style.display = "none";
	x2.style.display = "none";
	x3.style.display = "none";
}
function myFunction79() {
    var x = document.getElementById("myDIV95");
	var x1 = document.getElementById("myDIV80");
	var x2 = document.getElementById("myDIV79");
    var x3 = document.getElementById("myDIVEdited");
	
	x2.style.display = "block";
	x.style.display = "none";
	x1.style.display = "none";
	x3.style.display = "none";
	
}
function myFunctionEdited() {
    var x = document.getElementById("myDIV95");
	var x1 = document.getElementById("myDIV80");
	var x2 = document.getElementById("myDIV79");
    var x3 = document.getElementById("myDIVEdited");
	
	x3.style.display = "block";
	x.style.display = "none";
	x1.style.display = "none";
	x2.style.display = "none";
	
}
</script>


 <style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>
<script type="text/javascript"><!--
function check() {
    if(document.getElementById('password').value ===
            document.getElementById('confirm_password').value) {
        document.getElementById('message').innerHTML = "";
		document.getElementById("Button").disabled = false;
    } else {
        document.getElementById('message').innerHTML = "password not match";
		document.getElementById("Button").disabled = true;
    }
}
//--></script>

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
	
	<link rel="icon" href="innodata.png">
	
	<!--code mirror-->
	<link rel="stylesheet" href="lib/codemirror.css">
  <link rel="stylesheet" href="addon/fold/foldgutter.css" />
  <link rel="stylesheet" href="addon/dialog/dialog.css">
  <link rel="stylesheet" href="addon/search/matchesonscrollbar.css">
  <link rel="stylesheet" href="addon/hint/show-hint.css">
  
    <script src="addon/hint/show-hint.js"></script>
  <script src="addon/hint/xml-hint.js"></script>
  <script src="addon/hint/html-hint.js"></script>
  
  <script src="lib/codemirror.js"></script>
  <script src="addon/fold/foldcode.js"></script>
  <script src="addon/fold/foldgutter.js"></script>
  <script src="addon/fold/brace-fold.js"></script>
  <script src="addon/fold/xml-fold.js"></script>
  <script src="addon/fold/markdown-fold.js"></script>
  <script src="addon/fold/comment-fold.js"></script>
  <script src="mode/javascript/javascript.js"></script>
  <script src="mode/xml/xml.js"></script>
  <script src="mode/markdown/markdown.js"></script>
  
	<script src="addon/search/searchcursor.js"></script>
	<script src="addon/search/search.js"></script>
	<script src="addon/search/jump-to-line.js"></script>
	<script src="addon/dialog/dialog.js"></script>
	<script src="addon/edit/matchtags.js"></script>
  
  <style type="text/css">
    .CodeMirror {border-top: 1px solid black; border-bottom: 1px solid black; height: 32vw;}
	.CodeMirror-selected  { background-color: skyblue !important; }
      .CodeMirror-selectedtext { color: white; }
      .styled-background { background-color: #ff7; }
  </style>
 <script src="addon/display/fullscreen.js"></script>
	<!--END-->
	
	<!--View Current Status-->
<?php
$sql="SELECT * FROM primo_view_Jobs Where ProcessCode='$Task' AND BatchID='$BatchID'";	
		
		$rs=odbc_exec($conWMS,$sql);
		$ctr = odbc_num_rows($rs);
		while(odbc_fetch_row($rs))
		{
			 
			$FileStatus=odbc_result($rs,"StatusString");
			
			
		}
		?>

 </head>
<body class="hold-transition skin-blue sidebar-mini"  onload="start()">
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
              <span class="hidden-xs">Test User</span>
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
        File: <?php echo $sFileVal[1];?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Document Editor</li>
		<li><a href="fullscr.php"><i class="fa fa-copy"></i> Split View</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
         
         
          <!-- /. box -->
		   <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Allocation Details</small></h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
			<?php
			$sql="SELECT * FROM primo_view_Jobs Where ProcessCode='$Task' AND BatchID='$BatchID'";	
					
					$rs=odbc_exec($conWMS,$sql);
					$ctr = odbc_num_rows($rs);
					while(odbc_fetch_row($rs))
					{
						$Jobname=odbc_result($rs,"Jobname");
						$StatusString=odbc_result($rs,"StatusString");
						$LastUpdate=odbc_result($rs,"LastUpdate");
						
					}
					
					
			if ($StatusString=='Allocated'){
				$sql="SELECT * FROM tblmlconfig";
				if ($result=mysqli_query($con,$sql))
				 {
				  // Fetch one and one row
				  while ($row=mysqli_fetch_row($result))
					{
						$_SESSION[$row[1]]='';
						
						
							
					}
				}
			 

			}
			elseif($StatusString=='Ongoing'){
				 
				$sql="SELECT tblmlconfig.id,tblmlconfig.MLName,tblmlconfig.Endpoint,tbltaskml.Autoload FROM tblmlconfig INNER JOIN tbltaskml ON tblmlconfig.id=tbltaskml.MLID  WHERE tbltaskml.Autoload=1 AND  tbltaskml.TaskID='$TaskID'";
				 
				if ($result=mysqli_query($con,$sql))
				  {
				  // Fetch one and one row
				  while ($row=mysqli_fetch_row($result))
					{
						if ($row[3]==1){
						
							if ($_SESSION[$row[1]]==''){
								?>
								<script language="javascript">
									window.location = "<?php echo $row[2];?>?FileURL=../uploadFiles/<?php echo $sFileVal[1];?>&FileName=<?php echo $sFileVal[1];?>&RedirectURL=https://10.160.0.88/primo/index.php&ID=<?php echo $row[0];?>";
								</script>
								
								<?php
								$_SESSION[$row[1]]=1;
							}
						
						}
								 
						  
					}
				}
				 
				
			}
					
			?>
			
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
              	 <li><a href="#"><i class="fa fa-file-o"></i>FileName: <u><?php echo $Jobname;?></u></a></li>
			    <li><a href="#"><i class="fa fa-file-o"></i>JobName: <u><?php echo $Jobname;?></u></a></li>
				<li><a href="#"><i class="fa fa-line-chart"></i>Status: <u><?php echo $StatusString;?></u></a></li>
                <li><a href="#"><i class="fa fa-clock-o"></i>Last Updated: <u><?php echo $LastUpdate;?></u></a></li>
				 
				<?php
				if ($Status=='' && $StatusString=='Allocated'){
				?>
				
					<div class="box-footer with-border">
				   
				  <div class="box-tools">
					 <li><button type="button" class="btn btn-default  pull-right"  data-toggle="modal" data-target="#modal-Start"  onclick="Javascript:SetTextBoxValue1(<?php echo $BatchID;?>)"><i class="fa fa-hourglass-start"></i> Start</button></li>
					 </div>
					</div>
				<?php
				}
				elseif($StatusString=='Ongoing'){
					 
					?>
				<div class="box-footer with-border">
				   
				  <div class="box-tools">
					 <li> <button type="button" class="btn btn-default  pull-right"  data-toggle="modal" data-target="#modal-success"  onclick="Javascript:SetTextBoxValue(<?php echo $BatchID;?>)"><i class="fa fa-check"></i> Set as completed</button>&nbsp;<button type="button" class="btn btn-default pull-right"  data-toggle="modal" data-target="#modal-Pending"  onclick="Javascript:SetTextBoxValue2(<?php echo $BatchID;?>)"><i class="fa fa-hourglass-2"></i> Pending</button></li>
					 </div>
					</div>	
				<?php
					 
				}
				elseif($StatusString=='Pending'){
					?>
				<div class="box-footer with-border">
				   
				  <div class="box-tools">
					 <li><button type="button" class="btn btn-default  pull-right"  data-toggle="modal" data-target="#modal-Start"  onclick="Javascript:SetTextBoxValue1(<?php echo $BatchID;?>)"><i class="fa fa-hourglass-start"></i> Resume</button></li>
					 </div>
					</div>
				<?php
				}
				?>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
<?php
if ($SequenceLabeling==1){
	
?>		 
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Sequence Labelling-<small>Confidence Level Filter</small></h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
			<?php

			if ($FileStatus!='Done'){
			$file= explode('.',$sFileVal[1]);
			$above95=GetWMSValue("Select * from tblConfidenceLevel WHERE Filename='$file[0]' AND Type='95% and up'","Count",$conWMS);
			$above80=GetWMSValue("Select * from tblConfidenceLevel WHERE Filename='$file[0]' AND Type='80 to 94%'","Count",$conWMS);
			$above70=GetWMSValue("Select * from tblConfidenceLevel WHERE Filename='$file[0]' AND Type='79% and below'","Count",$conWMS);
			
			?>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
			  <?php 
			  if ($above95==0){
				  
			  ?>
				<li><a onclick="return false;" ><i class="fa fa-circle text-green"></i> 95% and up <small>(Total Refs.<?php echo $above95;?>)</small></a></li>
			<?php
			  }
			  else
			  {
			?>
				<li><a href="#" onclick="myFunction95()"><i class="fa fa-circle text-green"></i> 95% and up <small>(Total Refs.<?php echo $above95;?>)</small></a></li>
			<?php
			  }
			  if ($above80==0){
			  ?>
                <li> <a onclick="return false;" ><i class="fa fa-circle text-red"></i> 80-94% <small>(Total Refs.<?php echo $above80;?></small>) </a></li>
			  <?php
			  }
			  else{
				?>
			  <li><a href="#" onclick="myFunction80()"><i class="fa fa-circle text-red"></i> 80-94% <small>(Total Refs.<?php echo $above80;?></small>)</a></li>
			<?php
			  }
			   if ($above70==0){
			  ?>
			  
                <li><a onclick="return false;" ><i class="fa fa-circle text-yellow"></i> 79% and below <small>(Total Refs.<?php echo $above70;?>)</small></a></li>
				<?php
			   }
			   else{
				   
				?>
				<li><a href="#" onclick="myFunction79()"><i class="fa fa-circle text-yellow"></i> 79% and below <small>(Total Refs.<?php echo $above70;?>)</small></a></li>
				<?php
			   }
			
				?>
                <li><a href="#" onclick="myFunctionEdited()"><i class="fa fa-circle text-light-blue"></i> edited</a></li>
              </ul>
            </div>
<?php
			   }
			
				?>
            <!-- /.box-body -->
          </div>
<?php
}
?>		  
		  <div class="box box-solid" style="display: none" id="myDIV95">
            <div class="box-header with-border">
              <h3 class="box-title">95% and up</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
			  <?php
			  
							 
				if (file_exists("uploadfiles/$file[0].htm")) {   
				 
					$sTxt =  file_get_contents("uploadfiles/$file[0].htm"); 
					$arrLine= explode("<div ", $sTxt);
					$ctrL=0;
					foreach($arrLine as $sLtr){
						$ctrL++;
						$arr_string = explode('<span class="above95">',$sLtr);
						$ctr=0;
						//foreach loop to display the returned array
						foreach($arr_string as $str){
							if ($ctr!=0){
								$lVal=explode('</span>',$str); 
								
							?>
							<li><a onclick="FindNext(<?php echo $ctrL;?>);" href="#tab_2-2"><i class="fa fa-circle text-green"></i><?php echo $lVal[0];?></a></li>
							<?php
							}
							$ctr++;
						}
					}
					
				}
				?>
				
              </ul>
			   
            </div>
            <!-- /.box-body -->
          </div>
		  
		   <div class="box box-solid" style="display: none"  id="myDIV80">
            <div class="box-header with-border">
              <h3 class="box-title">80-94%</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
			    <?php
			  $file= explode('.',$sFileVal[1]);
							 
				if (file_exists("uploadfiles/$file[0].htm")) {   
				 
					$sTxt =  file_get_contents("uploadfiles/$file[0].htm"); 
					$arrLine= explode("<div ", $sTxt);
					$ctrL=0;
					foreach($arrLine as $sLtr){
						$ctrL++;
						$arr_string = explode('<span class="above80">',$sLtr);
						$ctr=0;
						//foreach loop to display the returned array
						foreach($arr_string as $str){
							if ($ctr!=0){
								$lVal=explode('</span>',$str); 
								
							?>
							<li><a onclick="FindNext(<?php echo $ctrL;?>);" href="#tab_2-2"><i class="fa fa-circle text-red"></i><?php echo $lVal[0];?></a></li>
							<?php
							}
							$ctr++;
						}

					}
				 
				}
				?>
				
			 
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
		  
		    <div class="box box-solid" style="display: none"  id="myDIV79">
            <div class="box-header with-border">
              <h3 class="box-title">79% and below</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
			  <?php
			  $file= explode('.',$sFileVal[1]);
							 
				if (file_exists("uploadfiles/$file[0].htm")) {   
				 
					$sTxt =  file_get_contents("uploadfiles/$file[0].htm"); 
					$arrLine= explode("<div ", $sTxt);
					$ctrL=0;
					foreach($arrLine as $sLtr){
						$ctrL++;
							
						$arr_string = explode('<span class="below79">',$sLtr);
						$ctr=0;
						//foreach loop to display the returned array
						foreach($arr_string as $str){
							if ($ctr!=0){
								$lVal=explode('</span>',$str); 
								
							?>
							<li><a onclick="FindNext(<?php echo $ctrL;?>);" href="#tab_2-2"><i class="fa fa-circle text-yellow"></i><?php echo $lVal[0];?></a></li>
							<?php
							}
							$ctr++;
						}
					}
				}
				?>
              </ul>
            </div>
            <!-- /.box-body -->
			
			
	<script type="text/javascript">
	function FindNext (prPosition) {
		var value = CKEDITOR.instances['editor1'].getData();
	
		var editor =CKEDITOR.instances['editor1'];
		
		CKEDITOR.instances['editor1'].focus();
	 
		var range = editor.createRange();
		var node = editor.document.getBody().getFirst();
		var parent = node.getParent();
		 range.collapse();

		range.setStart(parent,prPosition);
		//range.setStart(range.root,prPosition);
		//range.setStart(range.root, prPosition );
		//editor.getSelection().selectRanges( [ range ] );
		range.scrollIntoView();
		 
	}
	</script>
			
          </div>
		  
		    <div class="box box-solid" style="display: none"  id="myDIVEdited">
            <div class="box-header with-border">
              <h3 class="box-title">Edited</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
			  <?php
			  $file= explode('.',$sFileVal[1]);
							 
				if (file_exists("uploadfiles/$file[0].htm")) {   
				 
					$sTxt =  file_get_contents("uploadfiles/$file[0].htm"); 
					$arr_string = explode('<span class="edited">',$sTxt);
					$ctr=0;
					//foreach loop to display the returned array
					foreach($arr_string as $str){
						if ($ctr!=0){
							$lVal=explode('</span>',$str); 
							
						?>
						<li><a href="#tab_2-2"><i class="fa fa-circle text-yellow"></i><?php echo $lVal[0];?></a></li>
						<?php
						}
						$ctr++;
					}

				}
				?>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
		  
		  <?php
		  if ($TextCategorization==1){
			  
		  ?>
		   <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Categorization</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
			
				<div class="input-group input-group-sm">
				   <select class="form-control select2" style="width: 100%;" id="candidate">
				   
				   <?php
				   $Casefile = fopen("Category.tbl","r");

				while(! feof($Casefile))
				  {
					  $keyword=fgets($Casefile);
					  if(trim($keyword)!=""){
				   ?>
					  <option selected="selected"><?php echo $keyword;?></option>
					  <?php
					  }
				  }
					  ?>
					</select>
					<span class="input-group-btn">
					  <button type="button" class="btn btn-info btn-flat"  onclick="addItem()">Add</button>
					</span>
				</div>
				
				 
				<form method="POST" action="#"> 
              <ul class="nav nav-pills nav-stacked" id="dynamic-list">
			  <li> 
			</li>
			  <?php
			  if ($fileVal!=''){
				  
			  $file= str_replace(".pdf",".cls",$sFileVal[1]);
			  if (file_exists("uploadfiles/$file")) {
			  $Casefile = fopen("uploadfiles/$file","r");

				while(! feof($Casefile))
				  {
					  $keyword=fgets($Casefile);
					  if(trim($keyword)!=""){
				?>
				<li><a><i class="fa fa-circle text-green"></i> <?php echo $keyword;?> <input name="Classification[]" type="checkbox" class="pull-right" value ="<?php echo $keyword;?>" checked  ></a> </li>
                <?php
					  }
				  }
				}
			  }
				  ?>
				  
				   
              </ul>
			  <div class="box-footer with-border">
				   
				  <div class="box-tools">
					<?php
					if ($StatusString=='Ongoing'){
					?>
					<button type="submit" name="submit" class="btn btn-success btn-flat pull-right">Update</button>
					<?php
					}
					?>
					</button>
				  </div>
				</div>
				  </form>
            </div>
			
            <!-- /.box-body -->
          </div>
		  <?php
		  }
		  ?>
          <!-- /.box -->
        </div>
        <!-- /.col -->
       	
	   
	   <div class="col-md-9">
	     <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
			<?php
			if ($TreeView==1){
				
			?>
              <li ><a href="#tab_2-1" data-toggle="tab">Tree View</a></li>
			  <?php
			}
			?>
			<?php
			if ($DataEntry==1){
				
			?>
              <li ><a href="#tab_1-0" data-toggle="tab">Data Entry</a></li>
			  <?php
			}
			?>
			<?php
			if ($XMLEditor==1){
				
			?>
              <li ><a href="#tab_1-1" data-toggle="tab">XML Editor</a></li>
			  <?php
			}
			?>
			<?php
			if ($Styling==1){
				
			?>
              <li><a href="#tab_2-2" data-toggle="tab">Styling</a></li>
			<?php
			}
			if ($Source==1){
			
			?>
			
              <li class="active"><a href="#tab_3-2" data-toggle="tab">Source</a></li>
			 <?php
			}
			?>
			  
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  ML <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
				<?php
			 
					
			$sql="SELECT * FROM tblmlconfig INNER JOIN tbltaskml ON tblmlconfig.id = tbltaskml.MLID Where TaskID='$TaskID'";
				if ($result=mysqli_query($con,$sql))
					  {
					  // Fetch one and one row
					  while ($row=mysqli_fetch_row($result))
						{
							
							if ($_SESSION[$row[1]]==1){
								
					?>
									  <li role="presentation" ><a role="menuitem" tabindex="-1" href="preloader/index.php?APIURL=../<?php echo $row[2];?>&FileURL=../uploadFiles/<?php echo $sFileVal[1];?>&MLName=<?php echo $row[1];?>&FileName=<?php echo $sFileVal[1];?>&RedirectURL=https://10.160.0.88/primo/index.php&ID=<?php echo $row[0];?>"><i class="fa fa-fw fa-check"></i><?php echo $row[1];?></a></li>
									  
							  <?php
							}
							else{
								?>
								<li role="presentation" ><a role="menuitem" tabindex="-1" href="preloader/index.php?APIURL=../<?php echo $row[2];?>&FileURL=../uploadFiles/<?php echo $sFileVal[1];?>&MLName=<?php echo $row[1];?>&FileName=<?php echo $sFileVal[1];?>&RedirectURL=https://10.160.0.88/primo/index.php&ID=<?php echo $row[0];?>"><i class="fa fa-fw  fa-circle-o"></i><?php echo $row[1];?></a></li>
							<?php
							}
						}
					}
				 
?>				  
				  
                </ul>
              </li>
              <li class="pull-left header"><i class="fa fa-th"></i> </li>
            </ul>
			   
            <div class="tab-content" >
			<div class="tab-pane " id="tab_2-1" >
				<div class="row">
					<div class="col-lg-6">
						<iframe src="test.html"  style="width:50vw; height:37vw;"  frameBorder="0" scrolling="no"></iframe>
					 </div>
				</div>

				
				</div>
				<div class="tab-pane " id="tab_1-0" >
					<fieldset>

					    <div class="form-group">
					<label>Agreement Title</label><br>
					 <input type="text" class="form-control" placeholder="Agreement Title" name="Name" value="<?php echo $Name;?>">
				  </div>
				  <div class="form-group">
					<label>Parties</label><br>
					 <input type="text" class="form-control" placeholder="Parties" name="UserName" value="<?php echo $UserName;?>">
				  </div>
				  <div class="form-group">
					<label>Date</label><br>
					<input type="date" class="form-control" placeholder="Date" name="UserName" value="<?php echo $UserName;?>">  
				  </div>
				  <div class="form-group">
					<label>Deal Value/Purchase Price</label><br>
					 <input type="text" class="form-control" placeholder="Deal Value/Purchase Price" name="UserName" value="<?php echo $UserName;?>">
				  </div>
				  <div class="form-group">
					<label >R&W Insurance</label><br>
					<select class="form-control" name="UserType">
						<option value="No">No</option>
						<option value="Yes">Yes</option>
					</select>
				  </div>
				  <div class="form-group">
					<label>Who pays premium?</label><br>
					 <input type="text" class="form-control" placeholder="Who pays premium?" name="UserName" value="<?php echo $UserName;?>">
				  </div>
				  <div class="form-group">
					<label>Termination Fee</label><br>
					 <input type="text" class="form-control" placeholder="Termination Fee" name="UserName" value="<?php echo $UserName;?>">
				  </div>
				   <div class="form-group">
					<label>Termination Fee Triggers</label><br>
					 <input type="text" class="form-control" placeholder="Termination Fee Triggers" name="UserName" value="<?php echo $UserName;?>">
				  </div>
				   <div class="form-group">
					<label>Reverse Termination Fee</label><br>
					 <input type="text" class="form-control" placeholder="Reverse Termination Fee" name="UserName" value="<?php echo $UserName;?>">
				  </div>
				  <div class="form-group">
					<label >No-Shop</label><br>
					<select class="form-control" name="UserType">
						<option value="No">No</option>
						<option value="Yes">Yes</option>
					</select>
				  </div>
				  <div class="form-group">
					<label>Go-Shop Duration</label><br>
					 <input type="text" class="form-control" placeholder="Reverse Termination Fee" name="UserName" value="<?php echo $UserName;?>">
				  </div>
				  <div class="form-group">
					<label >Force-the-Vote</label><br>
					<select class="form-control" name="UserType">
						<option value="No">No</option>
						<option value="Yes">Yes</option>
					</select>
				  </div>
				   <div class="form-group">
					<label >Match Right</label><br>
					<select class="form-control" name="UserType">
						<option value="No">No</option>
						<option value="Yes">Yes</option>
					</select>
				  </div>
					 
					
					</fieldset>
					
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane " id="tab_1-1"  >
				
					<fieldset>
					<div class="form-group" style="width:100%; height:35vw;">
					<?php

					if ($FileStatus!='Done'){
					?>

					<textarea id="code" rows="100"  name="test_1"><?php echo $sXML;?></textarea>
					<?php
					}
					else{
						?>
					<textarea id="code" rows="100"  name="test_1"></textarea>
						<?php
					}
					?>
					
					<script id="script">
					/*
					 * Demonstration of code folding
					 */
				 
					 
					  var te_html = document.getElementById("code");
					 
					 
					  var editor_html = CodeMirror.fromTextArea(te_html, {
						mode: "text/xml",
						lineNumbers: true,
						matchTags: {bothTags: true},
						lineWrapping: true,
						extraKeys: {"Ctrl-Q": function(cm){ cm.foldCode(cm.getCursor()); }},
						foldGutter: true,
						styleActiveLine: true,
						styleActiveSelected: true,
						styleSelectedText: true,
						gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"]
					  });
					   
					editor_html.refresh();
					 
					  </script>
					  
					   <script>
					  function jumpToLine(prLineNo,prCol){
						  
						editor_html.refresh();
						editor_html.setCursor(prLineNo);
						
						editor_html.markText({line: prLineNo, ch: prCol}, {line: prLineNo, ch: prCol+5}, {className: "styled-background"});
					  }
					  </script>
					<br>
						<div class="pull-right">
						<form method ="post" action="API/ExecutePlugin2.php">
						<?php

					if ($FileStatus!='Done'){
					?>
						<textarea   name="editor2" style="display:none;"><?php echo $sXML;?></textarea>
					<?php
					}
					else{
					?>
					<textarea   name="editor2" style="display:none;"></textarea>
					<?php
					}
					?>


							<input type="hidden" name="fileVal" value="<?php echo "$file[0].xml";?>">
							<select  name="Plugin">
						   <?php
						   $sql="SELECT * FROM tbltaskplugin WHERE UI='XMLEditor'";
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
								  <option value="<?php echo $PluginName;?>"><?php echo $PluginName;?></option>
								<?php 
								}
							  }
							  ?>
							</select>  <button type="submit" class="btn btn-success .btn-sm">Execute</button>
						</form>
					</div>
					
					
					
					</div>
					</fieldset>
					<?php
					
			  if ($fileVal!=''){
				  
			  $file= str_replace(".pdf",".log",$sFileVal[1]);
			  if (file_exists("uploadfiles/$file")) {
				  ?>
					<table style="width: 100%" cellpadding="0" cellspacing="0">
<tr>
  <td style="width: 80px;"></td>	
  <td style="width: 300px;"><b>Description</b></td>
  <td style="width: 100px;"><b>Line No</b></td>
  <td style="width: 100px;"><b></b></td>
</tr>
</table>

<div style="overflow: auto;height: 100px; width: 100%;">
  <table style="width: 100%;" cellpadding="0" cellspacing="0">
    <?php
			  $Casefile = fopen("uploadfiles/$file","r");

				while(! feof($Casefile))
				  {
					  $keyword=fgets($Casefile);
					if(trim($keyword)!=""){  
				?>
			 
                
  <tr>
	<td style="width: 80px;" align="center"><input type="checkbox"></td>
     
	<?php
			$ctr=1;
			$lineNo="";

				  $cats = explode("\t", $keyword);
				 foreach($cats as $cat) {
					$cat = trim($cat);
					if ($ctr==1){
						?>
						<td style="width: 300px;"><?php echo $cat;?></td>
					<?php	
					}
					elseif($ctr==2){
						$lineNo=$cat;
						?>
						<td style="width: 100px;">   <?php echo $cat;?></td>
						<?php
					}
					else{
						?>
						<td style="width: 100px;"><a href="#" onClick="jumpToLine(<?php echo $lineNo;?> ,<?php echo $cat;?>);" >Check</a></td>
						<?php
					}
					$ctr++;
				}
	?>
	
  </tr>
   <?php
					  }
				  }
				 
				  ?>
  </table>
</div>
<br>
<?php
	}
  }
	  ?>
              </div>
              <!-- /.tab-pane -->
			  
	
			  
			  
              <div class="tab-pane" id="tab_2-2">
			    <form method ="post" action="API/saveFile.php">
                <div class="box-body pad">
			
						<textarea id="editor1" name="editor1" rows="100" cols="80">
							<?php

					if ($FileStatus!='Done'){
					 
							//Read TXT FILE AND LOAD IT ON EDITOR
							$file= explode('.',$sFileVal[1]);
							 
							if (file_exists("uploadfiles/$file[0].htm")) {   
								$sFile= file_get_contents("uploadfiles/$file[0].htm");
								//echo readfile("uploadfiles/$file[0].htm"); 
							}
							else{
								$sFile= file_get_contents("uploadfiles/$file[0].html");
								//echo readfile("uploadfiles/$file[0].txt");
							}
							
							$encoding = mb_detect_encoding($sFile, mb_detect_order(), false);
	
						   if($encoding == "UTF-8")
							{
								$sFile = mb_convert_encoding($sFile, "UTF-8", "Windows-1252");    
							}
						
						
							$out = iconv(mb_detect_encoding($sFile, mb_detect_order(), false), "UTF-8//IGNORE", $sFile);
							echo $out;
							}
						?>	
						</textarea>
				 
				</div>
				<?php
				$sql="SELECT * FROM tblstyles";
				$ctr=0;
				if ($result=mysqli_query($con,$sql))
				  {
				  // Fetch one and one row
				  while ($row=mysqli_fetch_row($result))
					{
						if ($row[4]==1){
						$ctrl='CKEDITOR.CTRL';
						}
						else{
						$ctrl='';
						}


						if ($row[5]==1){
						$Shift='CKEDITOR.SHIFT';
						}
						else{
						$Shift='';
						}
						$keyVal=ord($row[6]);


						$ShortcutKey='';

						if ($ctrl!=''){
						$ShortcutKey=$ctrl;
						}

						if ($Shift!=''){
							if ($ctrl!=''){
							$ShortcutKey=$ShortcutKey.' + '.$Shift;
							}
							else{
								$ShortcutKey=$Shift;
							}
						}

						if ($keyVal!=''){
							if ($Shift!=''){
								if ($ctrl!=''){
								$ShortcutKey=$ctrl.' + '.$Shift.' + '.$keyVal;
								}
								else{
									$ShortcutKey=$Shift.' + '.$keyVal;
								}
							}
							else{
								if ($ctrl!=''){
									$ShortcutKey=$ctrl.' + '.$keyVal;
								}
							}
						}
						else{
						$ShortcutKey='';
						}
						if ($keyVal!=''){
								
							if ($ctr==0){
								$key="if ( event.data.keyCode == $ShortcutKey ) {                
										this.fire( 'saveSnapshot' );
										var style = new CKEDITOR.style( styles[ $ctr ] ),
											elementPath = this.elementPath();
										
										this[ style.checkActive( elementPath ) ? 'removeStyle' : 'applyStyle' ]( style );
										this.fire( 'saveSnapshot' );
									}
									";
										
										
							}
							else{
								$key=$key."if ( event.data.keyCode == $ShortcutKey ) {                
										this.fire( 'saveSnapshot' );
										var style = new CKEDITOR.style( styles[ $ctr ] ),
											elementPath = this.elementPath();
										
										this[ style.checkActive( elementPath ) ? 'removeStyle' : 'applyStyle' ]( style );
										this.fire( 'saveSnapshot' );
								}
									"
									;
							}
							
							
							
							$ctr++;
						}
						
					}
					 
				}
			 
				 
				?>	
				<script>
						CKEDITOR.replace( 'editor1', {
							extraPlugins: 'stylesheetparser',
							height: 520,

							// Custom stylesheet for editor content.
							contentsCss: [ 'bower_components/ckeditor/stylesheetparser.css' ],

							// Do not load the default Styles configuration.
							stylesSet: [],
							on: {
							key: function( event ) {
								// Gather all styles
								var styles = [];
								this.getStylesSet( function( defs ) { styles = defs } );
								
								// CTRL+SHIFT+1
								<?php
								echo $key;
								?>
							}
						}
							
						} );
						 
				</script>
				
				 
				
				  <div class="box-footer">
				   
					<div class="pull-right">
						<input type="hidden" name="fileVal" value="<?php echo "$file[0].xml";?>">
						<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-shortcut" ><i class="fa fa-keyboard-o"></i> Shortcut key</button>
						 <?php
						 if ($Status==''){
							if ($StatusString=='Ongoing'){
						 ?>
						<button type="submit" class="btn btn-primary"><i class="fa fa-gear"></i> Transform</button>
						<?php
							}
						 }
						 ?>
						 </form>
					</div>
					<div class="pull-left">
					<form method ="post" action="API/ExecutePlugin.php">
					<?php
							//Read TXT FILE AND LOAD IT ON EDITOR
							$file= explode('.',$sFileVal[1]);
							 
							if (file_exists("uploadfiles/$file[0].htm")) {   
								$sFile= file_get_contents("uploadfiles/$file[0].htm");
								//echo readfile("uploadfiles/$file[0].htm"); 
							}
							else{
								$sFile= file_get_contents("uploadfiles/$file[0].html");
								//echo readfile("uploadfiles/$file[0].txt");
							}
							
							$encoding = mb_detect_encoding($sFile, mb_detect_order(), false);
	
						   if($encoding == "UTF-8")
							{
								$sFile = mb_convert_encoding($sFile, "UTF-8", "Windows-1252");    
							}
						
						
							$out = iconv(mb_detect_encoding($sFile, mb_detect_order(), false), "UTF-8//IGNORE", $sFile);
						?>	
						
						<textarea   name="editor2" style="display:none;"><?php echo $out;?></textarea>
						 
							
							 
						<input type="hidden" name="fileVal" value="<?php echo "$file[0].htm";?>">
						<select  id="candidate" name="Plugin">
					   <?php
					   $sql="SELECT * FROM tbltaskplugin WHERE UI='Styling'";
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
							  <option value="<?php echo $PluginName;?>"><?php echo $PluginName;?></option>
							<?php 
							}
						  }
						  ?>
						</select>  <button type="submit" class="btn btn-success .btn-sm">Execute</button>
					</form>
					</div>
				</div>
				 
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane active" id="tab_3-2">
				<?php
				$info = pathinfo( $fileVal);
				$snewile =str_replace("." . $info["extension"],".pdf",$fileVal);	
				 
				 

				if ($FileStatus!='Done'){
				 
				if ($info["extension"] == "pdf") {
				?>
			  
				 <embed src="<?php echo $fileVal;?>" style="width:100%; height:37vw;" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">
				 <?php
					}
					else
					{
						
						if (file_exists($snewile)) {
						?>
						<embed src="<?php echo $snewile;?>" style="width:100%; height:37vw;" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">
						
						<?php
						}
						else{
							if ($snewile!=''){
							?>
							 
								<script language="javascript">
									window.location = "ConvertAnyDox2PDF/convert.php?FileURL=../uploadFiles/<?php echo $sFileVal[1];?>&FileName=<?php echo $sFileVal[1];?>&RedirectURL=https://10.160.0.88/primo/index.php";
								</script>
								
								 
								
							<?php
							}
						}
					 
					}
				}
					?>
					
					
              </div>
              <!-- /.tab-pane -->
            </div>
			
            <!-- /.tab-content -->
          </div>
		<form method="post" action="SetAsCompleted.php">
			<div class="modal modal-primary fade" id="modal-success">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Set As Completed</h4>
				  </div>
				  <div class="modal-body">
				   <input type="hidden" name="BatchID" value="<?php echo "$BatchID";?>">
					<p>Are you sure you want to set this batch as completed?</p>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
					<button type="Submit" class="btn btn-outline">Complete</button>
				  </div>
				</div>
				<!-- /.modal-content -->
			  </div>
			  <!-- /.modal-dialog -->
			</div>
		</form>
		<!-- /.shortcut key-->
		<div class="modal modal-info fade" id="modal-shortcut">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Shortcut key</h4>
				  </div>
				  <div class="modal-body">
				  <table>
				  <tr>
				  <td><b>Stylename</b></td>
				  <td>&emsp;&emsp;&emsp;</td>
				  <td><b>Shortcut Key</b></td>
				  <td>&emsp;&emsp;&emsp;</td>
				  <td></td>
				  </tr>
					<?php
						$sql="SELECT * FROM tblstyles";
				$ctr=0;
				if ($result=mysqli_query($con,$sql))
				  {
				  // Fetch one and one row
				  while ($row=mysqli_fetch_row($result))
					{
						
					if ($row[3]==1){
					$Inline='checked';
					}
					else{
					$Inline='';
					}

					if ($row[4]==1){
					$ctrl='CTRL';
					}
					else{
					$ctrl='';
					}


					if ($row[5]==1){
					$Shift='Shift';
					}
					else{
					$Shift='';
					}
					$keyVal=$row[6];


					$ShortcutKey='';

					if ($ctrl!=''){
					$ShortcutKey=$ctrl;
					}

					if ($Shift!=''){
					if ($ctrl!=''){
					$ShortcutKey=$ShortcutKey.'+'.$Shift;
					}
					else{
					$ShortcutKey=$Shift;
					}
					}

					if ($keyVal!=''){
					if ($Shift!=''){
					if ($ctrl!=''){
					$ShortcutKey=$ctrl.'+'.$Shift.'+'.$keyVal;
					}
					else{
						$ShortcutKey=$Shift.'+'.$keyVal;
					}
					}
					else{
					if ($ctrl!=''){
						$ShortcutKey=$ctrl.'+'.$keyVal;
					}
					}
					}
					else{
					$ShortcutKey='';
					}
						
						
					?>
					<tr><td><?php echo $row[1];?></td>  <td>&emsp;&emsp;&emsp;</td><td> <?php echo $ShortcutKey;?></td><td>&emsp;&emsp;&emsp;</td>
					 <td><input type="Color"  name="Color" value="<?php echo $row[2];?>"></td></tr>
					<?php
					}
				  }
				?>
					</table>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
					 
				  </div>
				</div>
				<!-- /.modal-content -->
			  </div>
			  <!-- /.modal-dialog -->
			</div>
		
		
		<form method="post" action="StartJob.php">
			<div class="modal modal-primary fade" id="modal-Start">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Job Started</h4>
				  </div>
				  <div class="modal-body">
				   <input type="hidden" name="BatchID1" value="<?php echo "$BatchID";?>">
					<p>Are you sure you want to start this batch?</p>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
					<button type="Submit" class="btn btn-outline">Start</button>
				  </div>
				</div>
				<!-- /.modal-content -->
			  </div>
			  <!-- /.modal-dialog -->
			</div>
		</form>
		<form method="post" action="PendingJob.php">
			<div class="modal modal-warning fade" id="modal-Pending">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Job Started</h4>
				  </div>
				  <div class="modal-body">
				   <input type="hidden" name="BatchID2" value="<?php echo "$BatchID";?>">
					<p>Are you sure you want to set this batch as Pending?</p>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
					<button type="Submit" class="btn btn-outline">Pending</button>
				  </div>
				</div>
				<!-- /.modal-content -->
			  </div>
			  <!-- /.modal-dialog -->
			</div>
		</form>
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
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
         
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
 
 

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- CK Editor -->
 <script src="plugins/iCheck/icheck.min.js"></script>
 

 
  <script src="script.js"></script>
	
</body>
</html>
<?php
function _utf8_decode($string)
{
  $tmp = $string;
  $count = 0;
  while (mb_detect_encoding($tmp)=="UTF-8")
  {
    $tmp = utf8_decode($tmp);
    $count++;
  }
  
  for ($i = 0; $i < $count-1 ; $i++)
  {
    $string = utf8_decode($string);
    
  }
  return $string;
  
}
?>