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
  <script type="text/javascript" language="JavaScript">

        function SetTextBoxValue($prVal) {
        
            document.getElementById('txtID').value = $prVal;

        }
    function SetTextBoxValue1($prVal) {
       
            document.getElementById('tID').value = $prVal;

        }
    </script>

<link href="repos/uploadfile.css" rel="stylesheet">
<script src="repos/jquery.min.js"></script>
<script src="repos/jquery.uploadfile.min.js"></script>

</head>
<body class="hold-transition fixed skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
     
<?php
if ($_SESSION['UserType']=='Admin'){
?>
		 <a href="index.php" class="logo">
<?php
		  }
		  else{
?>
<a href="Dashboard.php" class="logo">
<?php
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
         <?php include ("Notifications.php");?>
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
        File Registration
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">File Registration</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
               <h3 class="box-title"><!-- <a type="button" class="btn btn-block btn-primary"  href="multiplefileupload.html" target="_blank">Upload Files</a> --></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Jobname</th>
                  <th>Filename</th>
                  <th>Status</th>
                  <th>Priority</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
      
                <tr>
                  <td><?php echo $ff;?></td>
                  <td><?php echo $Status;?></td>
                  <td><?php echo $TotalLicense;?></td>
                </tr>
      

<script type="text/javascript">
                  
  function DisplayAttachment(prBookID){
        
      var response=document.getElementById("divFileList");
      //var jTextArea=document.getElementById("jTextArea").value;
      if (prBookID==''){
        prBookID = document.getElementById("BookID").value;  
      }
      document.getElementById("BookID").value=prBookID;
      response.innerHTML=="";
      var jTextArea = prBookID;
      var data = 'data='+encodeURIComponent(jTextArea);
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
          response.innerHTML=xmlhttp.responseText;
          DisplayImageAttachment(prBookID,"divBookDesign","AuthorsCopy");
          DisplayImageAttachment(prBookID,"divImageList","Riders");
          DisplayImageAttachment(prBookID,"divTable","Tables");
          DisplayImageAttachment(prBookID,"divIndex","Index");
          DisplayImageAttachment(prBookID,"divFillingInstructions","FI");
          DisplayImageAttachment(prBookID,"divChecklist","Checklist");


          document.getElementById("pbar").style.display = "none";
        }
      }
      xmlhttp.open("POST","ReadFile.php",true);
            //Must add this request header to XMLHttpRequest request for POST
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      
      xmlhttp.send(data);
      
  }
   function DisplayImageAttachment(prBookID,divList,prValue){
        
      var response=document.getElementById(divList);
      //var jTextArea=document.getElementById("jTextArea").value;
      response.innerHTML=="";
      var jTextArea = prBookID+"/" +prValue;
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
  function DeleteFile(){
        var jTextArea = document.getElementById("Path").value;
        var data = 'data='+encodeURIComponent(jTextArea);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
          if (xmlhttp.readyState==4 && xmlhttp.status==200){
             // response.innerHTML=xmlhttp.responseText;
             
            DisplayAttachment("");      
          }
        }
        xmlhttp.open("POST","DeleteFile.php",true);
              //Must add this request header to XMLHttpRequest request for POST
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        xmlhttp.send(data);
        
      }
    function setPath($prVal) {
          document.getElementById('Path').value = $prVal;
    }
</script>


                </tbody>
              
              </table>
            </div>
            
            <!-- /.box-body -->
           
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->

        <div class="col-md-6">
          <embed src="multiplefileupload.html" width="100%" height="500px" frameBorder="0"/>
        </div>
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
<div class="modal fade" id="modal-access">
  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">List of Files</h4>
      <hr>
       <form id="upload_form" enctype="multipart/form-data" method="post">

        <table border="0">
          <tr>
            <td>
              <label>File Type: </label> 
            </td>
            <td>
               <select id="FileType">
                  <option value="">Book</option>
                  <option value="AuthorsCopy">Authors Copy</option>
                  <option value="Riders">Riders</option>
                  <option value="Tables">Tables</option>
                  <option value="Index">Index</option>
                  <option value="FI">Filling Instructions</option>
                  <option value="Checklist">Checklist</option>
                </select>
            </td>
          <tr>
          <tr>
             <td>
              &nbsp;
            </td>
            <td>
               &nbsp;
            </td>
          </tr>
          <tr>
            <td>
              <label>File: </label> 
            </td>
            <td>
               <input type="file" name="file1" id="file1">
            </td>
          <tr>
        </table>

           
          <button  class='btn btn-s btn-primary pull-right' type="button"  onclick="uploadFile()">Upload File</button><br>
          <hr>
          <div id="pbar" style="display: none">
            <progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
            <h5 id="status"></h5>
            <p id="loaded_n_total"></p>
          </div>
      </form>

  
