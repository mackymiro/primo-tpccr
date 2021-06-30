<?php
require_once "conn.php";
//error_reporting(0);

session_start();

$fileVal=isset($_GET['file']) ? $_GET['file'] : '';
if ($fileVal==''){
	$fileVal=$_SESSION['file'];
}
$_SESSION['file']=$fileVal;
$sFileVal =explode('/',$fileVal);

$Task=isset($_GET['Task']) ? $_GET['Task'] : '';
if ($Task==''){
	$Task=$_SESSION['Task'];
}
$_SESSION['Task']=$Task;

if ($_SESSION['login_user']==''){
		header("location: login.php");
}


$BatchID=isset($_GET['BatchID']) ? $_GET['BatchID'] : '';
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
$Status=isset($_GET['Status']) ? $_GET['Status'] : '';
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
	
	$TaskID = ''; //added by me
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
		$sgmlTransformation = $row[9];
	}
}
	
	
?>




<!DOCTYPE html>
<html class="no-js">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
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
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <link rel="stylesheet" href="plugins/link.css">
		
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->


	<!-- jQuery 2.2.3 -->
   <script src="assets/jQuery/jquery-2.2.3.min.js"></script>
   <!-- jQuery UI 1.11.4 -->
   <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
   <!-- Bootstrap 3.3.6 -->
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
	 
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<!-- Waitme -->
	<link rel="stylesheet" href="assets/waitme/waitMe.css">
	<script src="assets/waitme/waitMe.min.js" ></script>
	
	<!-- sweet Alert -->	
	<link rel="stylesheet" type="text/css" href="assets/sweetalert/sweetalert2.css">
	<script src="assets/sweetalert/sweetalert2.js"></script>



  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<script type="text/javascript">
  function resizeIframe(obj){
     obj.style.height = 0;
     obj.style.height = '80%';
  }
</script>

 
<?php
//$file= explode('.',$sFileVal[1]);
$file= explode('.',isset($sFileVal[1]));
$sXML="";
if (file_exists("uploadfiles/$file[0].xml")) {   
	$sXML = file_get_contents("uploadfiles/$file[0].xml");
	//$sXML=_utf8_decode($sXML);
 
}

/*if (file_exists("TPCCR17-InnoDomTransformation/_Output/NR 2021-11_TEST.sgm")) {   
	$sXML = file_get_contents("TPCCR17-InnoDomTransformation/_Output/NR 2021-11_TEST.sgm");
	//$sXML=_utf8_decode($sXML);
 
}*/


?>
 <script src="js/jquery-3.4.1.min.js"></script>
  
<script src="bower_components/ckeditor/4.14.0/ckeditor.js"></script>
 
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


	
	<link rel="icon" href="innodata.png">
	
	<!--code mirror-->
  <link rel="stylesheet" href="lib/codemirror.css">
  <link rel="stylesheet" href="addon/fold/foldgutter.css" />
  <link rel="stylesheet" href="addon/dialog/dialog.css">
  <link rel="stylesheet" href="addon/search/matchesonscrollbar.css">
<!--   <link rel="stylesheet" href="addon/hint/show-hint.css">
  
    <script src="addon/hint/show-hint.js"></script>
  <script src="addon/hint/xml-hint.js"></script>
  <script src="addon/hint/html-hint.js"></script>
   -->
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
		$JobID = '';	
		$Filename = '';

		$rs=odbc_exec($conWMS,$sql);
		$ctr = odbc_num_rows($rs);
		while(odbc_fetch_row($rs))
		{
			 
			$FileStatus=odbc_result($rs,"StatusString");
			$Filename=odbc_result($rs,"Filename");
			$JobID=odbc_result($rs,"JobId");		
			
		}
		$_SESSION['JobID']=$JobID;
		$sxfilename = pathinfo($Filename, PATHINFO_FILENAME);
		//$nfile=$sxfilename.".xml";
		$nfile=$sxfilename.".sgm";
		$sXMLFile = "uploadfiles/".$nfile;
		//$sXMLFile = "TPCCR17-InnoDomTransformation/_Output/NR 2021-11_TEST.sgm";
		
		?>

 </head>
 <?php
 	
	if ($Task=='QC'){
		echo "<body class='hold-transition fixed skin-blue sidebar-mini' vlink='green' onload='GetJobStatus()'>";
		
		// echo "<body class='hold-transition fixed skin-blue sidebar-mini' onload='LoadDataEntryContent(\"".$Filename."\")'>";
		
	}elseif($Task=='STYLING'){
		if ($FileStatus!='Done'&&$FileStatus!=''){

			if (file_exists($sXMLFile)){
				echo "<body class='hold-transition fixed skin-blue sidebar-mini' vlink='green'>";
			}
			else{
				echo "<body class='hold-transition fixed skin-blue sidebar-mini' onload='GetJobStatus()' vlink='green'>";
			}
			
		}
		else{
			echo "<body class='hold-transition fixed skin-blue sidebar-mini' vlink='green'>";
		}
		
	}else{

		echo '<body class="hold-transition fixed skin-blue sidebar-mini" vlink="green" >';
	}
?>


	 <!-- onload="start()" -->
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
              <span class="hidden-xs">Test User </span>
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
<script type="text/javascript">

function LoadStyles(){

 
  var response=document.getElementById("Joblist");
  //var jTextArea=document.getElementById("jTextArea").value;
  var jTextArea = "index";
  var data = 'data='+encodeURIComponent(jTextArea);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange=function(){
    if (xmlhttp.readyState==4 && xmlhttp.status==200){
      response.innerHTML=xmlhttp.responseText;
         
    }
  }
  xmlhttp.open("POST","ListOfStyles.php",true);
        //Must add this request header to XMLHttpRequest request for POST
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
  xmlhttp.send(data);
  
}

