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


<style style="text/css">
  	.hoverTable{
		width:100%; 
		border-collapse:collapse; 
	}
	.hoverTable td{ 
		padding:7px; border:#4e95f4 1px solid;
    
	}
	/* Define the default color for all the table rows */
	.hoverTable tr{
		background: #b8d1f3;
	}
  
	/* Define the hover highlight color for the table row */
    .hoverTable tr:hover {
          background-color: #ffff99;
    }
   
</style>



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
         For Posting Files
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">for Posting files</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
	  
	  
	  
        <div class="col-md-12">
          <?php if(empty($getFilePath)): ?>
          <div class="box box-primary">
            <div class="box-header with-border">
                <h3></h3>
                <?php
				
				

			
					
                    $getData= "
					
					SELECT inv.Id,inv.RefId,inv.DocFilename,inv.FinalFileName,inv.NumberOfPages,inv.ByteSize,inv.status,inv.ProcessType,inv.WithImageEdit,outlook.Ref FROM TPCCR_INVENTORY inv LEFT JOIN tbl_tpccr_outlook_files outlook ON outlook.Id = inv.RefId WHERE inv.status = 'forPosting' 
					
					UNION ALL  
					
					SELECT seg.Id,seg.RefId,seg.DocFilename,seg.FinalFileName,seg.NumberOfPages,seg.ByteSize,seg.status,seg.ProcessType,seg.WithImageEdit,outlook.Ref FROM TPCCR_DOCUMENT_SEG seg LEFT JOIN tbl_tpccr_outlook_files outlook ON outlook.Id = seg.RefId    WHERE seg.status = 'forposting' 

					";
                    $FilesData=odbc_exec($conWMS,$getData);	
					
				
			

                ?>
                <table class="display table table-bordered table-striped">
                    <thead>
                          <tr>
                              <th>RefName</th>
                              <th>FileName</th>
                              <!--<th>No.of Pages</th>-->
                              <th>FinalName</th>
                              <th>ProcessType</th>
                              <th>withImageEdit</th>
                              <th>Action</th>							
                          </tr>
                    </thead>
                    <tbody>
                          <?php while(odbc_fetch_row($FilesData)): ?>
               
                              <tr>		

                                <td><?= odbc_result($FilesData, "Ref")?></td>
                                <td><?= odbc_result($FilesData, "DocFilename")?></td>
                                <!--<td><?php //odbc_result($FilesData, "NumberOfPages")?></td>-->
                                <td><?= odbc_result($FilesData, "FinalFilename")?></td>
                                <td><?= odbc_result($FilesData, "ProcessType")?></td>
								                <td><?= ( odbc_result($FilesData, "WithImageEdit") == 1 ? "Yes" : "") ?></td>
                                <td>
                                  <a href="javascript:void(0)" id="postFilewithGG"  data-RefId="<?= odbc_result($FilesData, "RefId")?>" data-Id="<?= odbc_result($FilesData, "Id")?>"  data-ProcessType="<?= odbc_result($FilesData, "ProcessType")?>"  data-WithImageEdit="<?= odbc_result($FilesData, "WithImageEdit")?>"  class="btn btn-success">Post File</a>
                                  
                                </td>
                                
                                
                              </tr>
 
                          <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
          </div>
          <?php endif; ?>
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
        $('table.display').DataTable( {} );
        $('#example1').DataTable()
          $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
          })
          $('#example3').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
          })
          $('#example4').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
          })
      })
    </script>
	
	<script type="text/javascript">
	$(document).on('click', '#postFilewithGG', function(e){
	e.preventDefault(); 
		
		var RefId =   $(this).attr("data-RefId");
		var Id = $(this).attr("data-Id");
		var ProcessType = $(this).attr("data-ProcessType");
		var WithImageEdit = $(this).attr("data-WithImageEdit");
		
		if(ProcessType == "Updating")
		{
			
			var urlPath = 'Controller/PostjobController.php';
		}
		else if(ProcessType == "New")
		{
			var urlPath = 'Controller/PostjobwithGGController.php';
			
		}
		
		
		$.ajax({
			url: urlPath,
			type: "post",
			data: {RefId:RefId,Id:Id,ProcessType:ProcessType,WithImageEdit:WithImageEdit},
			beforeSend:function(){
			
				$("body").waitMe({
					effect: 'roundBounce',
					text: 'Uploading Please Wait ........ ',
					bg: 'rgba(255,255,255,0.90)',
					color: '#555'
				});
				
			},
			success: function (response) {
				
				$('body').waitMe('hide');
				
				if(response === "DONE" ){
					
					swal({
						type:'success',
						title:"Posted!",
						text:""
					}).then(function(){
							
							window.location.replace("./forPostingfile.php");
					});	
					
				}
			
				
			},
			error: function(jqXHR, textStatus, errorThrown) {
			   console.log(textStatus, errorThrown);
			}
		});
		

	}); 
	</script>
	

	
    
</body>
</html>