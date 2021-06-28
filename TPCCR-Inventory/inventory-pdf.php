<?php
  require_once "../conn.php";
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
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
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
              <img src="../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $_SESSION['EName'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

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
    <?php include "../sideBar.php"; ?>

  <!-- Content Wrapper. Contains page content -->
 
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <h1>
         Inventory
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Inventory</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
  
  
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
                <?php $fileVal = "../uploadfiles/Sourcefiles/Document1.pdf";?>
                 <embed src="<?= $fileVal;?>" style="width:100%; height:37vw;" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">
				
            </div>
          
           
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="box box-primary">
              <div class="box-header with-border">
                  <button class="btn btn-success btn-lg">Approve</button>
                  <button class="btn btn-danger btn-lg">Cancel</button>
                  <br />
                  <br />
                  <form>
                    
                    <div class="col-md-6">
                      <label>FieldName</label>
                      <input type="text" name="fieldname" class="form-control" /> 
                      
                    </div>
                    <div class="col-md-6">
                      <label>Value</label>
                      <input type="text" name="fieldname" class="form-control" /> 
                    </div>
                    <div style="clear:both;"></div>
                    <div class="col-md-6">
                      <label>FieldName</label>
                      <input type="text" name="fieldname" class="form-control" /> 
                      
                    </div>
                    <div class="col-md-6">
                      <label>Value</label>
                      <input type="text" name="fieldname" class="form-control" /> 
                    </div>
                    <div style="clear:both;"></div>
                    <div class="col-md-6">
                      <label>FieldName</label>
                      <input type="text" name="fieldname" class="form-control" /> 
                      
                    </div>
                    <div class="col-md-6">
                      <label>Value</label>
                      <input type="text" name="fieldname" class="form-control" /> 
                    </div>
                    <div style="clear:both;"></div>
                    <div class="col-md-6">
                      <label>FieldName</label>
                      <input type="text" name="fieldname" class="form-control" /> 
                      
                    </div>
                    <div class="col-md-6">
                      <label>Value</label>
                      <input type="text" name="fieldname" class="form-control" /> 
                    </div>
                    <div style="clear:both;"></div>
                    <div class="col-md-6">
                      <label>FieldName</label>
                      <input type="text" name="fieldname" class="form-control" /> 
                      
                    </div>
                    <div class="col-md-6">
                      <label>Value</label>
                      <input type="text" name="fieldname" class="form-control" /> 
                    </div>
                    
                  </form>
                 
                                  
              </div>
            
            
              <!-- /.box-footer -->
            </div>
            <div class="box box-primary">
              <div class="box-header with-border">
                  
                   <a href="../inventory.php" >Back to main directory</a>
                    <?php 
                         $mydir = 'TPCCR-Inventory'; 
                        $root = __DIR__;
                        function is_in_dir($file, $directory, $recursive = true, $limit = 1000) {
                            $directory = realpath($directory);
                            $parent = realpath($file);
                            $i = 0;
                            while ($parent) {
                                if ($directory == $parent) return true;
                                if ($parent == dirname($parent) || !$recursive) break;
                                $parent = dirname($parent);
                            }
                            return false;
                        }
                        
                        $path = null;
                        if (isset($_GET['file'])) {
                            $path = $_GET['file'];
                            if (!is_in_dir($_GET['file'], $root)) {
                                $path = null;
                            } else {
                                $path = '/'.$path;
                            }
                        }
                        
                        if (is_file($root.$path)) {
                            readfile($root.$path);
                            return;
                        }  
                        $url = $_SERVER['REQUEST_URI'];    
            
                    
                    ?>
                  <h3>Ref Source Path: <?= $mydir; ?> </h3>  
                
                  <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                            <th width="35%">File name</th>
                           
                          </tr>
                      </thead>
                      <tbody>
                
                            <?php if($url != "/tpccr/inventory.php"): ?>
                            <?php  if ($path) echo '<a href="?file='.urlencode(substr(dirname($root.$path), strlen($root) + 1)).'" style="font-size:20px;"><i class="fa fa-folder fa-2x" aria-hidden="true"></i></a><br />';?>
                                <?php foreach(glob($root.$path.'/*') as $file): ?>
                                <?php
                                    $file = realpath($file);
                                    $link = substr($file, strlen($root) + 1);
                                ?>
                                <tr>
                                    <td><?php echo '<a  href="?file='.urlencode($link).'">'.basename($file).'</a><br />';?></td>
                                </tr>
                                <?php endforeach; ?>

                            <?php endif; ?>
                      </tbody>
                  </table>
              </div>
            
            
              <!-- /.box-footer -->
            </div>
        </div>
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

    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
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