<script>
/* Script written by Adam Khoury @ DevelopPHP.com */
/* Video Tutorial: http://www.youtube.com/watch?v=EraNFJiY0Eg */
function _(el){
  return document.getElementById(el);
}
function uploadFile(){
  var file = _("file1").files[0];

  var x1 = document.getElementById("pbar");
   
    
  x1.style.display = "block";
 
  // alert(file.name+" | "+file.size+" | "+file.type);
  var formdata = new FormData();
  formdata.append("file1", file);
  formdata.append("FileType", document.getElementById("FileType").value);
  formdata.append("BookID", document.getElementById("BookID").value);
  

  var ajax = new XMLHttpRequest();
  ajax.upload.addEventListener("progress", progressHandler, false);
  ajax.addEventListener("load", completeHandler, false);
  ajax.addEventListener("error", errorHandler, false);
  ajax.addEventListener("abort", abortHandler, false);
  ajax.open("POST", "FileTaskUploader.php");
  ajax.send(formdata);
 

}
function progressHandler(event){
  _("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
  var percent = (event.loaded / event.total) * 100;
  _("progressBar").value = Math.round(percent);
  _("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
}
function completeHandler(event){
  _("status").innerHTML ="";

  alert(event.target.responseText);
  LoadPDF(event.target.responseText);
  _("progressBar").value = 0;
   DisplayAttachment("");
}
function errorHandler(event){
  _("status").innerHTML = "Upload Failed";
}
function abortHandler(event){
  _("status").innerHTML = "Upload Aborted";
}



</script>

</script>
    </div>
    <input type="hidden" id="BookID" >
    <div class="nav-tabs-custom">
    <ul class="nav nav-tabs pull-left">

      <li class="active"><a href="#allocationDetails" data-toggle="tab">Base File</a></li>
      <li ><a href="#BookDesign" data-toggle="tab">Author's Copy</a></li>
      <li ><a href="#JobQueue" data-toggle="tab">Riders</a></li>
      <li ><a href="#Table" data-toggle="tab">Table</a></li>
      <li ><a href="#Index" data-toggle="tab">Index</a></li>
      <li ><a href="#FillingInstructions" data-toggle="tab">Filling Instructions</a></li>
      <li ><a href="#Checklist" data-toggle="tab">Checklist</a></li>
   
    </ul>
      <div class="tab-content" >
        <div class="tab-pane  active" id="allocationDetails" >
            <div id="divFileList"></div>
        </div>
        <div class="tab-pane " id="BookDesign" >
            <div id="divBookDesign"></div>
        </div>
        <div class="tab-pane " id="JobQueue" >
            <div id="divImageList"></div>
        </div>
         <div class="tab-pane " id="Table" >
            <div id="divTable"></div>
        </div>
         <div class="tab-pane " id="Index" >
            <div id="divIndex"></div>
        </div>
         <div class="tab-pane " id="FillingInstructions" >
            <div id="divFillingInstructions"></div>
        </div>
         <div class="tab-pane " id="Checklist" >
            <div id="divChecklist"></div>
        </div>
      </div>
    </div>
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
  
   <form method="POST" action="DeleteBook.php">

        <div class="modal modal-danger fade" id="modal-danger">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Record Deletion</h4>
              </div>
              <div class="modal-body">
                <p>Are you sure you want to delete this record?</p>
                <input type="hidden" name="txtID" id="txtID" />
                <input type="hidden" name="TransType" id="TransType" value="Delete" />
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>

                <button type="submit" class="btn btn-outline">Ok</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
      </form>
      <div class="modal modal-danger fade" id="modal-delete">
        <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Delete Query</h4>
          </div>
          <div class="modal-body">
              <div class="form-group">
                <p>Are you sure you want to delete this file?</p>
              </div>
          </div>
          <input type="hidden" id="Path">
          <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
          <button type="Submit" class="btn btn-outline" data-dismiss="modal" onclick="DeleteFile()">Delete</button>
          </div>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
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
