<?php
  require_once "conn.php";
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
    <?php include "sideBar.php"; ?>

  <!-- Content Wrapper. Contains page content -->
 
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         FTP file list
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">FTP files</li>
      </ol>
    </section>
    <?php
        // Establishing ftp connection 
       // $ftp_connection = ftp_ssl_connect($ftp_server, $port); 
    
    ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
                  
            </div>
            <div class="box-body">
                 <h2>FTP files</h2>
               
                 <?= "<p style='color:green; font-size:18px; font-weight:bold;'>".$_SESSION['succSave']."</p>"; ?>
                      
                 <?php $path = $_GET['path']; ?>
                 <?php $getFullPath = $_GET['getFullPath']; ?>
                 <?php
                      if($path == ""){
                          $files = $sftp->nlist('/TO_INNO/CONVERSION/');
                      }else{
                          $files = $sftp->nlist('/TO_INNO/CONVERSION/'.$path);
                      }

                      if($getFullPath){
                          $getFullFiles =  $sftp->nlist($getFullPath);
       
                      }
                      
                  ?>
                 <br />
                 <br />
                 <?php if($path ): ?>
                  <p style="font-size:18px;">File path: /TO_INNO/CONVERSION/<?= $path?></p> 
                 <?php endif;  ?>
                
                 <?php if($getFullPath ): ?>
                  <p style="font-size:18px;">File path: <?= $getFullPath; ?></p> 
                  <?php if(isset($_POST['submitDownload'])): ?>
                    <?php
                        $sftp->setTimeout(300);
                        $fExpD = explode('/', $getFullPath);

                        $fExp3d = $fExpD[3];
                        $fExp4d = $fExpD[4];
                        $fileConCatD = $fExp3d."-".$fExp4d;
                      
                        mkdir("TPCCR-Inventory/".$fileConCatD);
                     
                       foreach($_POST['fileHiddenDownload'] as $valueDownload){
                            $fileNameDownload = $getFullPath."/".$valueDownload;
                          
                            $local_file_pathD = "TPCCR-Inventory/".$fileConCatD."/".$valueDownload;
                          
                            $sftp->get($fileNameDownload, $local_file_pathD);

                            $created_at = date('Y-m-d H:i:s');
                            $updated_at = date('Y-m-d H:i:s');

                            $querySqlDownload = "SELECT * FROM tbl_tpccr_outlook_files WHERE Ref='$fileConCatD'";
                            $queryResultDownload = odbc_exec($conWMS, $querySqlDownload);
                            $dataGetDownload = odbc_fetch_array($queryResultDownload);
                            $getDataIdDownload = $dataGetDownload['Id']; 
                            

                            if(odbc_num_rows($queryResultDownload) > 0){
                              //
                            }else{
                                 //insert data to tpccr_outlook_files
                                 $sqlInsertDownload = "INSERT INTO tbl_tpccr_outlook_files(Ref, Bundle_No, Subject1, TAT, Delivery_Date, No_of_files, Source_Type, Source_path, created_at, updated_at)
                                 VALUES('$fileConCatD', '$fileConCatD', '$fileConCatD', '1', '$created_at', '1', 'FTP', '0', '$created_at', '$updated_at')";
                                 $resD = ExecuteQuerySQLSERVER($sqlInsertDownload,$conWMS);

                                 $querySqlD = "SELECT * FROM tbl_tpccr_outlook_files WHERE Ref='$fileConCatD'";
                                 $queryResultDownload1 = odbc_exec($conWMS, $querySqlD);
                                 $dataGetDownload1 = odbc_fetch_array($queryResultDownload1);
                                 $getDataIdDownload1 = $dataGetDownload1['Id']; 

                                 $insertInventoryD = "INSERT INTO TPCCR_INVENTORY(RefId, DocFilename, Data, flag, Pages, NumberOfPages, ProductType, remarks, status, INITID, TI_content, N_content, Date, FinalFilename, GraphicsFilename, InlineCode, ProcessType, WithTIFF, WithImageEdit, WithDocSegregate, FileType, ByteSize, Jobname, JobId, PriorityNo, DateRegistered)
                                 VALUES('$getDataIdDownload1', '$valueDownload', '0', '$fileConCatD', '0', '0', 'null', 'null', 'null', '0', '0', '0', '$created_at', 'NULL', 'NULL', 'NULL', 'null',  '0', '0', 'Yes', 'NULL', '0',  '0', '0', '0', '$created_at')";
                                 $res1D = ExecuteQuerySQLSERVER($insertInventoryD, $conWMS);



                            }

                            if(odbc_num_rows($queryResultDownload)){
                                //
                                $insertInventoryD = "INSERT INTO TPCCR_INVENTORY(RefId, DocFilename, Data, flag, Pages, NumberOfPages, ProductType, remarks, status, INITID, TI_content, N_content, Date, FinalFilename, GraphicsFilename, InlineCode, ProcessType, WithTIFF, WithImageEdit, WithDocSegregate, FileType, ByteSize, Jobname, JobId, PriorityNo, DateRegistered)
                                VALUES('$getDataIdDownload', '$valueDownload', '0', '$fileConCatD', '0', '0', 'null', 'null', 'null', '0', '0', '0', '$created_at', 'NULL', 'NULL', 'NULL', 'null',  '0', '0', 'Yes', 'NULL', '0',  '0', '0', '0', '$created_at')";
                                $res1D = ExecuteQuerySQLSERVER($insertInventoryD, $conWMS);
                            }


                            $_SESSION['messageDonwload'] = "File Successfully Downloaded Please go to Inventory Page now.";
                           
                        }                        
  
                    ?>
                  <?php endif; ?>
                  <?php if(isset($_SESSION['messageDonwload'])): ?>
                  <div class="alert alert-success " role="alert">
                      <strong><?= $_SESSION['messageDonwload']; ?></strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  <?php endif;  ?>
                  <?php unset($_SESSION['messageDonwload']); ?>

                  <form action="" method="post">
                      <?php foreach($getFullFiles as $fileDownload):  ?>

                          <?php if($fileDownload != "." && $fileDownload != ".."):?>
                            <?php 
                                //echo  $fileDownload. '<br />';  
                            ?>
                          <input type="hidden" name="fileHiddenDownload[<?= $fileDownload; ?>]" value="<?= $fileDownload; ?>"  />
                          <?php endif; ?>
                         
                      <?php endforeach; ?>
                      <button type="submit" name="submitDownload" class="btn btn-success">Download All</button>
                  </form>
                  <br />
                  <br />
                 <?php endif;  ?>
                 
                   
                  
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th width="45%">Name of File</th>
                            <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($getFullPath == ""):?>
                              <?php if($path == ""): ?>
                                <?php foreach($files as $dat): ?>
                                  <?php if($dat != "." && $dat != ".."):?>
                                  <?php
                                    
                                      $datExp = explode("/", $dat);
                                      //echo $datExp[4];    
                                  ?>
                                  <tr>
                                      <td><a href="ftpfile.php?path=<?= $dat; ?>"><?= $dat; ?></a></td>
                                      <td></td>
                                  </tr>
                                  <?php endif; ?>
                              <?php endforeach;?>
                            <?php else: ?>
                                <?php foreach($files as $dat): ?>
                                    <?php if($dat != "." && $dat != ".."):?>
                                    <?php
                                      
                                        $datExp = explode("/", $dat);
                                        //echo $datExp[4];    
                                    ?>
                                    <tr>
                                        <td><a href="ftpfile.php?getFullPath=/TO_INNO/CONVERSION/<?= $path?>/<?= $dat; ?>"><?= $dat; ?></a></td>
                                        <td></td>
                                    </tr>
                                    <?php endif;?>
                                <?php endforeach;?>
                              <?php endif; ?>
                            <?php else:?>

                              <?php 
                                  if(isset($_POST['submit'])){
                                      
                                      $sftp->setTimeout(300);
                                      $file = $_POST['fileHidden'];
                                      $filename = $getFullPath."/".$_POST['fileHidden'];

                                      $fExp = explode('/', $getFullPath);
                                      $fExp3 = $fExp[3];
                                      $fExp4 = $fExp[4];
                                      
                                      $created_at = date('Y-m-d H:i:s');
                                      $updated_at = date('Y-m-d H:i:s');

                                      $fileConCat = $fExp3."-".$fExp4;

                                      mkdir("TPCCR-Inventory/".$fileConCat."/");
                                       
                                      $local_file_path = "TPCCR-Inventory/".$fileConCat."/".$_POST['fileHidden'];
                                        
                                      $sftp->get($filename, $local_file_path);

                                      $querySql = "SELECT * FROM tbl_tpccr_outlook_files WHERE Ref='$fileConCat'";
                                      $queryResult2 = odbc_exec($conWMS, $querySql);
                                      $dataGet = odbc_fetch_array($queryResult2);
                                      $getDataId = $dataGet['Id']; 

                                      if(odbc_num_rows($queryResult2) > 0){
                                          //
                                      }else{
                                          //insert data to tpccr_outlook_files
                                          $sqlInsert = "INSERT INTO tbl_tpccr_outlook_files(Ref, Bundle_No, Subject1, TAT, Delivery_Date, No_of_files, Source_Type, Source_path, created_at, updated_at)
                                          VALUES('$fileConCat', '$fileConCat', '$fileConCat', '1', '$created_at', '1', 'FTP', '0', '$created_at', '$updated_at')";
                                          $res = ExecuteQuerySQLSERVER($sqlInsert,$conWMS);
                                          
                                          $getIds = "SELECT Id FROM tbl_tpccr_outlook_files where Ref='$fileConCat'";
                                          $res9= odbc_exec($conWMS, $getIds);   
                                          $data = odbc_fetch_array($res9);
                                          $dataId = $data['Id']; 

                                          $insertInventory = "INSERT INTO TPCCR_INVENTORY(RefId, DocFilename, Data, flag, Pages, NumberOfPages, ProductType, remarks, status, INITID, TI_content, N_content, Date, FinalFilename, GraphicsFilename, InlineCode, ProcessType, WithTIFF, WithImageEdit, WithDocSegregate, FileType, ByteSize, Jobname, JobId, PriorityNo, DateRegistered)
                                          VALUES('$dataId', '$file', '0', '$fileConCat', '0', '0', 'null', 'null', 'null', '0', '0', '0', '$created_at', 'NULL', 'NULL', 'NULL', 'null',  '0', '0', 'Yes', 'NULL', '0',  '0', '0', '0', '$created_at')";
                                          $res1 = ExecuteQuerySQLSERVER($insertInventory, $conWMS);

                                      }


                                      if(odbc_num_rows($queryResult2)){
                                          $insertInventory = "INSERT INTO TPCCR_INVENTORY(RefId, DocFilename, Data, flag, Pages, NumberOfPages, ProductType, remarks, status, INITID, TI_content, N_content, Date, FinalFilename, GraphicsFilename, InlineCode, ProcessType, WithTIFF, WithImageEdit, WithDocSegregate, FileType, ByteSize, Jobname, JobId, PriorityNo, DateRegistered)
                                          VALUES('$getDataId', '$file', '0', '$fileConCat', '0', '0', 'null', 'null', 'null', '0', '0', '0', '$created_at', 'NULL', 'NULL', 'NULL', 'null',  '0', '0', 'Yes', 'NULL', '0',  '0', '0', '0', '$created_at')";
                                          $res1 = ExecuteQuerySQLSERVER($insertInventory, $conWMS);
                                      }
                                     

                                      $_SESSION['message'] = "File Successfully Downloaded Please go to Inventory Page now.";
                                  } 
                              
                              ?>
                               <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-success " role="alert">
                                    <strong><?= $_SESSION['message']; ?></strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                <?php endif;  ?>
                                <?php unset($_SESSION['message']); ?>
                              <?php foreach($getFullFiles as  $fullFile): ?>
                                     
                                      <?php
                                        
                                          $datExp = explode("/", $fullFile);
                                          //echo $datExp[4];    
                                      ?>
                                      <tr>  
                                          <?php if($fullFile != "." && $fullFile != ".."):?>
                                          <td><?= $fullFile; ?></td>
                                          <td>  
   
                                            <form action="" method="post">

                                               <input type="hidden" name="fileHidden" value="<?= $fullFile; ?>"  />
                                               <button type="submit" name="submit"><i class="fa fa-download fa-2x" aria-hidden="true"></i></button>
                                            </form>    
                                            
                                          </td>
                                          <?php endif;?>
                                      </tr>
                                     
                                   
                                       
                                <?php endforeach;?>
                               
                            <?php endif; ?>
                           
                             
                          
                           
                        </tbody>
                    </table>
                  
                  <?php unset($_SESSION['succSave']); ?>
            </div>
           
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