</script>
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
		<li><a href="fullscr.php?page=Enrich&file=<?=$filename;?>&BatchID=<?=$BatchID;?>&Task=<?=$Task;?>"><i class="fa fa-copy"></i> Split View</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
			 
              <li  class="active"><a href="#allocationDetails" data-toggle="tab">Allocation Details</a></li>
			  
              <li><a href="#JobQueue" data-toggle="tab" >Validation</a></li>
			  <li><a href="#styles" data-toggle="tab" >Styles</a></li>
              <li><a href="#AutomationPanel" onclick="LoadAutomation()" data-toggle="tab" >Automation Panel</a></li>
              <!-- onclick="LoadStyles();" -->
            
          	</ul>

          	 <div class="tab-content" >
          	 	<div class="tab-pane" id="AutomationPanel"  style="overflow-y: scroll; height:35vw;">
          	 		<ul class="nav nav-pills nav-stacked">
	         			<div id="AutomationList" >
	         			</div>
	         		</ul>
				</div>
          	 
          	 	<div class="tab-pane" id="JobQueue"  style="overflow-y: scroll; height:35vw;">
          	 		<ul class="nav nav-pills nav-stacked">
	         			<div id="ValidationList" >
	         			</div>
	         		</ul>
				</div>
				<!--<div class="tab-pane" id="styles"  style="overflow-y: scroll; height:35vw;">
          	 		<ul class="nav nav-pills nav-stacked">
	         			<li>test styles 123</li>
	         		</ul>
				</div>-->
				
				<div class="tab-pane  active" id="allocationDetails" >
						<?php
			$sql="SELECT * FROM primo_view_Jobs Where ProcessCode='$Task' AND BatchID='$BatchID'";	
				 	
					$rs=odbc_exec($conWMS,$sql);
					$ctr = odbc_num_rows($rs);
					while(odbc_fetch_row($rs))
					{
						$Jobname=odbc_result($rs,"Jobname");
						$Filename=odbc_result($rs,"Filename");
						$_SESSION['FileName']=$Filename;
						$StatusString=odbc_result($rs,"StatusString");
						$LastUpdate=odbc_result($rs,"LastUpdate");
						$JobId=odbc_result($rs,"JobId");
						$Relevancy=odbc_result($rs,"Relevancy");
						$GGJobID=odbc_result($rs,"GGJobID");
						$SourceURL=odbc_result($rs,"SourceURL");
						$PageNo=odbc_result($rs,"PageNo");
						$PrioNumber=odbc_result($rs,"Transpriority");
						$DocumentType=odbc_result($rs,"DocumentType");
						$RefId_primo=odbc_result($rs,"RefId");
						$statusString = odbc_result($rs, "StatusString");
						
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
									window.location = "<?php echo $row[2];?>?FileURL=../uploadFiles/<?php echo $sFileVal[1];?>&FileName=<?php echo $sFileVal[1];?>&RedirectURL=https://10.160.0.88/primoDataForAI/index.php&ID=<?php echo $row[0];?>";
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
              	<li><a href="#"><i class="fa fa-tasks"></i><b>TASK: <span id="Task1"><?= $Task;?></span></b></a></li>
              	<li><a href="<?= $SourceURL;?>" target="_blank"><i class="fa fa-file-o"></i>FileName: <u><span id="filename"><?php echo $Filename;?></span></u></a></li>
              <!-- 	<li><a href="<?= $SourceURL;?>" target="_blankk"><i class="fa fa-file-o"></i>Source URL: <u><span id="filename"><?php echo $SourceURL;?></span></u></a></li> -->
			    <li><a href="#"><i class="fa fa-folder"></i>JobName: <u><?= $Jobname;?></u></a></li>
			    <!-- <li><a href="#"><i class="fa fa-folder"></i>Priority Number: <u><?= $PrioNumber;?></u></a></li> -->
			     <li><a href="#"><i class="fa fa-folder"></i>Document Type: <u><span id="DocType"><?= $DocumentType;?></span></u></a></li>

				 <?php if($_GET['Task'] != "Validation"): ?>
			     <li><a href="#"><i class="fa fa-folder"></i>PageNo: <u><span id="PageNo"><?= $PageNo;?></span></u></a></li>
				<?php endif;  ?>
				<li><a href="#"><i class="fa fa-line-chart"></i>Status: <u><span id="Status"><?= $StatusString;?></span></u></a></li>
                <li><a href="#"><i class="fa fa-clock-o"></i>Last Updated: <u><?= $LastUpdate;?></u></a></li>
                <?php
                if ($TreeView==1){
 
				?>
				<!-- https://wb.innodatalabs.com/zoning/#/job/<?= $GGJobID;?>?token=dXNlci10ZXN0LWZiYWQ5OThmMmYxNzNiNDM3NDE0YjQxOWZkNjhkMzAwMDVkN2QzMDc6 -->
				<li><a href="https://wb.innodatalabs.com/zoning-review/#/job/<?= $GGJobID;?>?token=<?= $TokenVAL; ?>" target="blank" id='GoldenGateLink1'><i class="fa fa-square"></i> <u>Zoning</u></li>
				 
				<?php if($Task != "CropImageEdit"): ?>
				 <li><a href="https://wb.innodatalabs.com/zoning/#/job/<?= $GGJobID;?>?token=<?= $TokenVAL; ?>" target="blank" id='GoldenGateLink'><i class="fa fa-link"></i>Link: <u>Full Screen (Transformation)</u></li>
				<?php endif; ?>
				<?php if($Task != "CropImageEdit"): ?>
				 <li><a href="#" onClick="GetJobStatus()"><i id="spinner" class="fa fa-spinner"></i>GG Status:<u><span id="GGStatus"></span></u></a></li>
				<?php endif;  ?>
				 <!-- <li><a href="#" onClick="TestGetJobStatus()"><i class="fa fa-refresh"></i>Test Status: <u><span id="TestGGStatus"></span></u></a></li> -->
				<?php
				//$innoXML= str_replace(".pdf", "_response.xml", $Filename);
				//$innoXML= str_replace(".PDF", "_response.xml", $innoXML);
				$innoXML= str_replace(".pdf", "_response.sgm", $Filename);
				$innoXML= str_replace(".PDF", "_response.sgm", $innoXML);
				?>
				 
				<!-- <li><a href="uploadfiles/<?php //echo  $innoXML;?>" target="_blank" ><i class="fa fa-file-excel-o"></i><u>Innodom XML</u></a></li>-->
				 
				 <li><a href="checkInnoDom.php?page=uploadfiles/<?= $innoXML; ?>" target="_blank" ><i class="fa fa-file-excel-o"></i><u>Innodom XML</u></a></li>
				 <input type="hidden" value ="<?= $GGJobID;?>" id="GGJobID">
				 <input type="hidden" value ="<?= $Task;?>" id="Task">
				 <input type="hidden" value ="<?= $TokenVAL;?>" id="TokenVal">
				 <input type="hidden" value ="Not Yet Validated" id="ValidateTrigger">
				<?php

				}
				$PDFImage='none';

                if ($_SESSION['Task']=='CONTENTREVIEW'){
                	$ext = pathinfo($Filename, PATHINFO_EXTENSION);


                	if (strtoupper($ext)=='PDF'){


                		$PDFImage='display';

                		if (file_exists("uploadfiles/".$JobID."/".pathinfo($Filename,PATHINFO_FILENAME ).".html")){
			   ?>
						<li><a href="<?php echo "uploadfiles/".$JobID."/".pathinfo($Filename,PATHINFO_FILENAME ).".html";?>" target="_blank"><i class="fa fa-gear"></i>View HTML</a></li>  

				<?php

                		}
                		else{

                		?>
						<li id="HTMLCon"><a href="#" onclick="ConvertPDFHTML()"><i class="fa fa-gear"></i>Convert PDF to HTML </a></li>  

				<?php
					
                		}
					}


                }
               
				?>
					<!-- <li style="display: block" id="isPDFImage"><a><i class="fa fa-question-circle"></i><input type="checkbox" id="PDFImage"> PDF Image?</a></li> -->
					
					<?php if($TreeView != 0): ?>
						<?php if($Task != "CropImageEdit"): ?>
							<li style="display: block" id="JobRepost"><a><i class="fa fa-question-circle"></i><button onclick="JobRewind()">Rewind</button></li>
						<?php endif; ?>
					<?php endif; ?>
					
						<!-- <button onclick="JobRepost()">Repost</button> -->

				 <?php
				 
				if ($Task=='WRITING'){
				?>

				<li><a href="#" ><i class="fa fa-info"></i> Draft Type: <u><select id="DraftType">
					<option value="New">New</option>
					<option value="Ammendment">Ammendment</option>
				</select></u> </li>

				<li><a href="#" ><i class="fa fa-info"></i> Category: <u><select id="Category">
					<option value="Air Pollution">Air Pollution</option>
					<option value="Construction">Construction</option>
					<option value="Corporate Standards">Corporate Standards</option>
					<option value="Emergency Response">Emergency Response</option>
					<option value="Energy">Energy</option>
					<option value="Equipment">Equipment</option>
					<option value="General">General</option>
					<option value="General Safety">General Safety</option>
					<option value="Guidelines">Guidelines</option>
					<option value="Marine">Marine</option>
					<option value="Materials">Materials</option>
					<option value="Mining">Mining</option>
					<option value="Nature Conservation">Nature Conservation</option>
					<option value="Noise Pollution">Noise Pollution</option>
					<option value="Offshore">Offshore</option>
					<option value="Planning">Planning</option>
					<option value="Pollution Prevention">Pollution Prevention</option>
					<option value="Products">Products</option>
					<option value="Protection of Workers">Protection of Workers</option>
					<option value="Transport">Transport</option>
					<option value="Waste">Waste</option>
					<option value="Water">Water</option>
					<option value="Workplace">Workplace</option>
				</select></u></a> </li>


				<li><a href="#" onClick="GetJobStatus()"><i class="fa fa-edit"></i><button onclick="SetInfo()">Set Info</button></li>
				<script type="text/javascript">
					
					function SetInfo(){
						var strValue =CKEDITOR.instances['editor1'].getData();
						var DraftType= document.getElementById("DraftType").value;
						var Category= document.getElementById("Category").value;
						strHTML="<p><b>Draft Type:</b> "+ DraftType+"</p>"+"<p><b>Category:</b> "+ Category+"</p>"+strValue;
						// editor.insertHtml(strHTML);

						CKEDITOR.instances.editor1.setData(strHTML); 

					}

				</script>
				<?php
				}
				?>
              <!--   <li><a href="#"><i class="fa fa-question-circle"></i>Relevancy: <u>
                	<?php
                	if ($_SESSION['Task']=='CONTENTREVIEW'){
                	?>
                	<select id="Relevancy" name="Relevancy">
                	<option value="Relevant">Relevant</option>
                	<option value="Not Relevant">Not Relevant</option>
					<?php
					if($Relevancy!=''){
						?>
					<option value="<?=$Relevancy;?>" selected><?=$Relevancy;?></option>
					<?php
					}
					?>

               		 </select></u>
                <?php
            	}
            	else{
            		?>

            		<input type="text" readonly="true" value="<?=$Relevancy;?>">
            	<?php
            	}	
            	?>
				</a></li> -->

				<?php
				
				if ($Status=='' && $StatusString=='Allocated'){
				 	$Start="inline";
					$Resume ="none";
					$Completed="none";
					$Pending="none";
					$Hold="none";
					 
				}
				elseif($StatusString=='Ongoing'){
				 	$Start="none";
					$Resume ="none";
					$Completed="inline";
					$Pending="inline";
					 $Hold="inline";
				}
				elseif($StatusString=='Pending'){
					$Start="none";
					$Resume ="inline";
					$Completed="none";
					$Pending="none";
					 $Hold="none";
				}
				elseif($StatusString=='Done'){
					$Start="none";
					$Resume ="none";
					$Completed="none";
					$Pending="none";
					 $Hold="none";
				}
				else{
					$Start="none";
					$Resume ="none";
					$Completed="none";
					$Pending="none";
					$Hold="none";
				}

				$GetNextBatch="none";
				?>

				<div class="box-footer with-border">
				   
				  <div class="box-tools">
					 <li style='display: <?= $Start;?>' id="Start"><button type="button" class="btn btn-default  pull-right"  data-toggle="modal" data-target="#modal-Start"  onclick="Javascript:SetTextBoxValue1(<?= $BatchID;?>)" style='display: <?= $Start;?>'><i class="fa fa-hourglass-start" ></i> Start</button></li>
					 <li style='display:  <?= $Completed;?>'  id="Completed"> <button type="button" class="btn btn-default  pull-right"  data-toggle="modal" data-target="#modal-success"  onclick="Javascript:SetTextBoxValue(<?= $BatchID;?>)" style="width:150px"  ><i class="fa fa-check"></i> Set as completed</button>
					 </li>
					  <li style='display:  <?= $Hold;?>'  id="Hold"> 
					 <button type="button" class="btn btn-default  pull-right"  data-toggle="modal" data-target="#modal-Hold"  onclick="Javascript:SetTextBoxValue3(<?= $BatchID;?>)"  style="width:150px" ><i class="fa  fa-hand-stop-o"></i> Hold</button>
					  </li>
					 <li style='display:  <?= $Pending;?>'  id="Pending"><button type="button" class="btn btn-default pull-right"  data-toggle="modal" data-target="#modal-Pending"  onclick="Javascript:SetTextBoxValue2(<?= $BatchID;?>)"  style="width:150px"  ><i class="fa fa-hourglass-2" ></i> Pending</button></li>
					 <li style='display:  <?= $Resume;?>'  id="Resume"><button type="button" class="btn btn-default  pull-right"  data-toggle="modal" data-target="#modal-Start"   style="width:150px" onclick="Javascript:SetTextBoxValue1(<?= $BatchID;?>)"  ><i class="fa fa-hourglass-start"></i> Resume</button></li>
					  <li style='display:  <?= $GetNextBatch;?>'  id="GetNext"><a class="btn btn-default  pull-right"  href="GetNextBatch.php?page=Enrich&Task=<?= $Task;?>&fullscr=1"><i class="fa  fa-hand-grab-o"></i> Get Next Batch</a></li>
					 </div>
				</div>

              </ul>
            </div>
            <!-- /.box-body -->
				</div>


          	</div>
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
			  
							 
				if (file_exists("uploadfiles/$file[0].htm")){   
				 
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
								echo "<li><a onclick='FindTerm(\"". $lVal[0] . "\")' href='#tab_2-2'><i class='fa fa-circle text-green'></i>" .$lVal[0] ."</a></li>";
							?>
							 
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
								echo "<li><a onclick='FindTerm(\"". $lVal[0] . "\")' href='#tab_2-2'><i class='fa fa-circle text-red'></i>" .$lVal[0] ."</a></li>";
							 
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
								
							echo "<li><a onclick='FindTerm(\"". $lVal[0] . "\")' href='#tab_2-2'><i class='fa fa-circle text-yellow'></i>" .$lVal[0] ."</a></li>";
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
	function StyleDoc (prStyle,prType) {
		
	 	var editor =CKEDITOR.instances['editor1'];
		var selectedHtml = "";
		var selection = editor.getSelection();
		if (selection) {
		    selectedHtml = getSelectionHtml(selection);
		}
	 	var strHTML;
		if (prType==1){
			strHTML='<span class="'+ prStyle +'">' + selectedHtml + '</span>';
			
		}
		else{
			strHTML='<div class="'+ prStyle +'">' + selectedHtml + '</div>';
			
			 
		}
		 
		editor.insertHtml(strHTML);
		 
	}

	function getRangeHtml(range) {
    var content = range.extractContents();
    // `content.$` is an actual DocumentFragment object (not a CKEDitor abstract)
    var children = content.$.childNodes;
    var html = '';
    for (var i = 0; i < children.length; i++) {
        var child = children[i];
        if (typeof child.outerHTML === 'string') {
            html += child.outerHTML;
        } else {
            html += child.textContent;
        }
    }
    return html;
}
	/**
		Get HTML of a selection.
	*/
	function getSelectionHtml(selection) {
		var ranges = selection.getRanges();
		var html = '';
		for (var i = 0; i < ranges.length; i++) {
			html += getRangeHtml(ranges[i]);
		}
		return html;
	}
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

	function FindTerm (findString) {
		 
		var editor =CKEDITOR.instances['editor1'];
		var documentWrapper = editor.document; // [object Object] ... CKEditor object
		var sel = editor.getSelection();

		var documentNode = documentWrapper.$; // [object HTMLDocument] .... DOM object
		var elementCollection = documentNode.getElementsByTagName('span');
		
		var rangeObjForSelection = new CKEDITOR.dom.range( editor.document );

	 	var nodeArray = [];
		for (var i = 0; i < elementCollection.length; ++i) {
						 
				nodeArray[i] = new CKEDITOR.dom.element( elementCollection[ i ] );
				
				if (nodeArray[i].getText()==findString){
					sel.selectElement(nodeArray[i] );
					 nodeArray[i].scrollIntoView();
					//editor.getSelection().selectRanges( rangeObjForSelection );
					//rangeObjForSelection.selectNodeContents( nodeArray[ i ] );
					break;
				}
				
			 
		}

		
	}



	function FindTermATC (findString) {
		
		var editor =CKEDITOR.instances['editor1'];
		var documentWrapper = editor.document; // [object Object] ... CKEditor object
		var sel = editor.getSelection();

		var documentNode = documentWrapper.$; // [object HTMLDocument] .... DOM object
		var elementCollection = documentNode.getElementsByTagName('*');
		 
		var rangeObjForSelection = new CKEDITOR.dom.range( editor.document );
	 
	 	var nodeArray = [];
		for (var i = 0; i < elementCollection.length; ++i) {
				nodeArray[i] = new CKEDITOR.dom.element( elementCollection[ i ] );
				if (nodeArray[i].getText()==findString){

					sel.selectElement(nodeArray[i] );
					nodeArray[i].scrollIntoView();
					 //CKEDITOR.instances['jTextArea'].insertHtml(nodeArray[i].getOuterHtml() + "<li><p>"+ titleCase(CKEDITOR.instances["editor1"].getSelection().getSelectedText()) +"</p></li>");
					//AddNewLine();
					//editor.getSelection().selectRanges( rangeObjForSelection );
					//rangeObjForSelection.selectNodeContents( nodeArray[ i ] );

					break;
				}
				
			 
		}

		
	}

	function GenerateXML(){
		 editor_html.setValue("");
	 	$("#modal-progress").modal();
		var jTextArea = CKEDITOR.instances['editor1'].getData();
		var data = 'data='+encodeURIComponent(jTextArea);
                 
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
              //response.innerHTML=xmlhttp.responseText;
              
              editor_html.setValue(xmlhttp.responseText);
               $('#modal-progress').modal('hide');
            }
          }
          xmlhttp.open("POST","saveFile.php",true);
                //Must add this request header to XMLHttpRequest request for POST
          xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xmlhttp.send(data);
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
              <h3 class="box-title">ATC Result</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
			
			 
				 
			<form method="POST" action="#"> 
              <ul class="nav nav-pills nav-stacked" id="dynamic-list">
			<?php
			$sql="Select * from tblATCResult where BatchID='".$JobId."'";
		 
			$rs=odbc_exec($conWMS,$sql);
			$ctr = odbc_num_rows($rs);
			while(odbc_fetch_row($rs))
			{
				$SearchString=odbc_result($rs,"SearchString");
				$ReplaceString=odbc_result($rs,"ReplaceString");

				$ctr=odbc_result($rs,"TotalReplacement");
			?>


			  <li> 
			  <?php echo "<a onclick='FindTermATC(\"".trim($ReplaceString)."\")'href='#'><i class='fa fa-book'></i>".$SearchString." to ".$ReplaceString;?>
                <span class="pull-right-container">
                 
				  <span class="label label-success pull-right"><?php echo $ctr;?></span>
                </span>
              	</a>
			  </li>
			 	<?php
			 	
				}
			?>	   
              </ul>
			  <div class="box-footer with-border">
				   
				   
			  </div>
				  
            </div>
			
            <!-- /.box-body -->
          </div>
		  <?php
		  }
		  ?>
          <!-- /.box -->
        </div>
        <!-- /.col -->
