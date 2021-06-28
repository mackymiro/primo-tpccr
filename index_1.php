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
$isRework=0;
  if ($Task=='Rework'){
    $Task='STYLING';
    $isRework=1;
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
    // $file= explode('.',$sFileVal[1]);
     $filename = pathinfo(basename($sFileVal[1]), PATHINFO_FILENAME);
    $sText ='';
  // Loop to store and display values of individual checked checkbox.
    foreach($_POST['Classification'] as $selected){
      $sText=$sText.$selected."\r\n";
    }
    file_put_contents("uploadfiles/$filename.cls", $sText);
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
<!--
Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
--> 
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>primo</title>
	<script src="bower_components/ckeditor/4.13.1/ckeditor.js"></script>
	<script src="bower_components/ckeditor/4.13.1/samples/js/sample.js"></script>
 	
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
  
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<script type="text/javascript">
  function resizeIframe(obj){
     obj.style.height = 0;
     obj.style.height = '80%';
  }
</script>

 
<?php
// $file= explode('.',$sFileVal[1]);
$filename = pathinfo(basename($sFileVal[1]), PATHINFO_FILENAME);

if (file_exists("uploadfiles/$filename.xml")) {   
  $sXML = file_get_contents("uploadfiles/$filename.xml");
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
        function SetTextBoxValue3($prVal) {
       
            document.getElementById('BatchID3').value = $prVal;
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

    if ($isRework==1){
      $FileStatus='Rework';
    } 
    ?> 


</head>
<body class="hold-transition fixed skin-blue sidebar-mini"  onload="start()">

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

function LoadAutomation(prTab){

  if (prTab=='XML'){
     
    document.getElementById("ValidationLog").style.display = "block";
   
  }
  else{
    document.getElementById("ValidationLog").style.display = "none";
  }
 
  var response=document.getElementById("AutomationList");
  //var jTextArea=document.getElementById("jTextArea").value;
  var jTextArea = prTab;
  var data = 'data='+encodeURIComponent(jTextArea);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange=function(){
    if (xmlhttp.readyState==4 && xmlhttp.status==200){
      response.innerHTML=xmlhttp.responseText;
         
    }
  }
  xmlhttp.open("POST","LoadAutomation.php",true);
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
    <li><a href="fullscr.php?Rework=<?=$isRework;?>"><i class="fa fa-copy"></i> Split View</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
       
              <li  class="active"><a href="#allocationDetails" data-toggle="tab">Allocation Details</a></li>
        
              <li><a href="#JobQueue" data-toggle="tab" onclick="LoadStyles();">Styles</a></li>
              <li class="pull-left header"><i class="fa fa-th-large"></i> </li>
            </ul>

             <div class="tab-content" >
             
              <div class="tab-pane" id="JobQueue"  style="overflow-y: scroll; height:15vw;">
                <ul class="nav nav-pills nav-stacked">
                <div id="Joblist" >
                </div>
              </ul>
        </div>
        
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
            $State=odbc_result($rs,"State");
            $ActualFile=odbc_result($rs,"ActualFile");
            
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
                  window.location = "<?php echo $row[2];?>?FileURL=../uploadFiles/<?php echo $sFileVal[1];?>&FileName=<?php echo $sFileVal[1];?>&RedirectURL=https://10.160.0.80/primoregulatory/index.php&ID=<?php echo $row[0];?>";
                </script>
                
                <?php
                $_SESSION[$row[1]]=1;
              }
            
            }
                 
              
          }
        }
         
        
      }
          
      if ($Filename==''){
          $Filename= $sFileVal[1];
          $_SESSION['FileName']=$Filename;
      }
        
      ?>
      
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                 <li><a href="#"><i class="fa fa-file-o"></i>FileName: <u><span id="filename"><?php echo $Filename;?></span></u></a></li>
          <li><a href="#"><i class="fa fa-file-o"></i>JobName: <u><?php echo $Jobname;?></u></a></li>
          <li><a href="#"><i class="fa fa-clock-o"></i>State: <u><?php echo $State;?></u></a></li>
          <li><a href="#"><i class="fa fa-clock-o"></i>Actual Filename: <u><?php echo $ActualFile;?></u></a></li>
        <li><a href="#"><i class="fa fa-line-chart"></i>Status: <u><?php echo $StatusString;?></u></a></li>
                <li><a href="#"><i class="fa fa-clock-o"></i>Last Updated: <u><?php echo $LastUpdate;?></u></a></li>
        
        <?php
        if ($Status=='' && $StatusString=='Allocated'){
        ?>
        
          <div class="box-footer with-border">
           
          <div class="box-tools">
           <li>
            
            <button type="button" class="btn btn-default  pull-right"  data-toggle="modal" data-target="#modal-Start"  onclick="Javascript:SetTextBoxValue1(<?php echo $BatchID;?>)"><i class="fa fa-hourglass-start"></i> Start</button>
           </li>
           </div>
          </div>
        <?php
        }
        elseif($StatusString=='Ongoing'){
           
          ?>
        <div class="box-footer with-border">
           
          <div class="box-tools">
           <li> 
           
            <button type="button" class="btn btn-default  pull-right"  data-toggle="modal" data-target="#modal-success"  onclick="Javascript:SetTextBoxValue(<?php echo $BatchID;?>)"><i class="fa fa-check"></i> Set as completed</button>&nbsp;<button type="button" class="btn btn-default pull-right"  data-toggle="modal" data-target="#modal-Pending"  onclick="Javascript:SetTextBoxValue2(<?php echo $BatchID;?>)"><i class="fa fa-hourglass-2"></i> Pending</button>
            <button type="button" class="btn btn-default  pull-right"  data-toggle="modal" data-target="#modal-Hold"  onclick="Javascript:SetTextBoxValue3(<?php echo $BatchID;?>)"><i class="fa  fa-hand-stop-o"></i> Hold</button>
          
           </li>
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
        else{
          if ($isRework==0){
          ?>
          <li><button type="button" class="btn btn-default  pull-right"   onclick="Javascript:location.href ='GetNextBatch.php?Task=<?=$ProcessCode?>'"><i class="fa fa-hand-grab-o"></i> Get Next Batch</button> </li>
 
        <?php
          }
          else{
            ?>
            <li><button type="button" id="ReworkCompleted" class="btn btn-default  pull-right"   onclick="ReworkComplete()"><i class="fa fa-hand-grab-o"></i> Completed</button> </li>
            <?php
          }
        }
        ?>
              </ul>
            </div>
            <!-- /.box-body -->
        </div>

      </div>
      </div>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Automation Panel</h3>
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul  class="nav nav-pills nav-stacked" id="AutomationList">

            
              </ul>
            </div>
          </div>

          <div class="box box-solid" id="ValidationLog" style="display:none;">
            <div class="box-header with-border">
              <h3 class="box-title">Validation Log</h3>
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked"  style="overflow-y: scroll; height:10vw;"  id="ValidationList" >
                
              </ul> 
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
      // $file= explode('.',$sFileVal[1]);

       $filename = pathinfo(basename($sFileVal[1]), PATHINFO_FILENAME);
      $above95=GetWMSValue("Select * from tblConfidenceLevel WHERE Filename='$filename' AND Type='95% and up'","Count",$conWMS);
      $above80=GetWMSValue("Select * from tblConfidenceLevel WHERE Filename='$filename' AND Type='80 to 94%'","Count",$conWMS);
      $above70=GetWMSValue("Select * from tblConfidenceLevel WHERE Filename='$filename' AND Type='79% and below'","Count",$conWMS);
      
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
        
               
        if (file_exists("uploadfiles/$filename.htm")) {   
         
          $sTxt =  file_get_contents("uploadfiles/$filename.htm"); 
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
        // $file= explode('.',$sFileVal[1]);
        $filename = pathinfo(basename($sFileVal[1]), PATHINFO_FILENAME);     
        if (file_exists("uploadfiles/$filename.htm")) {   
         
          $sTxt =  file_get_contents("uploadfiles/$filename.htm"); 
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
         $filename = pathinfo(basename($sFileVal[1]), PATHINFO_FILENAME);
        // $file= explode('.',$sFileVal[1]);
               
        if (file_exists("uploadfiles/$filename.htm")) {   
         
          $sTxt =  file_get_contents("uploadfiles/$filename.htm"); 
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
    
    var editor =CKEDITOR.instances['editor'];
    var selectedHtml = "";
    var selection = editor.getSelection();
    if (selection) {
        selectedHtml = getSelectionHtml(selection);
    }
    var strHTML;
    if (prType==1){
      selectedHtml=  selectedHtml.replace("<div","<p");
      selectedHtml=  selectedHtml.replace("</div>","</p>");
      
      strHTML='<span class="'+ prStyle +'">' + selectedHtml + '</span>';
      
    }
    else{
      selectedHtml=  selectedHtml.replace('<div','<p');
      selectedHtml=  selectedHtml.replace(/<div>$/,'<p>');
      selectedHtml=  selectedHtml.replace(/<\/div>$/,'</p>');
      selectedHtml=  selectedHtml.replace(/<div>$/,'');
      selectedHtml=  selectedHtml.replace(/(<(div[^>]+)>)/gi,"");
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
    var value = CKEDITOR.instances['editor'].getData();
  
    var editor =CKEDITOR.instances['editor'];
    
    CKEDITOR.instances['editor'].focus();
   
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
     
    var editor =CKEDITOR.instances['editor'];
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
    
    var editor =CKEDITOR.instances['editor'];
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
    var jTextArea = CKEDITOR.instances['editor'].getData();
    var data = 'data='+encodeURIComponent(jTextArea);
                 
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
              //response.innerHTML=xmlhttp.responseText;
              
              editor_html.setValue(xmlhttp.responseText);
               $('#modal-progress').modal('hide');
               // $('#tab_1-1').trigger('click');
               $('[href="#tab_1-1"]').tab('show');

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
        // $file= explode('.',$sFileVal[1]);
         $filename = pathinfo(basename($sFileVal[1]), PATHINFO_FILENAME);    
        if (file_exists("uploadfiles/$filename.htm")) {   
         
          $sTxt =  file_get_contents("uploadfiles/$filename.htm"); 
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
         $xStatus = $_GET['Status'];
         
      ?>
              <li ><a href="#tab_1-1"  data-toggle="tab"  onclick="LoadAutomation('XML');">XML Editor</a></li>
         
        <?php

        
      }
      ?>
      <?php
      if ($Styling==1){
        
      ?>
              <!-- <li><a onclick="LoadHTMLFile('Okalahoma HB 1055.html')" href="#tab_2-2" data-toggle="tab">Styling</a></li> -->
              <li><a href="#tab_2-2" data-toggle="tab" onclick="LoadAutomation('Styling');">Styling</a></li>
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
                    <li role="presentation" ><a role="menuitem" tabindex="-1" href="preloader/index.php?APIURL=../<?php echo $row[2];?>&FileURL=../uploadFiles/<?php echo $sFileVal[1];?>&MLName=<?php echo $row[1];?>&FileName=<?php echo $sFileVal[1];?>&RedirectURL=https://10.160.0.80/primoregulatory/index.php&ID=<?php echo $row[0];?>"><i class="fa fa-fw fa-check"></i><?php echo $row[1];?></a></li>
                    
                <?php
              }
              else{
                ?>
                <li role="presentation" ><a role="menuitem" tabindex="-1" href="preloader/index.php?APIURL=../<?php echo $row[2];?>&FileURL=../uploadFiles/<?php echo $sFileVal[1];?>&MLName=<?php echo $row[1];?>&FileName=<?php echo $sFileVal[1];?>&RedirectURL=https://10.160.0.80/primoregulatory/index.php&ID=<?php echo $row[0];?>"><i class="fa fa-fw  fa-circle-o"></i><?php echo $row[1];?></a></li>
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


        <div id="fieldedForm">
          <button type="button"  onclick="TableView()">Table View</button>
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
              <label ><?php echo $FieldCaption;?></label><br>
              <select class="form-control" name="<?php echo $FieldName;?>">
                <?php
                $cats = explode("|",$FieldOption);
                foreach($cats as $cat) {
                  ?>
                  <option value="No"><?php echo  $cat;?></option>
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
              <label ><?php echo $FieldCaption;?></label><br>
              <textarea class="form-control" name="<?php echo $FieldName;?>" row=5></textarea>
            </div>

           <?php
            }
            else{
              ?>
               <div class="form-group">
              <label><?php echo $FieldCaption;?></label><br>
               <input type="<?php echo $FieldType;?>" class="form-control" placeholder="<?php echo $FieldCaption;?>" name="<?php echo $FieldName;?>"  >
              </div>
            <?php
            }
         
        }
      }
      ?>
          <div class="box-footer">
                 <input type="hidden" class="form-control" placeholder="" name="UID" value="<?php echo $UID;?>">
               
                <button type="submit" class="btn btn-primary">Save</button>
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
              <select class="form-control" name="<?php echo $FieldName;?>">
                <?php
                $cats = explode("|",$FieldOption);
                foreach($cats as $cat) {
                  ?>
                  <option value="No"><?php echo  $cat;?></option>
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
               
              <textarea class="form-control" name="<?php echo $FieldName;?>" row=5></textarea>
             </td>

           <?php
            }
            else{
              ?>
                <td>
              
               <input type="<?php echo $FieldType;?>" class="form-control" placeholder="<?php echo $FieldCaption;?>" name="<?php echo $FieldName;?>"  >
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
              <!-- /.tab-pane -->
      <div class="tab-pane " id="tab_1-1"  >
        
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
          
          
          <br>
          <div class="pull-left">
              
              <a  href='RenderXML.php?Filename=<?php echo "$filename.xml";?>' target="_blank" class="btn btn-info .btn-sm">HTML Viewer</a>
 
             </div>
            <div class="pull-right">
              <input type="hidden" name="fileVal" value="<?php echo "$filename.xml";?>">
              

              <button type="button" onclick="ValidateXML()" class="btn btn-danger .btn-sm">Validate</button>
              <button type="button" onclick="saveXML()" class="btn btn-success .btn-sm">Save</button>
       
             </div>


          </div>
        
 

<script id="script">
    /*
     * Demonstration of code folding
     */
     function completeAfter(cm, pred) {
          var cur = cm.getCursor();
          if (!pred || pred()) setTimeout(function() {
            if (!cm.state.completionActive)
              cm.showHint({completeSingle: false});
          }, 100);
          return CodeMirror.Pass;
        }

        function completeIfAfterLt(cm) {
          return completeAfter(cm, function() {
            var cur = cm.getCursor();
            return cm.getRange(CodeMirror.Pos(cur.line, cur.ch - 1), cur) == "<";
          });
        }

        function completeIfInTag(cm) {
          return completeAfter(cm, function() {
            var tok = cm.getTokenAt(cm.getCursor());
            if (tok.type == "string" && (!/['"]/.test(tok.string.charAt(tok.string.length - 1)) || tok.string.length == 1)) return false;
            var inner = CodeMirror.innerMode(cm.getMode(), tok.state).state;
            return inner.tagName;
          });
        }
     
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
      gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"],
      extraKeys: {
            "F11": function(cm) {
              cm.setOption("fullScreen", !cm.getOption("fullScreen"));
            },
            "Esc": function(cm) {
              if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
            },
            "Ctrl-Q": function(cm){ 
              cm.foldCode(cm.getCursor()); 
            },
            "Ctrl-S": function(cm){ 
              saveXML(); 
            },
            "'<'": completeAfter,
            "'/'": completeIfAfterLt,
            "' '": completeIfInTag,
            "'='": completeIfInTag,
            "Ctrl-Space": "autocomplete"
          }
      });
       
    editor_html.refresh();
     
      </script>
      
       <script>
      function jumpToLine(prLineNo,prCol){
        
      editor_html.refresh();
      editor_html.setCursor(prLineNo);
      
      // editor_html.markText({line: prLineNo, ch: prCol}, {line: prLineNo, ch: prCol+5});
      }
      </script>
 <script>
      function ReworkComplete(){
        var filename=document.getElementById("filename").innerHTML;
      
        var data = 'data='+encodeURIComponent(filename);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
          if (xmlhttp.readyState==4 && xmlhttp.status==200){
            //response.innerHTML=xmlhttp.responseText;

            alert(xmlhttp.responseText);
            document.getElementById("ReworkCompleted").style.display="none";
             
          }
        }
        xmlhttp.open("POST","ReworkComplete.php",true);
              //Must add this request header to XMLHttpRequest request for POST
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);

      }
      function saveXML(){
         
        var response=document.getElementById("response");
        var data = 'data='+encodeURIComponent(editor_html.getValue());
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
          if (xmlhttp.readyState==4 && xmlhttp.status==200){
            //response.innerHTML=xmlhttp.responseText;
            alert("File successfully save!");
          }
        }
        xmlhttp.open("POST","saveXMLFile.php",true);
              //Must add this request header to XMLHttpRequest request for POST
              xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);

      }

      function ValidateXML(){
        $("#modal-validate").modal();
        var response=document.getElementById("ValidationList");
        var data = 'data='+encodeURIComponent(editor_html.getValue());
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
          if (xmlhttp.readyState==4 && xmlhttp.status==200){
            response.innerHTML=xmlhttp.responseText;

            $('#modal-validate').modal('hide');
            alert("File successfully validated!");
          }
        }
        xmlhttp.open("POST","ValidateXML.php",true);
              //Must add this request header to XMLHttpRequest request for POST
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);

      }

  </script>


        
          <?php
          
        if ($fileVal!=''){
          
        // $file= str_replace(".pdf",".log",$sFileVal[1]);
        // $file= str_replace(".PDF",".log",$file);

        $sfileName= explode(".",$sFileVal[1] );
        $file= $sfileName[0].".log";

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
          <textarea id="editor" name="editor1" rows="100" cols="80">
          	<!-- <div id="editor"> -->
          <?php
          if ($FileStatus!='Done'){
           
              //Read TXT FILE AND LOAD IT ON EDITOR
              // $file= explode('.',$sFileVal[1]);
              $filename = pathinfo(basename($sFileVal[1]), PATHINFO_FILENAME);
              if (file_exists("uploadfiles/$filename.htm")) {   
                $sFile= file_get_contents("uploadfiles/$filename.htm");
                //echo readfile("uploadfiles/$file[0].htm"); 
              }
              else{
                $sFile= file_get_contents("uploadfiles/$filename.html");
                //echo readfile("uploadfiles/$file[0].txt");
                $sFile= str_replace("<div", "<p", $sFile) ;
                $sFile= str_replace("</div>", "</p>", $sFile) ;
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
          <!-- </div> -->
            </textarea>


        </div>

        <script>
	initSample();
</script>
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
                    //  elementPath = this.elementPath();
                    
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
              //      var style = new CKEDITOR.style( styles[ $ctr ] ),
              //        elementPath = this.elementPath();
                    
              //      this[ style.checkActive( elementPath ) ? 'removeStyle' : 'applyStyle' ]( style );
              //      this.fire( 'saveSnapshot' );
              
              $ctr++;
            }
            
          }
           
        }
       
         
        ?>  
        <script>
          CKEDITOR.config.allowedContent=true;
          CKEDITOR.config.disableAutoInline = true;
            CKEDITOR.replace( 'editor', {
              extraPlugins: 'stylesheetparser',
              height: 520,
              // Custom stylesheet for editor content.
              contentsCss: ['bower_components/ckeditor/stylesheetparser.css'],
                 
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


        
        <script type="text/javascript">

        function LoadHTMLFile(prFilename){

        
            var jTextArea = "index";
            var data = 'data='+encodeURIComponent(jTextArea);
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange=function(){
              if (xmlhttp.readyState==4 && xmlhttp.status==200){
                
                CKEDITOR.instances['editor'].setData(xmlhttp.responseText);
                   
              }
            }
            xmlhttp.open("POST","uploadfiles/"+prFilename,true);
                  //Must add this request header to XMLHttpRequest request for POST
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            
            xmlhttp.send(data);
            
          }


        </script>
           </form>
        
          <div class="box-footer">
            <button onclick="GenerateXML()">Transform</button>
          <div class="pull-right">
            <input type="hidden" name="fileVal" value="<?php echo "$filename.xml";?>">
            <!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-shortcut" ><i class="fa fa-keyboard-o"></i> Shortcut key</button> -->
             <?php
             if ($Status==''){
              if ($StatusString=='Ongoing'){
             ?>
            <!-- <button type="submit" class="btn btn-primary"><i class="fa fa-gear"></i> Transform</button> -->
            <?php
              }
             }
             ?>
          
          </div>
          <div class="pull-left">
          <form method ="post" action="API/ExecutePlugin.php">
          <?php
              //Read TXT FILE AND LOAD IT ON EDITOR
              // $file= explode('.',$sFileVal[1]);
                $filename = pathinfo(basename($sFileVal[1]), PATHINFO_FILENAME);
              if (file_exists("uploadfiles/$filename.htm")) {   
                $sFile= file_get_contents("uploadfiles/$filename.htm");
                //echo readfile("uploadfiles/$file[0].htm"); 
              }
              else{
                $sFile= file_get_contents("uploadfiles/$filename.html");
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
             
              
               
            <input type="hidden" name="fileVal" value="<?php echo "$filename.htm";?>">
            <!-- <select  id="candidate" name="Plugin"> -->
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
                <!-- <option value="<?php echo $PluginName;?>"><?php echo $PluginName;?></option> -->
              <?php 
              }
              }
              ?>
            <!-- </select>  <button type="submit" class="btn btn-success .btn-sm">Execute</button> -->
          </form>
          </div>
        </div>
         
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane active" id="tab_3-2">
        <?php
        $info = pathinfo( $fileVal);
        $snewile =str_replace("." . $info["extension"],".pdf",$fileVal);  
        $snewile =str_replace("." . $info["extension"],".PDF",$snewile);  
         
         

        if ($FileStatus!='Done'){
         
        if ($info["extension"] == "pdf"||$info["extension"] == "PDF") {
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
              ?>
               <?php
           
              ?>
              <embed src="<?php echo $fileVal;?>" style="width:100%; height:37vw;" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">
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
    <!--Modal Search and replace  -->

    <div class="modal modal-primary fade" id="modal-SearchAndReplace">
        <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Search and Replace</h4>
          </div>
          <div class="modal-body">
           Search:
           <input class="form-control" type="text" name="txtSearch" id ="txtSearch">
           Replace:
           <input class="form-control" type="text" name="txtReplace" id ="txtReplace">
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-outline" onclick="SearchAndReplace()"  data-dismiss="modal">Replace</button>
          </div>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

    <!-- End of modal -->
    
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
           <input type="hidden" name="BatchID3" value="<?php echo "$BatchID";?>">
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


<div class="modal fade" id="modal-progress">
  <div class="modal-dialog  modal-sm">
  <div class="modal-content">
     <p align="center">
     <img src="images/Preloader_3/Preloader_3.gif">
    </p>
     <p align="center">
    Converting html to xml...
    </p>
  </div>
  <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
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
 
<script src="addons/addons.js"></script>
 
  <script src="script.js"></script>
  
</body>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
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