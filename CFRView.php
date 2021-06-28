<?php
include "conn.php";
ini_set("odbc.defaultlrl", "5242880");
error_reporting(0);
	session_start();
	$ID=$_GET['ID'];
 
	if ($_SESSION['login_user']==''){
		 header("location: login.php");
	}
	
	
	$Source=0;
	$Styling=0;
	$XMLEditor=1;
	$SequenceLabeling=0;
	$TreeView=0;
	$TextCategorization=0;
		
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
    $ID=$_GET["ID"];


       $strSQL="Select * from tblCFR WHERE ID='$ID'";  
     
 
		$rs=odbc_exec($conWMS,$strSQL);
		$ctr = odbc_num_rows($rs);
		while(odbc_fetch_row($rs))
		{
			   
            $Title=odbc_result($rs,"Section");
            // $Content=odbc_result($rs,"XMLContent");
       
			   $sFile=odbc_result($rs,"XMLContent");
        $encoding = mb_detect_encoding($sFile, mb_detect_order(), false);
  
               if($encoding == "UTF-8")
              {
                $sFile = mb_convert_encoding($sFile, "UTF-8", "Windows-1252");    
              }
            
            
              $out = iconv(mb_detect_encoding($sFile, mb_detect_order(), false), "UTF-8//IGNORE", $sFile);
              $out = str_replace("Â§â€‰", "", $out);
              $out = str_replace("â€‰", " ", $out);
              $out = str_replace("â€￾", "", $out);
              $out = str_replace("â€”", " ", $out);
              $out = str_replace("â€œ", "", $out);
			$Content=$out;
		}
		?>
 <style type="text/css">
		#dialog-window {
  height: 200px;
  border: 1px black solid;
}

#scrollable-content {
  height: 35vw;
  overflow: auto;
 
}

#footer {
  height: 20px;
  background-color: green;
}
 </style>
   <script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
  <style type="text/css">
    #cke_1_top,
    /*#cke_1_bottom,*/
    .editor1{ display: none; }
  </style>


 </head>
 
<body class="hold-transition skin-blue sidebar-mini">
 

<div class="wrapper">
  
  
 
  
    <section class="content">
      <div class="row">

	   <div class="col-md-12"  style="height:55vw;">
	     <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li  class="active"><a href="#tab_1-1" data-toggle="tab">XML View</a></li>
			        <li class="pull-left header"><i class="fa fa-th"></i> </li>
            </ul>
			   
      <div class="tab-content"  style="height:45vw;" >
			<div class="tab-pane " id="tab_2-1"  >
				<div class="row" style="height:40vw;" >
					<div class="col-lg-12"  id="scrollable-content">
            <ul data-widget='tree' >
						 <div  id="xml_view" >
             </div>
           </ul>
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
              <div class="tab-pane active" id="tab_1-1"  >
				
					<fieldset>
					<div  style="width:100%; height:45vw;">
				 
					<textarea id="code" rows="150"  name="test_12"><?php echo $Content;?></textarea>
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
					   editor_html.setSize(null, 600);
					   editor_html.refresh();
					 
					  </script>
					  
					   <script>
					  function jumpToLine(prLineNo,prCol){
						  
						editor_html.refresh();
						editor_html.setCursor(prLineNo);
						
						editor_html.markText({line: prLineNo, ch: prCol}, {line: prLineNo, ch: prCol+5}, {className: "styled-background"});
					  }
					  </script>
				 
					
					
					
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
			    	<div class="box-footer">
			    		<div class="pull-left">
						   <h4 class="box-title"><b>Title:</b><?php echo $Title;?> <small><span id="pdfdownload"></span></small></h4>
						  </div>
				    	<div class="pull-right">
							   <button type="button" class="btn btn-success" id="checkout" style="display:none;">Check-out</button><button type="button" class="btn btn-danger .btn-sm" onclick="PrintPDF();" id="btnPreview" >Preview PDF</button>
						  </div>

              <script type="text/javascript">
                  
              function PrintPDF(){
                      var pdfdownload=document.getElementById("pdfdownload");
                     
                      //var jTextArea=document.getElementById("jTextArea").value;
                      var jTextArea = CKEDITOR.instances['editor1'].getData();
                      
                      var data = 'data='+encodeURIComponent(jTextArea);
                      var xmlhttp = new XMLHttpRequest();
                      xmlhttp.onreadystatechange=function(){
                        if (xmlhttp.readyState==4 && xmlhttp.status==200){
                          //response.innerHTML=xmlhttp.responseText;
                          pdfdownload.innerHTML=xmlhttp.responseText;
                          alert("PDF Generated successfully!");
                          
                        }
                      }
                      xmlhttp.open("POST","PrintPDF.php",true);
                            //Must add this request header to XMLHttpRequest request for POST
                      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                      
                      xmlhttp.send(data);
                       
                  }
                </script>
					</div>
                <div class="box-body pad">
						<iframe src="" id="htmlView" style="width:100%; height:34vw;"  frameborder="0"></iframe>
					<!-- 	<textarea id="editor1" name="editor1" rows="100" cols="80">
							<?php

// 								if ($FileStatus!='Done'){
						 
// 								//Read TXT FILE AND LOAD IT ON EDITOR
// 								$file= explode('.',$sFileVal[1]);
								 
// 								if (file_exists("uploadfiles/$file[0].htm")) {   
// 									$sFile= file_get_contents("uploadfiles/$file[0].htm");
// 									//echo readfile("uploadfiles/$file[0].htm"); 
// 								}
// 								else{
// 									$sFile= file_get_contents("uploadfiles/$file[0].html");
// 									//echo readfile("uploadfiles/$file[0].txt");
// 								}
								
// 								$encoding = mb_detect_encoding($sFile, mb_detect_order(), false);
		
// 							   if($encoding == "UTF-8")
// 								{
// 									$sFile = mb_convert_encoding($sFile, "UTF-8", "Windows-1252");    
// 								}
							
							
// 								$out = iconv(mb_detect_encoding($sFile, mb_detect_order(), false), "UTF-8//IGNORE", $sFile);
//                 $out = str_replace("&lt;", "<", $out);
//                 $out = str_replace("&gt;", ">", $out);


// }  

// echo  trim($out);
// 								}
							?>	
						</textarea> -->
				 
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
							height: 550,


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
				
				 
				
				  
				 
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3-2">
					        <div class="box-body">
                    
                        <div id="PreviousVersion">

                        </div>
                     
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
			
            <!-- /.tab-content -->
          </div>
		 
	   
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
 
 
 
 
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