<!----#### END OF COLUMN 3 #####-->	
	



	
<!--###################################################################### START COLUMN 9  ###############################################-->	 
	 
	 
<?php if($_GET['Task'] != "CropImageEdit" )	 :  ?>
	
<div class="col-md-9">
	     <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
			<?php if($sgmlTransformation == 1): ?>
				<li class=""><a href="#tab_sgml" data-toggle="tab">SGML Transformation</a></li>

			<?php endif;?>
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
              <li onclick="RefreshEditor()"> <a href="#tab_1-1"  onclick="RefreshEditor()" data-toggle="tab">XML Editor</a></li>
			  <?php
			}
			?>
			<?php
			if ($Task=='WRITINGQC'||$Task=='FINALREVIEW'){
					echo '<LI onClick="LoadFeedbackList()"><a href="#tab_4_2"  data-toggle="tab" >Feedback Form</a></LI>';
			}
			if ($Styling==1){
				
			?>
              <li><a href="#tab_2-2" data-toggle="tab">Styling</a></li>
			<?php

			}
			
		 
			if ($TreeView==1){
				
			?>
              <li ><a href="#tab_2-1" data-toggle="tab">Transformation</a></li>
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
							$MLName=$row[1];
							$Stat=GetFieldValue("Select * from tblstatus where MLName='$MLName' AND Process='$Task' AND Jobname='$BatchID'","Jobname",$con);
							if ($Stat!=''){
								
					?>
									  <li role="presentation" ><a role="menuitem" tabindex="-1" href="preloader/index.php?APIURL=../<?php echo $row[2];?>&FileURL=../uploadFiles/<?php echo $sFileVal[1];?>&MLName=<?php echo $row[1];?>&FileName=<?php echo $sFileVal[1];?>&RedirectURL=https://10.160.0.88/primoDataForAI/index.php&ID=<?php echo $row[0];?>"><i class="fa fa-fw fa-check"></i><?php echo $row[1];?></a></li>
									  
							  <?php
							}
							else{
								?>
								<li role="presentation" ><a role="menuitem" tabindex="-1" href="preloader/index.php?APIURL=../<?php echo $row[2];?>&FileURL=../uploadFiles/<?php echo $sFileVal[1];?>&MLName=<?php echo $row[1];?>&FileName=<?php echo $sFileVal[1];?>&RedirectURL=https://10.160.0.88/primoDataForAI/index.php&ID=<?php echo $row[0];?>"><i class="fa fa-fw  fa-circle-o"></i><?php echo $row[1];?></a></li>
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

			<?php

				if ($Task=='QC'){

			?>
						<!-- <iframe src="https://wb.innodatalabs.com/mapping-review/#/job/<?php echo $GGJobID;?>?token=dXNlci1saXZlLTBmMjc3OTVhYzA4NWI5YzhmYWY2NjNiYWE4NjhkZDY3ZWRjOGVkZWY6" id='GoldenGateFrame'  style="width:200%; height:37vw;"  frameBorder="0" scrolling="auto"></iframe> -->
					<iframe src="https://wb.innodatalabs.com/zoning/#/job/<?= $GGJobID;?>?token=dXNlci1saXZlLTBmMjc3OTVhYzA4NWI5YzhmYWY2NjNiYWE4NjhkZDY3ZWRjOGVkZWY6"   style="width:200%; height:37vw;" id='GoldenGateFrame'  frameBorder="0" scrolling="auto"></iframe>
						<?php
					}
					else{
			?>

			<iframe src="https://wb.innodatalabs.com/zoning/#/job/<?= $GGJobID;?>?token=<?= $TokenVAL; ?>"   style="width:200%; height:37vw;" id='GoldenGateFrame'  frameBorder="0" scrolling="auto"></iframe>

			<?php

					}
					?>
					 </div>
				</div>
	
				</div>
				<div class="tab-pane" id="tab_sgml">
					<fieldset>
						<div class="form-group" style="width:100%; height:65vh;">
							<?php
							if ($FileStatus!='Done'){
								?>
			
								<textarea id="codeSgml" rows="100" spellcheck="true"  name="code"><?php echo $sXML;?></textarea>
								<?php
								}
								else{
									?>
								<textarea id="codeSgml" rows="100" spellcheck="true" name="code"></textarea>
									<?php
								}
								?>
								 <textarea id="spellcheckText" rows="100" spellcheck="true" style="width:100%; height:65vh;display:none"  ></textarea>
								 <script id="script">
										var prToggle=1;
									/*
									* Demonstration of code folding
									*/
								
									
									var te_html = document.getElementById("codeSgml");
									
									
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
										autoRefresh: true,
										indentUnit: 4,
										indentWithTabs: true,
										readOnly: false,
										smartIndent: true,

										gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"]


									});
									
									editor_html.on ('beforeChange',function(){
										
										DisableTag(prToggle);
									});

									editor_html.refresh();
									editor_html.setSize("100%","65vh"); 

									
					  		</script>
							<script>
								function jumpToLine(prLineNo,prCol,prLength){
									
									editor_html.refresh();
									editor_html.setCursor(prLineNo);
									// alert(prLength);
									editor_html.setSelection({line: prLineNo-1, ch: prCol-prLength}, {line: prLineNo-1, ch:prCol+prLength});

									// editor_html.markText({line: prLineNo-1, ch: prCol}, {line: prLineNo, ch:1}, {className: "styled-background"});

									// var line = editor_html.getLineHandle(prLineNo);
									// editor_html.setLineClass(line,'background','line-error');
								}
							</script>		
							<br />
							<div class="pull-right">
						 		<span id="" ></span>
									<button type="button" class="btn btn-success .btn-sm" onclick="">Save</button>
									
								</div>
						</div>
					</fieldset>
				</div>
				<div class="tab-pane " id="tab_1-0" >


				<div id="fieldedForm">
					<!-- <button type="button"  onclick="TableView()">Table View</button> -->
					<fieldset>
				<?php
					$sql="SELECT * FROM tbldataentry";
				 if ($result=mysqli_query($con,$sql))
				  {
				  // Fetch one and one row
				  while ($row=mysqli_fetch_row($result))
				    {

				    	
				    	$FieldName= $row[1];
				    	$FieldType= $row[2];
				    	$FieldOption= $row[3];
				    	$FieldCaption= $row[4];

				    if ($FieldType=='dropdown'){
				    	?>
				    	<div class="form-group">
							<label ><?= $FieldCaption;?></label><br>
							<select class="form-control" name="<?= $FieldName;?>" id="<?= $FieldName;?>">
								<?php
								$cats = explode("|",$FieldOption);
								foreach($cats as $cat) {
									?>
									<option value="<?= $cat;?>"><?= $cat;?></option>
									<?php
								 
								}
								?>
							</select>
						</div>
				    <?php
				    }
				    elseif($FieldType=='textarea'){
				    ?>
				    	<div class="form-group">
							<label ><?= $FieldCaption;?></label><br>
							<textarea class="form-control" name="<?= $FieldName;?>" row=5 id="<?= $FieldName;?>"></textarea>
						</div>

				   <?php
				    }
				    else{
				    	?>
				    	 <div class="form-group">
							<label><?= $FieldCaption;?></label><br>
							 <input type="<?= $FieldType;?>" class="form-control" placeholder="<?= $FieldCaption;?>" name="<?= $FieldName;?>"  id="<?= $FieldName;?>">
						  </div>
				    <?php
				    }
				 
				}
			}
			?> 
					<div class="box-footer">
		             <input type="hidden" class="form-control" placeholder="" name="UID" value="<?= $UID;?>" id="<?= $FieldName;?>">
		           
		            <button type="button" class="btn btn-primary" onclick="SaveDataEntry()">Save</button>
		           	<button type="reset" class="btn btn-danger">Cancel</button>
		          </div>
				</fieldset>
				</div>
				<div id="TableView" style="display: none">
					<button type="button"  onclick="FormView()">Form View</button>

					 <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                	<th><input type="checkbox"></th>
                	<?php
					$sql="SELECT * FROM tbldataentry";
				 if ($result=mysqli_query($con,$sql))
				  {
				  // Fetch one and one row
				  while ($row=mysqli_fetch_row($result))
				    {
						$FieldName= $row[1];
				    	$FieldType= $row[2];
				    	$FieldOption= $row[3];
				    	$FieldCaption= $row[4];
				    	?>
				  <th><?php echo $FieldCaption;?></th>
				  <?php
						}
					}
				  ?>
                   <th></th>
                </tr>
                </thead>
                <tbody>
			 
                <tr>
                	<td><input type="checkbox"></td>
                	<?php
					$sql="SELECT * FROM tbldataentry";
				 if ($result=mysqli_query($con,$sql))
				  {
				  // Fetch one and one row
				  while ($row=mysqli_fetch_row($result))
				    {

				    	
				    	$FieldName= $row[1];
				    	$FieldType= $row[2];
				    	$FieldOption= $row[3];
				    	$FieldCaption= $row[4];

				    if ($FieldType=='dropdown'){
				    	?>
				    	 <td>
							<select class="form-control" name="<?= $FieldName;?>">
								<?php
								$cats = explode("|",$FieldOption);
								foreach($cats as $cat) {
									?>
									<option value="No"><?= $cat;?></option>
									<?php
								 
								}
								?>
							</select>
						 </td>
				    <?php
				    }
				    elseif($FieldType=='textarea'){
				    ?>
				    	 <td>
							 
							<textarea class="form-control" name="<?= $FieldName;?>" row=5></textarea>
						 </td>

				   <?php
				    }
				    else{
				    	?>
				    	  <td>
							
							 <input type="<?php echo $FieldType;?>" class="form-control" placeholder="<?= $FieldCaption;?>" name="<?php echo $FieldName;?>"  >
						  </td>
				    <?php
				    }
				 
				}
			}
			?>
                   
                  <td>
				  <button type="button" class="btn btn-xs btn-info"  onclick="location.href='addnew_user.php?UID=<?php echo $row[0];?>&TransType=Update'">Add New</button>
				 </td>
                </tr>
     
                </tbody>
                <tfoot>
                <tr>
					 
                </tr>
                </tfoot>
              </table>
              <button class="btn btn-xs btn-danger"  data-toggle="modal" data-target="#modal-danger" onclick="Javascript:SetTextBoxValue(<?php echo $row[0];?>)">Delete</button>
				</div>
              </div>

              <script>
				function TableView() {
					var x = document.getElementById("TableView");
					var x1 = document.getElementById("fieldedForm");
					
					
					x.style.display = "block";
					x1.style.display = "none";
				}
				function FormView() {
					var x = document.getElementById("TableView");
					var x1 = document.getElementById("fieldedForm");
					
					x1.style.display = "block";
					x.style.display = "none";
					
				}
 
			</script>

			<?php
			$sXML = file_get_contents($sXMLFile);
			//echo "<pre>";
			//print_r($sXML);
			//echo "</pre>";
			
			// $sXML =formatXmlString(trim($sXML));
			?>
              <!-- /.tab-pane -->
              <div class="tab-pane " id="tab_1-1"  >
				
					<fieldset>
					<div class="form-group" style="width:100%; height:65vh;">
					<?php

					if ($FileStatus!='Done'){
					?>

					<textarea id="code" rows="100" spellcheck="true"  name="code"><?= $sXML;?></textarea>
					<?php
					}
					else{
						?>
					<textarea id="code" rows="100" spellcheck="true" name="code"></textarea>
						<?php
					}
					?>
				 	<textarea id="spellcheckText" rows="100" spellcheck="true" style="width:100%; height:65vh;display:none"  ></textarea>
					<script id="script">
						var prToggle=1;
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
						autoRefresh: true,
						indentUnit: 0,
						indentWithTabs: true,
						readOnly: false,
						smartIndent: true,

						gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"]


					  });
					   
					   editor_html.on ('beforeChange',function(){
					    
					   	DisableTag(prToggle);
					   });

						editor_html.refresh();
						editor_html.setSize("100%","65vh"); 

					
					  </script>
					  
					   <script>
					  function jumpToLine(prLineNo,prCol,prLength){
						  
						editor_html.refresh();
						editor_html.setCursor(prLineNo);
						// alert(prLength);
						editor_html.setSelection({line: prLineNo-1, ch: prCol-prLength}, {line: prLineNo-1, ch:prCol+prLength});

						// editor_html.markText({line: prLineNo-1, ch: prCol}, {line: prLineNo, ch:1}, {className: "styled-background"});

						// var line = editor_html.getLineHandle(prLineNo);
						// editor_html.setLineClass(line,'background','line-error');
					  }
					  </script>
					<br>
						<div class="pull-right">
						 
						 

						<span id="saveStatus" ></span>
						<!--<input type="button" class="btn btn-info .btn-sm" onclick="SpellCheck()" value="SpellCheck" id="SpellCheck">-->
						<?php if($_GET['Task'] != "ContentStructure" ): ?>
							<a href="updateSGML.php?BatchID=<?= $BatchID; ?>" target="_blank" class="btn btn-success ">Update SGML</a>
						<?php endif; ?>
						
						<button type="button" class="btn btn-danger " id="Validate" onclick="ValidateXML()">Validate</button>
						<?php if($_GET['Task'] != "Validation"): ?>
						<button type="button" class="btn btn-success " id="btnSave" onclick="saveXML()">Save</button>
						 <?php endif; ?>
					</div>
										
					</div>
					</fieldset>
					<?php
					
			  if ($fileVal!=''){
				  
			  $file= str_replace(".pdf",".log",$sFileVal[1]);
			  $file= str_replace(".PDF",".log",$file);
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
									<td style="width: 300px;"><?= $cat;?></td>
								<?php	
								}
								elseif($ctr==2){
									$lineNo=$cat;
									?>
									<td style="width: 100px;"> <?= $cat;?></td>
									<?php
								}
								else{
									?>
									<td style="width: 100px;"><a href="#" onClick="jumpToLine(<?= $lineNo;?> ,<?= $cat;?>);" >Check</a></td>
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
			  
	
			   <div  class="tab-pane"  id="tab_4_2">
			   	<div class="box-body pad">
					<div class="col-lg-12">
					  <div class="form-group">
                        <label>Level of Issue</label>
                        <Select class="form-control" id="LevelofIssue">
                          <option value="Minor">Minor</option>
                          <option value="Medium">Medium</option>
                          <option value="High">High</option>
                        </Select>
                      </div>
                      <div class="form-group">
                        <label>Type of Issue</label><br>
                         <Select class="form-control" id="TypeOfIssue">
                          <option value="WRITING">Summary WRITING</option>
                          
                        </Select>
                      </div>
                      <div class="form-group">
                        <label>Description of Issue</label>
                        <textarea  class="form-control" id="Description"></textarea>  
                      </div>
                     
                      <div class="form-group">
                        <button class="btn-success" type="button" onclick="SaveFeedback()">Save</button>
                        <button class="btn-danger" type="button" onclick="ClearFeedbackForm()">Cancel</button>
                      </div>

                  </div>
                  <span id ="FeedbackList">
                  </span>
              </div>
			</div>

			  
              <div class="tab-pane" id="tab_2-2">
			    <form method ="post" action="API/saveFile.php">
                <div class="box-body pad">
					<textarea id="editor1" name="editor1" rows="100" cols="80">
						<?php

						if ($FileStatus!='Done'){
							//Read TXT FILE AND LOAD IT ON EDITOR
							$info = pathinfo($Filename);
						 
							if (file_exists("uploadfiles/".$JobID."/".$info["filename"].".wrt")) {   
								$sFile= file_get_contents("uploadfiles/".$JobID."/".$info["filename"].".wrt");
								//echo readfile("uploadfiles/$file[0].htm"); 
							}
							else{
								$sql="SELECT * FROM primo_view_Record Where Filename='$Filename'";	
									 
								$rs=odbc_exec($conWMS,$sql);
								$ctr = odbc_num_rows($rs);
									
								while(odbc_fetch_row($rs))
								{
										
									$Title=odbc_result($rs,"Title");
									$Jurisdiction=odbc_result($rs,"Jurisdiction");
									$Register=odbc_result($rs,"Register");
									$Type=odbc_result($rs,"Type");
									$Priority=odbc_result($rs,"Priority");
									$SourceURL=odbc_result($rs,"SourceURL");
									$Topic=odbc_result($rs,"Topic");
									$OriginatingDate=odbc_result($rs,"OriginatingDate");
									$StateDate=odbc_result($rs,"StateDate");
									$Status=odbc_result($rs,"Status");
									$Remarks=odbc_result($rs,"Remarks");

									
									
								}
								$sContent="";
								// $sContent="<p><b>Draft Type:</b> </p>";
								// $sContent=$sContent."<p><b>Category:</b> </p>";
								$sContent=$sContent."<p><b>Originating Date:</b> ".$OriginatingDate."</p>";
								$sContent=$sContent."<p><b>State Date:</b> ".$StateDate."</p>";
								$sContent=$sContent."<p><b>Jurisdiction:</b> ".$Jurisdiction."</p>";
								$sContent=$sContent."<p><b>Title:</b> ".$Title."</p>";
								$sContent=$sContent."<p><b>Link to full text:</b> ".$SourceURL."</p>";
								$sContent=$sContent."<p><b>Synopsis:</b></p>";
								$sContent=$sContent."<p></p>";
								$sFile = $sContent;

								 

								
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
				  while ($row=mysqli_fetch_array($result))
					{
						$StyleName=$row['StyleName'];
						$Inline=$row['Inline'];

						if ($row['ctrlKey']==1){
						$ctrl='CKEDITOR.CTRL';
						}
						else{
						$ctrl='';
						}


						if ($row['Shftkey']==1){
						$Shift='CKEDITOR.SHIFT';
						}
						else{
						$Shift='';
						}
						$keyVal=ord($row['KeyVal']);


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
										StyleDoc(\"".$StyleName."\",\"".$Inline."\");
										return false;
									}
									";
										
									// this.fire( 'saveSnapshot' );
										// var style = new CKEDITOR.style( styles[ $ctr ] ),
										// 	elementPath = this.elementPath();
										
										// this[ style.checkActive( elementPath ) ? 'removeStyle' : 'applyStyle' ]( style );
										// this.fire( 'saveSnapshot' );	
							}
							else{
								$key=$key."if ( event.data.keyCode == $ShortcutKey ) {                
										
										StyleDoc(\"".$StyleName."\",\"".$Inline."\");
										return false;
								}
									"
									;
							}
							
							// this.fire( 'saveSnapshot' );
							// 			var style = new CKEDITOR.style( styles[ $ctr ] ),
							// 				elementPath = this.elementPath();
										
							// 			this[ style.checkActive( elementPath ) ? 'removeStyle' : 'applyStyle' ]( style );
							// 			this.fire( 'saveSnapshot' );
							
							$ctr++;
						}
						
					}
					 
				}
			 
				 
				?>	
				<script>
						CKEDITOR.replace( 'editor1', {
							extraPlugins: 'stylesheetparser',
							height: 420,

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
						<input type="hidden" name="fileVal" value="<?= "$file[0].xml";?>">
						<!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-shortcut" ><i class="fa fa-keyboard-o"></i> Shortcut key</button> -->
						  <?php
					 	 $dispSave='none';
						 if ($Status==''){
							if ($StatusString=='Ongoing'){

							$dispSave='block';
							}
							else{
								$dispSave='none';
							}
						 }

						 ?>
						<button class="btn btn-success btn-lg" onclick="saveHTMLFile()" id="SaveButton" style="display: <?=$dispSave;?>">Save</button>
						 </form>
					</div>
					 </div>
				 
              </div>
              <!-- /.tab-pane -->


            

              <div class="tab-pane active" id="tab_3-2">
				<?php
				if($RefId_primo == ""){
					$fileVal="uploadfiles/SourceFiles/".$Filename;
				}else{
					$fileVal="uploadfiles/".$RefId_primo."/".$Filename;
				}
				
				
				$info = pathinfo( $fileVal);
				$snewile =str_replace("." . $info["extension"],".pdf",$fileVal);	
				$snewile =str_replace("." . $info["extension"],".PDF",$snewile);	
				 
				if ($FileStatus!='Done'){
				 
				if ($info["extension"] == "pdf"||$info["extension"] == "PDF") {
				?>
			  
				 <embed src="<?= $fileVal;?>" style="width:100%; height:37vw;" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">
				 <?php
					}

					elseif($info["extension"] == "txt"){
						$nfilename="uploadfiles/".$RefId_primo."/".pathinfo($fileVal, PATHINFO_FILENAME).".txt";
					?>

				 	<iframe src="<?= $nfilename;?>" style="width:100%; height:37vw;" frameborder="none" ></iframe>
						
					 
					 <?php

					}
					else
					{
						 $nfilename="uploadfiles//".pathinfo($fileVal, PATHINFO_FILENAME).".html";

						if ($Filename!=''){
						?>

				 	<iframe src="<?php echo $nfilename;?>" style="width:100%; height:37vw;" frameborder="none" ></iframe>
						
					 
					 <?php
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
				   <input type="hidden" name="BatchID" id="BatchID" value="<?= $BatchID;?>">
				   <input type="hidden" id="RelevantValue" name="RelevantValue" value="">
					<p>Are you sure you want to set this batch as completed?</p>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
				 
					<button type="button" class="btn btn-outline" onclick="saveXMLAndComplete()" data-dismiss="modal">Complete</button>
				 
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
				   <input type="hidden" name="BatchID1"  id="BatchID1"  value="<?php echo "$BatchID";?>">
				   <input type="hidden" name="Task"  id="Task"  value="<?php echo "$Task";?>">
					<p>Are you sure you want to start this batch?</p>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
					<button type="button" data-dismiss="modal" class="btn btn-outline" onclick="StartJob()">Start</button>
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
					<h4 class="modal-title">Job Pending</h4>
				  </div>
				  <div class="modal-body">
				   <input type="hidden" name="BatchID2" id="BatchID2" value="<?php echo "$BatchID";?>">
					<p>Are you sure you want to set this batch as Pending?</p>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-outline" data-dismiss="modal" onclick="PendingJob()">Pending</button>
				  </div>
				</div>
				<!-- /.modal-content -->
			  </div>
			  <!-- /.modal-dialog -->
			</div>
		</form>
 </div>
 	<!-- #################################### END OF COLUMN 9 ##################################################### -->
	<?php else :  ?>
	
	<div class="col-md-9">
	
		<?php require('index_cropimage.php'); ?>

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
				   <input type="hidden" name="BatchID" id="BatchID" value="<?= $BatchID;?>">
				   <input type="hidden" id="RelevantValue" name="RelevantValue" value="">
					<p>Are you sure you want to set this batch as completed?</p>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
				   
					<button type="button" class="btn btn-outline" onclick="saveXMLAndComplete()" data-dismiss="modal">Complete</button>
				 
				  </div>
				</div>
				<!-- /.modal-content -->
			  </div>
			  <!-- /.modal-dialog -->
			</div>
		</form>

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
				   <input type="hidden" name="BatchID1"  id="BatchID1"  value="<?php echo "$BatchID";?>">
				   <input type="hidden" name="Task"  id="Task"  value="<?php echo "$Task";?>">
					<p>Are you sure you want to start this batch?</p>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
					<button type="button" data-dismiss="modal" class="btn btn-outline" onclick="StartJob()">Start</button>
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
					<h4 class="modal-title">Job Pending</h4>
				  </div>
				  <div class="modal-body">
				   <input type="hidden" name="BatchID2" id="BatchID2" value="<?php echo "$BatchID";?>">
					<p>Are you sure you want to set this batch as Pending?</p>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-outline" data-dismiss="modal" onclick="PendingJob()">Pending</button>
				  </div>
				</div>
				<!-- /.modal-content -->
			  </div>
			  <!-- /.modal-dialog -->
			</div>
		</form>

	</div>

	<?php endif;  ?>


 
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


<div class="modal fade" id="modal-progress">
  <div class="modal-dialog  modal-sm">
	<div class="modal-content">
	   <p align="center">
	   <img src="images/Preloader_3/Preloader_3.gif">
		</p>
		 <p align="center">
	  	Golden Gate Service Integration.<br/>
	  	Please wait...
		</p>


		<p align="center" ><span id="response"></span></p>
		<br>
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
<form method="post" action="HoldJob.php">
      <div class="modal modal-danger fade" id="modal-Hold">
        <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Hold Batch</h4>
          </div>
          <div class="modal-body">
           <input type="hidden" name="BatchID3" value="<?= "$BatchID";?>">
          <p>Are you sure you want to put this batch on hold?</p>
          <p>Remarks: <textarea rows="10" cols="80" class="form-control" name="Remarks"></textarea></p>
          
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
          <button type="Submit" class="btn btn-outline">Hold</button>
          </div>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </form>

  <div class="modal modal-danger" id="modal-delete">
<div class="modal-dialog">
<div class="modal-content">

  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
    <input type="hidden" id="FeedbackID">
     <!-- <h4 class="modal-title">Delete Feedback</h4> -->
      </div>
    	<div class="modal-body">
          <div class="form-group">
           <p>Are you sure you want to delete this Feedback?</p>
          </div>
      </div>

      <div class="modal-footer">
      <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
     <button type="Submit" class="btn btn-outline" data-dismiss="modal" onclick="DeleteFeedbackRecord()">Delete</button>
  </div>
</div>
</div>
<div class="modal fade" id="modal-validate">
  <div class="modal-dialog  modal-sm">
  <div class="modal-content">
     <p align="center">
     <img src="images/Preloader_2/Preloader_2.gif">
    </p>
     <p align="center">
    	Validating XML...
    </p>
  </div>
  <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal modal-success" id="modal-Comments">
<div class="modal-dialog">
<div class="modal-content">

  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
    <input type="hidden" id="FeedbackID">
     <h4 class="modal-title">Comment Box</h4>
      </div>
    	<div class="modal-body">
          <div class="box box-success">
             
            <div class="box-body chat" id="chat-box" style="overflow-y: scroll;height: 40vh;">
              <!-- chat item -->
              
               <!--  <div class="attachment">
                  <h4>Attachments:</h4>

                  <p class="filename">
                    Theme-thumbnail-image.jpg
                  </p>

                  <div class="pull-right">
                    <button type="button" class="btn btn-primary btn-sm btn-flat">Open</button>
                  </div>
                </div> -->
                <!-- /.attachment -->
              <!-- /.item -->
             
            </div>
            <!-- /.chat -->
            <div class="box-footer">
              <div class="input-group">
                <input class="form-control" placeholder="Type message..." id="comment">

                <div class="input-group-btn">
                  <button type="button" class="btn btn-success" onclick="saveComment()"><i class="fa fa-plus"></i></button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->
 	<!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>




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
window.setInterval(function(){
	//GetJobStatus();
}, 6000); 
</script>



<script type="text/javascript" language="JavaScript">

        function SetTextBoxValue($prVal) {
			  // alert(document.getElementById('Relevancy').value);
            
            document.getElementById('BatchID').value = $prVal;
            // document.getElementById('RelevantValue').value=document.getElementById('Relevancy').value;
            

        }
		 function SetTextBoxValue1($prVal) {
			
            document.getElementById('BatchID1').value = $prVal;

        }
		  function SetTextBoxValue2($prVal) {
			 
            document.getElementById('BatchID2').value = $prVal;

        }
         function SetTextBoxValue3($prVal) {
			 
            document.getElementById('BatchID3').value = $prVal;

        }
    </script>
 
  <script src="script.js"></script>
  <script src="GoldenGate.js"></script>
  <script src="WMSButton.js"></script>
  <script src="js/Feedback.js"></script>
  <script src="addons/addons.js"></script>
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




