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

		//sgml file 
		$sgmlF=isset($_GET['fileSgm']) ? $_GET['fileSgm'] : '';
		$sgmlFile = "uploadfiles/tempfiles/$sgmlF";

		?>

 </head>
<body class="hold-transition fixed skin-blue sidebar-mini layout-top-nav">
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

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Update SGML
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Update SGML</li>
      </ol>
    </section>
    <!-- Main content -->
   
    <section class="content">
         <div class="row">
              <div class="col-md-12">
                     <div class="box box-primary">
                        <div class="box-header with-border">    
                            
								<?php if(isset($_POST['submit'])): ?>
									<?php 
										  $target_dir = "uploadfiles/tempfiles/";
										  $target_file = $target_dir . basename($_FILES["file"]["name"]);
										  $uploadOk = 1;
										  $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
	  
										  $file_name =  $_FILES['file']['name'];	
									?>
									<?php if($fileType != "sgm" ): ?> 
										<?php
											$_SESSION['sgmError'] = "Sorry, only SGM files are allowed.";
											$uploadOk = 0;
										?>
									<?php endif; ?>

									<?php if($uploadOk  == 0): ?>
										<?php 	$_SESSION['sgmError'] = "Sorry, your file was not uploaded .";?>
									<?php else: ?>
									  
										<?php 
											if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
												
												$_SESSION['sgmSuccess'] = "Success, successfully uploaded file.";
											} else {
												
												$_SESSION['sgmError'] = "Sorry, there was an error uploading your file.";
											}
										
										?>
										<script> location.replace("updateSGML.php?BatchID=<?= $BatchID; ?>&fileSgm=<?= $file_name?>"); </script>
									<?php endif; ?>

								<?php endif;?>
                                                           
							 <?php if(isset($_GET['fileSgm'])):?>
							 <?php if(isset($_SESSION['sgmSuccess'])): ?>
								<div class="alert alert-success " role="alert">
									<strong><?= $_SESSION['sgmSuccess']; ?></strong>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							<?php endif; ?>
							<?php endif; ?>
							<?php if(isset($_SESSION['sgmError'])): ?>
								<div class="alert alert-danger " role="alert">
									<strong><?= $_SESSION['sgmError']; ?></strong>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							<?php endif; ?>
								<br />
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="file" name="file" id="file" class="form-control" required/>
                                <br />
                                <button type="submit" name="submit" class="btn btn-success btn-lg">Upload SGM</button>
                            </form>
							<?php unset($_SESSION['sgmError']); ?>
							<?php unset($_SESSION['sgmSuccess']); ?>
                        </div>
					
                     </div>
              </div>
        </div>
      <div class="row">
        <div class="col-md-6">
         
          <div class="nav-tabs-custom">
          
          	 <div class="tab-content" >
          	 	<div class="tab-pane  active" id="allocationDetails" >
				    <div class="box-body no-padding">
							<ul class="nav nav-tabs pull-right">
								<li class="active" onclick="RefreshEditor()"> <a href="#tab_1-9"  onclick="RefreshEditor()" data-toggle="tab">SGM file</a></li>
					
							</ul>
							<br />
							<br />
							<div class="tab-content" >
								<?php if($sgmlF != ""): ?>
									<?php $sgml = file_get_contents($sgmlFile); ?>	
								<?php endif; ?>
								  <div class="tab-pane active" id="tab_1-9"  >
										<fieldset>
											<div class="form-group" style="width:100%; height:65vh;">
													<?php if($sgmlF == ""): ?>
														<textarea id="sgmFile" rows="100" spellcheck="true"  name="sgmFile"></textarea>
													
													<?php else: ?>
														<textarea id="sgmFile" rows="100" spellcheck="true"  name="sgmFile"><?= $sgml; ?></textarea>
													
													<?php endif; ?>
													<script id="script">
															var prToggle=1;
															/*
															* Demonstration of code folding
															*/
														
															
															var te_html = document.getElementById("sgmFile");
															
															
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
								
											</div>
										</fieldset>
								  </div>
							</div>
                    </div>
            <!-- /.box-body -->
			  </div>


          	</div>
      	</div>
        	
		    <div class="box box-solid" style="display: none"  id="myDIV79">
            	
			
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
		  
		
		
        </div>
        <!-- /.col -->
       	
	 
	   <div class="col-md-6">
	     <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
		         <li class="active" onclick="RefreshEditor()"> <a href="#tab_1-1"  onclick="RefreshEditor()" data-toggle="tab">SGM Editor</a></li>
			  
            </ul>
			   
            <div class="tab-content" >
		
            <?php
			$sXML = file_get_contents($sXMLFile);
			//echo "<pre>";
			//print_r($sXML);
			//echo "</pre>";
			
			// $sXML =formatXmlString(trim($sXML));
			?>
              <!-- /.tab-pane -->
              <div class="tab-pane active" id="tab_1-1"  >
				
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
						
						<input type="hidden" value="<?= $Filename?>" id="filename" />
						<button type="button" class="btn btn-success btn-lg" id="uploadSGM">Update SGML</button>
						 
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