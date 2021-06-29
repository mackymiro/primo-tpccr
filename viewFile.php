<?php
    require_once "conn.php";
    session_start();
    if ($_SESSION['login_user']==''){
            header("location: login.php");
    }
	$getFilePath = $_GET['path'];

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
         View Files
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">view files</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-7">
          <?php if(!empty($getFilePath)): ?>
          <div class="box box-primary">
            <div class="box-header with-border">
                <h3></h3>
                <?php
				
				
                  $getFilePaths = "SELECT INV.DocFilename,INV.ProcessType,outlook.Ref,outlook.id as outlookID FROM TPCCR_INVENTORY INV LEFT JOIN tbl_tpccr_outlook_files outlook ON outlook.Id = INV.RefId WHERE INV.Id=".$getFilePath;
                  $inventory = odbc_exec($conWMS, $getFilePaths);
				  $data = odbc_fetch_array($inventory);
				  
				  $PDFname = pathinfo($data['DocFilename'],PATHINFO_FILENAME).".pdf";
				  
				  $filepath = $_SERVER['DOCUMENT_ROOT']."/".$ProjectName."/".$folderName."/".$data['Ref']."/".pathinfo($data['DocFilename'],PATHINFO_FILENAME).".pdf";
				  $pdftext = file_get_contents($filepath);
			      $num = preg_match_all("/\/Page\W/", $pdftext, $dummy);
					
                ?>
				
				<fieldset>
					<div style="width:100%; height:40vw;">					
						<embed  src="<?= "/".$ProjectName."/".$folderName."/".$data['Ref']."/".pathinfo($data['DocFilename'],PATHINFO_FILENAME).".pdf" ?>" width="100%" height="100%"  style="border:none;" ></embed>
					</div>
				</fieldset>
				
                
            </div>
          </div>
          <?php endif; ?>
        </div>      
        <!-- /.col -->
		
		
		<!-- /.col -->
        <div class="col-md-5">
            <div class="box box-primary">
              <div class="box-header with-border">
                  
                <a href="forSegration.php?path=<?= $data['outlookID'] ?>" >Back to main directory</a>
				
				
				<button type="button" class="btn btn-info pull-right" id="Proceed">Proceed</button>
				 
				<br>
				<br>
				   
				<fieldset>
					<div style="width:100%; height:40vw; overflow-y: scroll;">					
					<form id="formPages">
					
					<table class="table">
					<thead>
					<tr>
						<td>Pages</td>
						<td>Sgm Filename</td>
						<td><center>With Image Edit</center></td>
					</tr>
					</thead>
					
					
						<?php
						
							for($i = 1; $i<=$num; $i++)
							{
								echo "<tr>";
								echo "<td>";
									if($i == 1){
										
										echo '<div>';
										echo '<input type="checkbox" id="page'.$i.'" name="page'.$i.'" value="'.$i.'" checked>';
										echo '<label for="page'.$i.'">  Page '.$i.' </label>';
										echo '</div>';
									}
									else{
										
										echo '<div>';
										echo '<input type="checkbox" id="page'.$i.'" name="page'.$i.'" value="'.$i.'" >';
										echo '<label for="page'.$i.'">  Page '.$i.' </label>';
										echo '</div>';
									}
									
								echo "</td>";
								
								echo "<td>";
								if($i == 1){
										
										echo "<div id='divpages$i'>";
										echo '<input type="text" id="input'.$i.'" name="input'.$i.'"  class="form-control">';
										echo "</div>";
									}
									else{
										
										echo "<div id='divpages$i'>";
										echo "</div>";
									}
								echo "</td>";
								
								
								echo "<td>";
								if($i == 1){
										
										echo "<center>";
										echo "<div id='divpagescheckbox$i'>";
										echo '<input type="checkbox" id="checkbox'.$i.'" name="checkbox'.$i.'" value="'.$i.'" >';
										echo "</div>";
										echo "</center>";
									}
									else{
										
										echo "<center>";
										echo "<div id='divpagescheckbox$i'>";
										echo "</div>";
										echo "</center>";
									}
								echo "</td>";
								
								
								
								echo "</tr>";
							}
						
						?>
					</table>	
					</form>
					</div>
				</fieldset>
				
				   
				   
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
	$(document).on('click', '#Proceed', function(e){
	e.preventDefault(); 
		
		var form = [];
		var name ="";
		var sgm ="";
		var checkbox = "";
		$("#formPages input:checkbox").each(function() {
			
			if($('#page'+$(this).val()).is(":checked") == true)
			{
				name = $(this).val();
				sgm = $("#input"+name).val();
				//checkbox = $("#checkbox"+name).val();
				
		
				checkbox =  $('#checkbox'+$(this).val()).is(":checked");
				
				form.push({
						group: name, 
						page: $(this).val(),
						sgm: sgm,
						checkbox :checkbox
				});
				
			}
			else{
				
				form.push({
						group: name, 
						page: $(this).val(),
						sgm: sgm,
						checkbox :checkbox
				});
				
			}
		
					
		});
		

		$.ajax({
			url: 'Controller/ChunkPDFController.php',
			type: "post",
			data: {form:form,PDFname:"<?= $PDFname ?>",Ref:"<?= $data['Ref'] ?>",inventory_id:'<?= $getFilePath ?>',outlook_id:"<?= $data['outlookID'] ?>",ProcessType:"<?= $data['ProcessType'] ?>" },
			beforeSend:function(){
			
				$("body").waitMe({
					effect: 'roundBounce',
					text: 'Please Wait ........ ',
					bg: 'rgba(255,255,255,0.90)',
					color: '#555'
				});
				
			},
			success: function (response) {
				
				$('body').waitMe('hide');
				
				if(response === "DONE" ){
					
					swal({
						type:'success',
						title:"Completed!",
						text:""
					}).then(function(){
							
							window.location.replace("./forSegration.php?path=<?= $data['outlookID'] ?>");
					});	
					
				}
				
			
				
			},
			error: function(jqXHR, textStatus, errorThrown) {
			   console.log(textStatus, errorThrown);
			}
		});
		


	}); 
	</script>
	
	<script type="text/javascript">
	$('#formPages input[type=checkbox]').change(function() { 
	
	
	//console.log( $('#page'+$(this).val()).is(":checked") ); 
	//console.log( $(this).val() ); 
			var id = $(this).val();
			if($('#page'+$(this).val()).is(":checked") == true)
			{
				$("#divpages"+id).empty().append('<input type="text" id="input'+id+'" name="input'+id+'" class="form-control">');
				$("#divpagescheckbox"+id).empty().append('<input type="checkbox" id="checkbox'+id+'" name="checkbox'+id+'" value="'+id+'" >');
				
			}
			else
			{
			
				$("#divpages"+id).empty();
				$("#divpagescheckbox"+id).empty();
				
				
			}
	
	});

	</script>
    
</body>
</html>