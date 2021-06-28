
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
	
	$nWorkFlowID=$_GET['WorkFlowID'];
	if ($nWorkFlowID==''){
		$nWorkFlowID=$_SESSION['WorkFlowID'];
	}
	$_SESSION['WorkFlowID']=$nWorkFlowID;
	
	if ($_SESSION['login_user']==''){
		 header("location: login.php");
	}
	
	$page=$_GET['page'];
	if ($page==''){
		$page=$_SESSION['page'];
	}
	$_SESSION['page']=$page;
	

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
$sql="SELECT * FROM tbltaskeditorsetting Where TaskID='$TaskID' ";
 
if ($result=mysqli_query($con,$sql))
{
// Fetch one and one row
while ($row=mysqli_fetch_array($result))
	{
		$Source=$row['Source'];
		$Styling=$row['Styling'];
		$XMLEditor=$row['XMLEditor'];
		$SequenceLabeling=$row['SequenceLabeling'];
		$TextCategorization=$row['TextCategorization'];
		$DataEntry=$row['DataEntry'];
		$TreeView=$row['TreeView'];
		$WordViewer=$row['WordViewer'];
	}
}
	
 
    $nTitle=$_GET['Title'];
	if ($nTitle==''){
		$nTitle=$_SESSION['Title'];
	}
	$_SESSION['Title']=$nTitle;
 
?>
<!DOCTYPE html>
<html>
<head>
	<title>primo</title>

	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="source/stable/layout-default.css">

	<style type="text/css">

	/* remove padding and scrolling from elements that contain an Accordion OR a content-div */
	.ui-layout-center ,	/* has content-div */
	.ui-layout-west ,	/* has Accordion */
	.ui-layout-east ,	/* has content-div ... */
	.ui-layout-east .ui-layout-content { /* content-div has Accordion */
		padding: 0;
		overflow: hidden;
	}
	.ui-layout-center P.ui-layout-content {
		line-height:	1.4em;
		margin:			0; /* remove top/bottom margins from <P> used as content-div */
	}
	h3, h4 { /* Headers & Footer in Center & East panes */
		font-size:		1.1em;
		background:		#EEF;
		border:			1px solid #BBB;
		border-width:	0 0 1px;
		padding:		7px 10px;
		margin:			0;
	}
	.ui-layout-east h4 { /* Footer in East-pane */
		font-size:		0.9em;
		font-weight:	normal;
		border-width:	1px 0 0;
		background-color: #FFA07A;
	}
	</style>
	<script src="js/jquery-3.4.1.min.js"></script>
	<!--<script src="js/jquery-2.js"></script>-->
	<script src="js/jquery.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="source/stable/jquery.layout.js"></script>

    <script src="js/themeswitchertool.js"></script> 
	<script type="text/javascript" src="source/stable/callbacks/jquery.layout.resizePaneAccordions.js"></script>
	<script type="text/javascript">
	// create global var for layout so we can call myLayout.resize() after changing a theme
	var myLayout;

	$(document).ready(function(){

		// create tabs FIRST so elems are correct size BEFORE Layout measures them
		$(".ui-layout-center").tabs();

		// create a layout with default settings
		myLayout = $('body').layout();

		// add themeswitcher tool for testing different looks
		 

	});
	</script>
	<link rel="icon" href="innodata.png">
	

	<script src="bower_components/ckeditor/4.14.0/ckeditor.js"></script>
	<!-- <script type="text/javascript" src="bower_components/ckeditor/4.13.1/plugins/lite/lang/en.js"></script>
	<script type="text/javascript" src="bower_components/ckeditor/4.13.1/plugins/lite/ -->li 

	<script src="bower_components/ckeditor/4.14.0/samples/js/sample.js"></script>


	<script type="text/javascript" src="js/debug.js"></script>
 
	<style>
	/* Dropdown Button */
		.dropbtn {
		  background-color: #4CAF50;
		  color: white;
		  padding: 16px;
		  font-size: 16px;
		  border: none;
		}

		/* The container <div> - needed to position the dropdown content */
		.dropdown {
		  position: relative;
		  display: inline-block;
		}

		/* Dropdown Content (Hidden by Default) */
		.dropdown-content {
		  display: none;
		  position: absolute;
		  background-color: #f1f1f1;
		  min-width: 160px;
		  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		  z-index: 1;
		}

		/* Links inside the dropdown */
		.dropdown-content a {
		  color: black;
		  padding: 12px 16px;
		  text-decoration: none;
		  display: block;
		}

		/* Change color of dropdown links on hover */
		.dropdown-content a:hover {background-color: #ddd;}

		/* Show the dropdown menu on hover */
		.dropdown:hover .dropdown-content {display: block;}

		/* Change the background color of the dropdown button when the dropdown content is shown */
		.dropdown:hover .dropbtn {background-color: #3e8e41;}
	</style>
<!-- lte style-->	
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
	
	<style type="text/css">
 a:hover {
  cursor:pointer;
 }
</style>
	  

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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

<script type="text/javascript">
	$(document).ready( function() {

		myLayout = $('body').layout({
			west__size:			300
		,	east__size:			300
			// RESIZE Accordion widget when panes resize
		,	west__onresize:		$.layout.callbacks.resizePaneAccordions
		,	east__onresize:		$.layout.callbacks.resizePaneAccordions
		});

		// ACCORDION - in the West pane
		$("#accordion1").accordion({
			heightStyle:	"fill"
		});
		
		// ACCORDION - in the East pane - in a 'content-div'
		$("#accordion2").accordion({
			heightStyle:	"fill"
		,	active:			1
		});


		// THEME SWITCHER
		 
		// if a new theme is applied, it could change the height of some content,
		// so call resizeAll to 'correct' any header/footer heights affected
		// NOTE: this is only necessary because we are changing CSS *AFTER LOADING* using themeSwitcher
		setTimeout( myLayout.resizeAll, 1000 ); /* allow time for browser to re-render with new theme */

	});
	</script>
	<!--code mirror-->
	<link rel="stylesheet" href="lib/codemirror.css">
  <link rel="stylesheet" href="addon/fold/foldgutter.css" />
  <link rel="stylesheet" href="addon/dialog/dialog.css">
  <link rel="stylesheet" href="addon/search/matchesonscrollbar.css">
  
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
	  .styled-background1 { background-color: white; }
  </style>
 <script src="addon/display/fullscreen.js"></script>
	<!--END-->
  <script>
			function save(){
				 
				var response=document.getElementById("response");
				var data = 'data='+editor_html.getValue();
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange=function(){
				  if (xmlhttp.readyState==4 && xmlhttp.status==200){
				    //response.innerHTML=xmlhttp.responseText;
				    // alert("File successfully save!");
				  }
				}
				xmlhttp.open("POST","saveFile.php",true);
			        //Must add this request header to XMLHttpRequest request for POST
			        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlhttp.send(data);

			}
	</script>
<!--View Current Status-->
<?php
$sql="SELECT * FROM primo_view_Jobs Where ProcessCode='$Task' AND BatchID='$BatchID'  ";	
		 
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
    $nfile=$sxfilename.".xml";
	$sXMLFile = "uploadfiles/".$nfile;
		?>


	<script type="text/javascript">
			   function LoadFileonQueue(){
			         
			      var BookID= document.getElementById("BookID").value;
			      var response=document.getElementById("Filelist");

			   //    alert(prType);
				  // document.getElementById("ListCaption").outerHTML="(" + prType +")"
			      
			      //var jTextArea=document.getElementById("searchJob").value;
			      var jTextArea = BookID;
			      var data = 'data='+encodeURIComponent(jTextArea);
			      var xmlhttp = new XMLHttpRequest();
			      xmlhttp.onreadystatechange=function(){
			        if (xmlhttp.readyState==4 && xmlhttp.status==200){
			          response.innerHTML=xmlhttp.responseText;
			           
			        }
			      }
			      xmlhttp.open("POST","AuthorCopyRiders.php",true);
			            //Must add this request header to XMLHttpRequest request for POST
			      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			      
			      xmlhttp.send(data);
			      
			  }

		
			    function LoadJobonQueue(){
			        
			      
			      var response=document.getElementById("Joblist");
			      //var jTextArea=document.getElementById("searchJob").value;
			      var jTextArea = "fullscr";
			      var data = 'data='+encodeURIComponent(jTextArea);
			      var xmlhttp = new XMLHttpRequest();
			      xmlhttp.onreadystatechange=function(){
			        if (xmlhttp.readyState==4 && xmlhttp.status==200){
			          response.innerHTML=xmlhttp.responseText;
			          
			        }
			      }
			      xmlhttp.open("POST","JobQueue.php",true);
			            //Must add this request header to XMLHttpRequest request for POST
			      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			      
			      xmlhttp.send(data);
			      
			  }

			    function LoadErrorList(){
			        
			      
			      var response=document.getElementById("ErrorList");
			      //var jTextArea=document.getElementById("searchJob").value;
			      var BookID= document.getElementById("BookID").value;
			      var jTextArea = BookID;
			      var data = 'data='+encodeURIComponent(jTextArea)+"&Proofing="+encodeURIComponent(document.getElementById("Proofing").value);
			      var xmlhttp = new XMLHttpRequest();
			      xmlhttp.onreadystatechange=function(){
			        if (xmlhttp.readyState==4 && xmlhttp.status==200){
			          response.innerHTML=xmlhttp.responseText;
			          
			        }
			      }
			      xmlhttp.open("POST","LoadErrorList.php",true);
			            //Must add this request header to XMLHttpRequest request for POST
			      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			      
			      xmlhttp.send(data);
			      
			  }
			  function DeleteRecord(){
		        var jTextArea = document.getElementById("ErrorID").value;
		        var data = 'data='+encodeURIComponent(jTextArea);
		        var xmlhttp = new XMLHttpRequest();
		        xmlhttp.onreadystatechange=function(){
		          if (xmlhttp.readyState==4 && xmlhttp.status==200){
		             // response.innerHTML=xmlhttp.responseText;
		             // alert(xmlhttp.responseText);
		            LoadErrorList();      
		          }
		        }
		        xmlhttp.open("POST","DeleteError.php",true);
		              //Must add this request header to XMLHttpRequest request for POST
		        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		        
		        xmlhttp.send(data);
		        
		      }
			  function ClearForm(){
			  	document.getElementById("ErrorValue").value="";
	        	document.getElementById("ExpectedValue").value="";
	        	document.getElementById("ErrorCount").value="";
	        	document.getElementById("PageNo").value="";
	        	document.getElementById("ErrorType").value="";
			  }
               function SaveError(){
			        

			      //var jTextArea=document.getElementById("searchJob").value;
			      var BookID= document.getElementById("BookID").value;
			      var jTextArea = BookID;
			      var data = 'data='+encodeURIComponent(jTextArea)+"&Proofing="+encodeURIComponent(document.getElementById("Proofing").value)+"&ErrorValue="+encodeURIComponent(document.getElementById("ErrorValue").value)+"&ExpectedValue="+encodeURIComponent(document.getElementById("ExpectedValue").value)+"&ErrorCount="+encodeURIComponent(document.getElementById("ErrorCount").value)+"&PageNo="+encodeURIComponent(document.getElementById("PageNo").value)+"&ErrorType="+encodeURIComponent(document.getElementById("ErrorType").value);
			      var xmlhttp = new XMLHttpRequest();
			      xmlhttp.onreadystatechange=function(){
			        if (xmlhttp.readyState==4 && xmlhttp.status==200){
			        	document.getElementById("ErrorValue").value="";
			        	document.getElementById("ExpectedValue").value="";
			        	document.getElementById("ErrorCount").value="";
			        	document.getElementById("PageNo").value="";
			        	document.getElementById("ErrorType").value="";
			        	 
			            LoadErrorList();
			          
			        }
			      }
			      xmlhttp.open("POST","SaveError.php",true);
			            //Must add this request header to XMLHttpRequest request for POST
			      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			      
			      xmlhttp.send(data);
			      
			  }

			  function SearchJobonQueue(){
			        
			      
			      var response=document.getElementById("Joblist");
			      var searchKeyword=document.getElementById("searchJob").value;
			      var jTextArea = "fullscr_" + searchKeyword;
			      var data = 'data='+encodeURIComponent(jTextArea);
			      var xmlhttp = new XMLHttpRequest();
			      xmlhttp.onreadystatechange=function(){
			        if (xmlhttp.readyState==4 && xmlhttp.status==200){
			          response.innerHTML=xmlhttp.responseText;
			          
			        }
			      }
			      xmlhttp.open("POST","JobQueue.php",true);
			            //Must add this request header to XMLHttpRequest request for POST
			      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			      
			      xmlhttp.send(data);
			      
			  }
			</script>

			<script>
				 function SetTextBoxValue($prVal) {
        
		            document.getElementById('FeedbackID').value = $prVal;

		        }
			</script>
</head>
<SCRIPT ID=clientEventHandlersJS LANGUAGE=javascript>
<!--
 
function OpenFromLocal()
{
		document.all.OA1.OpenFileDialog();
		//You can call the Open method to open silently.
}

function OpenFromServer(sPath)
{
		//var sPath= window.prompt("Type the file url:", "http://www.ocxt.com/demo/samples/sample.doc");
		
		document.all.OA1.Open(sPath);
		 document.getElementById("openfile").style.display = "none";
}

function CreateNew()
{	
	document.all.OA1.CreateNew("Word.Application");
	document.getElementById("openfile").style.display = "none";

}

function PrintDoc()
{
		if(document.all.OA1.IsOpened()){
			document.all.OA1.PrintDialog();
		}
}

function PrintPreview()
{
		if(document.all.OA1.IsOpened()){
			document.all.OA1.PrintPreview();
		}
}

function ProtectDocOnlyRevisions()
{
		if(document.all.OA1.IsOpened()){
			document.all.OA1.ProtectDoc(0);//wdAllowOnlyRevisions
		}
}

function ProtectDocOnlyForm()
{
		if(document.all.OA1.IsOpened()){
			document.all.OA1.ProtectDoc(2);//wdAllowOnlyFormFields
		}
}

function UnProtectDoc()
{
		if(document.all.OA1.IsOpened()){
			document.all.OA1.UnProtectDoc();
		}
}

function DocIsDirty()
{
		if(document.all.OA1.IsOpened()){
			if(document.OA1.IsDirty)
			{
					window.alert("The file has been modified!");
			}
			else{
					window.alert("The file hasn't been modified!");
			} 
		}
}

function ShowHideToolbar()
{
		if(document.all.OA1.IsOpened()){
			var x = document.OA1.Toolbars; 
			document.OA1.ShowMenubar(! x);
			document.OA1.Toolbars= ! x;
		}
}

function DisableHotKey()
{
		if(document.all.OA1.IsOpened()){
			document.all.OA1.DisableSaveHotKey(true);
			document.all.OA1.DisablePrintHotKey(true);
			document.all.OA1.DisableCopyHotKey(true);
		}
}

function DisableDragDrop()
{
		if(document.all.OA1.IsOpened()){
			document.all.OA1.DisableDragAndDrop(true);
		}
}

function DisableRightClick()
{
		if(document.all.OA1.IsOpened()){
			document.all.OA1.DisableViewRightClickMenu(true);
		}
}

function SaveAs()
{
		if(document.all.OA1.IsOpened()){
			document.all.OA1.SaveFileDialog();
			//You can call the SaveAs method to save silently.
		}
}

function SavetoServer(sFileName)
{
	if(document.OA1.IsOpened)
	{
		document.OA1.HttpInit();
		
		//var sFileName = document.OA1.GetDocumentName();
		 
		document.OA1.HttpAddPostOpenedFile (sFileName); //save as the same file format with the sFileName then upload
		//document.OA1.HttpAddPostOpenedFile (sFileName, 12); //save as docx file then upload
		//document.OA1.HttpAddPostOpenedFile (sFileName, 0); //save as doc file then upload
		
		document.OA1.HttpPost("http://10.160.1.88/primotrple/uploadfiles/upload_weboffice.php");
		if(document.OA1.GetErrorCode() == 0 || document.OA1.GetErrorCode() == 200)
		{		
			var sPath = "File successfully saved!";
			window.alert(sPath);
		}
		else
		{
			window.alert("you need enable the IIS Windows Anonymous Authentication if you have not set the username and password in the HttpPost method. you need set the timeout and largefile size in the web.config file.");
		}	
	}
	else{
		window.alert("Please open a document first!");
	}
}

function CloseDoc()
{
		if(document.OA1.IsOpened)
		{
			document.all.OA1.CloseDoc();
		}
}

function VBAProgramming()
{
		if(document.OA1.IsOpened)
		{			
			var objWord = document.OA1.ActiveDocument;
			document.OA1.GotoItem(101, 0);//move to start.
			document.OA1.InsertBreak(6);//insert a line break
			var range = objWord.Range(0,0);
			var WTable = objWord.Tables.Add(range, 3,3);
			WTable.Cell(1,1).Range.Font.Name = "Times New Roman";		   
			WTable.Cell(1,1).Range.Text = "Automation 1";    
			WTable.Cell(1,2).Range.Font.Size = 18;    
			WTable.Cell(1,2).Range.Bold = true;   
			WTable.Cell(1,2).Range.Font.Italic = true;  
			WTable.Cell(1,2).Range.Text = "Automation 2";     
			WTable.Cell(2,1).Range.ParagraphFormat.Alignment = 1; // 0= Left, 1=Center, 2=Right   
			WTable.Cell(2,1).Range.Font.Name = "Arial";   
			WTable.Cell(2,1).Range.Font.Size = 12;   
			WTable.Cell(2,1).Range.Bold = false;   
			WTable.Cell(2,1).Range.ParagraphFormat.Alignment = 2;     
			WTable.Cell(3,3).Range.Font.Name = "Times New Roman";    
			WTable.Cell(3,3).Range.Font.Size = 14;    
			WTable.Cell(3,3).Range.Bold = true;    
			WTable.Cell(3,3).Range.Font.Underline = true;  
			WTable.Cell(3,3).Range.ParagraphFormat.Alignment = 0;  
			WTable.Cell(3,2).Range.Text = "Automation 3";
		}
}

function OA1_NotifyCtrlReady() 
{
		//disalbe the save button and save as button
		document.OA1.LicenseName = "Innod100407570";
		document.OA1.LicenseCode = "EDO8-5501-1246-ABEB";
		document.OA1.DisableFileCommand(1, true);//wdUIDisalbeOfficeButton
		document.OA1.DisableFileCommand(2, true);//wdUIDisalbeNew
		document.OA1.DisableFileCommand(4, true);//wdUIDisalbeOpen
		//If you want to open a document when the page loads, you should put the code here.
		//document.all.OA1.Open("http://www.ocxt.com/demo/samples/sample.doc");
		document.OA1.SetValue("ShowWindowInTaskbar", "TRUE");
	 
}

function OA1_BeforeDocumentOpened()
{
		document.OA1.DisableFileCommand(1, true);//wdUIDisalbeOfficeButton
		document.OA1.DisableFileCommand(2, true);//wdUIDisalbeNew
		document.OA1.DisableFileCommand(4, true);//wdUIDisalbeOpen		
		document.OA1.DisableFileCommand(16, true);//wdUIDisalbeSave
		document.OA1.DisableFileCommand(32, true);//wdUIDisalbeSaveAs
		document.OA1.DisableFileCommand (512,true); //wdUIDisalbePrint (Ctrl+P) PES,PCT,CON
 		document.OA1.DisableFileCommand (1024, true); //wdUIDisalbePrintQuick
		document.OA1.DisableFileCommand (2048, true); //wdUIDisalbePrintPreview	
}

function OA1_DocumentOpened()
{
		//You can do the office automation here
		//var objWord = document.OA1.ActiveDocument;
		//objWord.Content.Text = "You can do the office Automation with the Edraw Viewer Component.";
}

function OA_DocumentBeforePrint()
{
		//document.OA1.DisableStandardCommand(4, true);//cmdTypePrint = 0x00000004,		
    //window.alert("OA_DocumentBeforePrint");
}

function OA_WindowBeforeRightClick()
{
   //window.alert("OA_WindowBeforeRightClick");
   //document.OA1.DisableStandardCommand(8, true);//cmdTypeRightClick = 0x00000008, the line code will prevent the right click
}

function OA_BeforeDocumentSaved()
{
    //window.alert("OA_BeforeDocumentSaved");
    //document.OA1.DisableStandardCommand(1, true);//cmdTypeSave  = 0x00000001, the line code will prevent the save
}
//-->


</SCRIPT>

 

<SCRIPT LANGUAGE=javascript FOR=OA1 EVENT=NotifyCtrlReady>
<!--
 OA1_NotifyCtrlReady();
//-->
</SCRIPT>

<script language="javascript" for="OA1" event="DocumentOpened()"> 
  OA1_DocumentOpened();
</script>

<script language="javascript" for="OA1" event="BeforeDocumentOpened()"> 
  OA1_BeforeDocumentOpened();
</script>

<script language="javascript" for="OA1" event="DocumentBeforePrint()"> 
  OA_DocumentBeforePrint();
</script>

<script language="javascript" for="OA1" event="WindowBeforeRightClick()"> 
  OA_WindowBeforeRightClick();
</script>

<script language="javascript" for="OA1" event="DocumentBeforePrint()"> 
  OA_DocumentBeforePrint();
</script>
<script src="addons/addons.js"></script>

<link rel="stylesheet" href="plugins/link.css">
 <!-- onload="LoadAutomation('Styling');" -->
 <?php
	

if ($Task=='QC'){
	
	 
		echo "<body class='hold-transition fixed skin-blue sidebar-mini' onload='GetJobStatus()'>";
	 


	// echo "<body class='hold-transition fixed skin-blue sidebar-mini' onload='LoadDataEntryContent(\"".$Filename."\")'>";
	
}
elseif($Task=='STYLING'){
	 if ($FileStatus!='Done'&&$FileStatus!=''){

	 	if (file_exists($sXMLFile)){
	 		echo "<body class='hold-transition fixed skin-blue sidebar-mini'>";
	 	}
	 	else{
	 		echo "<body class='hold-transition fixed skin-blue sidebar-mini' onload='GetJobStatus()'>";
	 	}
	 	
	 }
	 else{
	 	echo "<body class='hold-transition fixed skin-blue sidebar-mini'>";
	 }
	 
}
else{

 	echo '<body class="hold-transition fixed skin-blue sidebar-mini" >';
}
?>
 <?php
 $sql="SELECT * FROM primo_view_Jobs Where ProcessCode='$Task' AND statusstring in('Allocated','Pending','Ongoing')  AND AssignedTo='$_SESSION[login_user]'";	
	$WorkFlowID=$_GET['WorkFlowID'];
	$Page=$_GET['page'];
	
		$rs=odbc_exec($conWMS,$sql);
		$ctr = odbc_num_rows($rs);
 ?>
	<div class="ui-layout-north" align="left" style="background-color:#21618C">
	 
		 
		<a  href = 'index.php?BatchID=<?php echo $BatchID;?>&Task=<?php echo $Task;?>&page=Enrich&file=<?php echo $_GET['file'];?>' class="btn btn-danger">Exit Splitview</a>  
	 
	 
		 <div class="pull-right">
		 	<img src="innodata.png"/>
		 </div>
	</div>
	<?php
	  if($Task=='QA'){
       $sql="SELECT * FROM primo_view_Jobs Where BatchID='$BatchID' AND  ProcessCode='$Task'";
     }
     else{
     	$sql="SELECT * FROM primo_view_Jobs Where  BatchID='$BatchID'";
     }
		

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

		}
	if ($Source==1){
			
	?>
	<div class="ui-layout-west"> 
		 <input type="hidden" id="ReferenceID" value="<?php echo $BookReferenceID;?>">
				  
		<?php
				$fileVal="uploadfiles/SourceFiles/".$Filename;
				$info = pathinfo( $fileVal);
				$snewile =str_replace("." . $info["extension"],".pdf",$fileVal);	
				$snewile =str_replace("." . $info["extension"],".PDF",$snewile);	
				 
				 

				if ($FileStatus!='Done'){
				 
				if ($info["extension"] == "pdf"||$info["extension"] == "PDF") {
				?>
			  
				 <embed src="<?php echo $fileVal;?>" style="width:100%; height:100%;" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">
				 <?php
					}
					else
					{
						 $nfilename="uploadfiles/SourceFiles/".pathinfo($fileVal, PATHINFO_FILENAME).".html";

						if ($Filename!=''){
						?>

				 	<iframe src="<?php echo $nfilename;?>" style="width:100%; height:100%;" frameborder="none" ></iframe>
						
					 
					 <?php
					 }
					}
				}
					?>
					 

		</div>

	</div>
	<?php
	}
	?>
	<div class="ui-layout-east" style="display: none;">
		<div class="ui-layout-content">
		<div id="accordion2" class="basic">
		

			<h3><a href="#">Suggested Index</a></h3>
 
			<div id="ValidationList" >
			</div>

			
			<h3><a href="#">Allocation Details</a></h3>
			<div>
			 
	 
	<?php
					
					
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
									window.location = "<?php echo $row[2];?>?FileURL=../uploadFiles/<?php echo $sFileVal[1];?>&FileName=<?php echo $sFileVal[1];?>&RedirectURL=http://10.160.1.88/primowkus/fullscr.php&ID=<?php echo $row[0];?>";
								</script>
								
								<?php
								$_SESSION[$row[1]]=1;
							}
						
						}
								 
						  
					}
				}
				 
			}
					
			?>
			 <ul class="nav nav-pills nav-stacked">
			 	<li><b>TASK: <span id="Task1"><?php echo $Task;?></span></b></li>
			 	<input type="hidden" value="<?php echo $BookReferenceID;?>" id="BookID">
			 	<li> File name: <u><span id='filename'><?php echo $sFileVal[1];?></span></u> </li>
			    <li> JobName: <u><?php echo $Jobname;?></u> </li>
				<li> Status: <u><span id="Status"><?php echo $StatusString;?></span></u> </li>
				 
				

                <li>Last Updated: <u><?php echo $LastUpdate;?></u></li>
                <?php
                if ($TreeView==1){

				?>
			 

				 <li>Link: <a href="https://wb.innodatalabs.com/zoning/#/job/<?php echo $GGJobID;?>?token=dXNlci1saXZlLTA3OTZjYmNlYWVkODZkOGE1ZDAzYTM0MjMwNjQwYzY0YTMwNzZiZWE6" target="blank" id='GoldenGateLink'><u>Full Screen (Golden Gate)</u></a></li>
				<li>GG Status: <a href="#" onClick="GetJobStatus()"><u><span id="GGStatus"><i>Click Here</i></span></u></a></li>
				  
				 <input type="hidden" value ="<?php echo $GGJobID;?>" id="GGJobID">
				 <input type="hidden" value ="<?php echo $Task;?>" id="Task">
				  <input type="hidden" value ="Not Yet Validated" id="ValidateTrigger">
				<?php

				}
				?>

                <?php
				if ($Task=='WRITING'){
				?>

				<li> Draft Type: <u><select id="DraftType">
					<option value="New">New</option>
					<option value="Ammendment">Ammendment</option>
				</select></u> </li>

				<li> Category: <u><select id="Category">
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
				</select></u> </li>


				<li><button onclick="SetInfo()">Set Info</button></li>
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
				<li style="display: block" id="JobRepost"><a><i class="fa fa-question-circle"></i><button onclick="JobRepost()">Repost</button><button onclick="JobRewind()">Rewind</button></li>
                <input type="hidden" value ="<?php echo $GGJobID;?>" id="GGJobID">
				 <input type="hidden" value ="<?php echo $Task;?>" id="Task">

                 <input type="hidden" id="nBatchID" value="<?php echo $BatchID;?>">
                  <input type="hidden" id="Jobname" value="<?php echo $Jobname;?>">
                  <input type="hidden" id="Proofing" value="<?php echo $Proofing;?>">
				</ul><br>
				<?php
				if ($Status=='' && $StatusString=='Allocated'){
					$Start="inline";
					$Resume ="none";
					$Completed="none";
					$Pending="none";
					$GetNextBatch="none"; 
					 $Hold="none";
				}
				elseif($StatusString=='Ongoing'){
					$Start="none";
					$Resume ="none";
					$Completed="inline";
					$Pending="inline";
					$GetNextBatch="none";  
				 	 $Hold="inline";
				}
				elseif($StatusString=='Pending'){
					$Start="none";
					$Resume ="inline";
					$Completed="none";
					$Pending="none";
				  	$GetNextBatch="none"; 
					 $Hold="none";
				}
				elseif($StatusString=='New'){
					$Start="inline";
					$Resume ="none";
					$Completed="none";
					$Pending="none";
					 $GetNextBatch="none"; 
					 $Hold="none";
				}
				else{
					$Start="none";
					$Resume ="none";
					$Completed="none";
					$Pending="none";
					$GetNextBatch="block";
					 $Hold="none"; 
				}

				?>
 
				  <div class="box-tools">
					 <li style='display: <?php echo $Start;?>' id="Start"><button type="button" class="btn btn-default  pull-right"  data-toggle="modal" data-target="#modal-Start"  onclick="Javascript:SetTextBoxValue1(<?php echo $BatchID;?>)" style='display: <?php echo $Start;?>'><i class="fa fa-hourglass-start" ></i> Start</button></li>
					 <li style='display:  <?php echo $Completed;?>'  id="Completed"> <button type="button" class="btn btn-default  pull-right"  data-toggle="modal" data-target="#modal-success"  onclick="Javascript:SetTextBoxValue(<?php echo $BatchID;?>)" style="width:150px"  ><i class="fa fa-check"></i> Set as completed</button>
					 </li>
					 <li style='display:  <?php echo $Hold;?>'  id="Hold"> 
					 <button type="button" class="btn btn-default  pull-right"  data-toggle="modal" data-target="#modal-Hold"  onclick="Javascript:SetTextBoxValue3(<?php echo $BatchID;?>)"  style="width:150px" ><i class="fa  fa-hand-stop-o"></i> Hold</button>
					  </li>
					 <li style='display:  <?php echo $Pending;?>'  id="Pending"><button type="button" class="btn btn-default pull-right"  data-toggle="modal" data-target="#modal-Pending"  onclick="Javascript:SetTextBoxValue2(<?php echo $BatchID;?>)"  style="width:150px"  ><i class="fa fa-hourglass-2" ></i> Pending</button></li>
					 <li style='display:  <?php echo $Resume;?>'  id="Resume"><button type="button" class="btn btn-default  pull-right"  data-toggle="modal" data-target="#modal-Start"   style="width:150px" onclick="Javascript:SetTextBoxValue1(<?php echo $BatchID;?>)"  ><i class="fa fa-hourglass-start"></i> Resume</button></li>


					 <li style='display:  <?php echo $GetNextBatch;?>'  id="GetNext"><a class="btn btn-default  pull-right"  href="GetNextBatch.php?page=Enrich&Task=<?php echo $Task;?>&fullscr=1"><i class="fa  fa-hand-grab-o"></i> Get Next Batch</a></li>

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
						 <br>
						 
						 <li><hr></li>

						<li > <button type="button" class="btn btn-default  pull-right" onclick="ValidateXML()"  id="Validate" style="width:150px"><i class="fa fa-search-plus"></i> Validate</button></li>
						<li ><button type="button" class="btn btn-default  pull-right"  onclick="saveXML()"   id="btnSave" style="width:150px"> <i class="fa fa-save"></i> Save</button></li>

						<li ><button type="button" class="btn btn-default  pull-right" onclick="SpellCheck()" id="SpellCheck" style="width:150px" value="SpellCheck"> <i class="fa fa-check-square"></i> Spell Check</button></li>
						

				</div>
				 
			  
				
			 <script src="WMSButton.js"></script>
			 

			 <script src="GoldenGate.js"></script>
			 <script type="text/javascript">

			 	function GenerateXML(){
			     editor_html.setValue("");
			    $("#modal-progress").modal();
			    var jTextArea = CKEDITOR.instances['editor1'].getData();
			    var data = 'data='+encodeURIComponent(jTextArea);
			         CKEDITOR.instances['editor1'].setData("");
			          var xmlhttp = new XMLHttpRequest();
			          xmlhttp.onreadystatechange=function(){
			            if (xmlhttp.readyState==4 && xmlhttp.status==200){
			              //response.innerHTML=xmlhttp.responseText;
			              
			              CKEDITOR.instances['editor1'].setData(xmlhttp.responseText);
			              // editor_html.setValue(xmlhttp.responseText);
			               $('#modal-progress').modal('hide');
			               // $('#tab_1-1').trigger('click');
			               $('[href="#tab_1-1"]').tab('show');
			               location.reload();
			                 CKEDITOR.instances['editor1'].setData(xmlhttp.responseText);
			            }
			          }
			          xmlhttp.open("POST","ExecuteMLAPI.php",true);
			                //Must add this request header to XMLHttpRequest request for POST
			          xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			          xmlhttp.send(data);
			  }
			 </script>


			</div>

			 
				<!-- <h3 onclick="LoadJobonQueue();"><a href="#" onclick="LoadJobonQueue();">Job Queue</a></h3> -->
			
		
				<div class="box-body no-padding" id="Joblist">

				</div>
			 
			<!-- <h3 onclick="LoadFileonQueue()"><a href="#">File List</a> <span id="ListCaption"></span></h3> -->

			<ul>
			<?php
			if ($Task=='COMPOSITION'){
				echo "<button type='button'  class='btn btn-default' onclick='DownloadWordFile();' style='width:120px'>Download File</button><br>";
				echo "<button type='button'  class='btn btn-default'  data-toggle='modal' data-target='#modal-access' onclick='Javascript:DisplayAttachment()' style='width:120px'>Upload File</button>";
				  
			}
			

			echo "<br><button class='btn btn-default'  id='saveHTMLFile' onClick='saveHTMLFile()' style='display:  none'><i class='fa fa-save'></i> Save</button><br><br>";
			?>
			<input type="hidden" id="HTMLFilename">
			<div class="box-body no-padding" id="Filelist">

				</div></ul>

			<?php
				
			if ($Task=='COPY EDITING'){

			?>
			<h3 ><a href="#">SMART CE</a></h3>
				<div>
					<!-- <button class='btn btn-default'  onclick="Autofix();" style="width:120px">Run Autofix</button> <br><br>
					<button class='btn btn-default'  onclick="ValidateGrammar();"  style="width:120px">Run SMART CE</button> -->
					<div class="btn-group">
	                  <button type="button" class="btn btn-default">Smart CE</button>
	                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
	                    <span class="caret"></span>
	                    <span class="sr-only">Toggle Dropdown</span>
	                  </button>
	                  <ul class="dropdown-menu" role="menu">
	                    <li><a href="#"  onclick="Autofix();">Auto-correction</a></li>
	                    
	                    <li><a href="#" onclick="LaunchCopyEdit();" >House Style</a></li>
	                    <li class="divider"></li>
	                    <li><a href="#" onclick="ValidateGrammar();" >Sense check</a></li>
	                  </ul>
	                </div>
					<hr>
				<div class="box-body no-padding" id="Errorlist">

				</div>
				</div>
				
			<?php

			}
			if ($TextCategorization==1){
				
			?>
			 
			<h3><a href="#">Text Categorization</a></h3>
			<div>
				<form id="frmHeadings">
				   
				   <?php
				   $Casefile = fopen("Category.tbl","r");

					while(! feof($Casefile))
					  {
					  	$keyword=fgets($Casefile);
					  	if(trim($keyword)!=""){
				   ?>
					  <input type="checkbox" name="chk[]" value="<?php echo $keyword;?>">  <?php echo $keyword;?><br/>
					  <?php
					  	}
				  	  }
					  ?>
				 
				</form>
			</div>

			 <?php
			}
			?>



			<?php
			if ($Task=='COMPOSITION'){
				
			?>	
				<h3 onclick="LoadStyles();"><a href="#" >Styles</a></h3>
			<div>
				 <ul>
				<div id="Styleslist" >
                </div>
				</ul>
				 
			</div>

			<h3><a href="" onclick="LoadAutomation('Styling');">Automation Panel</a></h3>

		<div class="box box-solid">
            <div class="box-header with-border">
              <ul  class="nav nav-pills nav-stacked" id="AutomationList">
              </ul>

               
            </div>
        </div>
        <?php
    	}

    	if ($SequenceLabeling==1){
    		?>
		<h3><a href="#">Sequence Labelling</a></h3>
	  
		<div>			
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Confidence Level Filter </h3>

               
            </div>
			<?php
			$file= explode('.',$sFileVal[1]);
			 
			$above95=GetWMSValue("Select * from tblConfidenceLevel WHERE Filename='$nTitle' AND Type='95% and up'","Count",$conWMS);
			$above80=GetWMSValue("Select * from tblConfidenceLevel WHERE Filename='$nTitle' AND Type='80 to 94%'","Count",$conWMS);
			$above70=GetWMSValue("Select * from tblConfidenceLevel WHERE Filename='$nTitle' AND Type='79% and below'","Count",$conWMS);
			if ($FileStatus!='Done'){
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
				<li><a onclick="myFunction95()"><i class="fa fa-circle text-green"></i> 95% and up <small>(Total Refs.<?php echo $above95;?>)</small></a></li>
			<?php
			  }
			  if ($above80==0){
			  ?>
                <li> <a onclick="return false;" ><i class="fa fa-circle text-red"></i> 80-94% <small>(Total Refs.<?php echo $above80;?></small>) </a></li>
			  <?php
			  }
			  else{
				?>
			  <li><a   onclick="myFunction80()"><i class="fa fa-circle text-red"></i> 80-94% <small>(Total Refs.<?php echo $above80;?></small>)</a></li>
			<?php
			  }
			   if ($above70==0){
			  ?>
			  
                <li><a onclick="return false;" ><i class="fa fa-circle text-yellow"></i> 79% and below <small>(Total Refs.<?php echo $above70;?>)</small></a></li>
				<?php
			   }
			   else{
				   
				?>
				<li><a   onclick="myFunction79()"><i class="fa fa-circle text-yellow"></i> 79% and below <small>(Total Refs.<?php echo $above70;?>)</small></a></li>
				<?php
			   }
				?>
               <!--  <li><a   onclick="myFunctionEdited()"><i class="fa fa-circle text-light-blue"></i> edited</a></li> -->
              </ul>
            </div>

            <?php
        }
        ?>
            <!-- /.box-body -->
          </div>

		<div class="box box-solid" style="display: none" id="myDIV95">
            <div class="box-header with-border">
              <h3 class="box-title">95% and up</h3>

               
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
			  <?php
			  
							 
				if (file_exists("uploadfiles/$nTitle.htm")) {   
				 
					$sTxt =  file_get_contents("uploadfiles/$nTitle.htm"); 
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
								 
								
								 echo "<li><a class='TermVal' data-id='".$lVal[0]."' href='#tab_2-2'><i class='fa fa-circle text-green'></i>" .$lVal[0] ."</a></li>";
								
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
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
			    <?php
			  $file= explode('.',$sFileVal[1]);
							 
				if (file_exists("uploadfiles/$nTitle.htm")) {   
				 
					$sTxt =  file_get_contents("uploadfiles/$nTitle.htm"); 
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
								 echo "<li><a class='TermVal' data-id='".$lVal[0]."' href='#tab_2-2'><i class='fa fa-circle text-red'></i>" .$lVal[0] ."</a></li>";
								// echo "<li><a onclick='FindTerm(\"". $lVal[0] . "\")' href='#tab_2-2'><i class='fa fa-circle text-red'></i>" .$lVal[0] ."</a></li>";
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
		  <divc style="display: none"  id="myDIV79">
            <div class="box-header with-border">
              <h3 class="box-title">79% and below</h3>               
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
			  <?php
			  $file= explode('.',$sFileVal[1]);
							 
				if (file_exists("uploadfiles/$nTitle.htm")) {   
				 
					$sTxt =  file_get_contents("uploadfiles/$nTitle.htm"); 
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
								 echo "<li><a class='TermVal' data-id='".$lVal[0]."' href='#tab_2-2'><i class='fa fa-circle text-orange'></i>" .$lVal[0] ."</a></li>";
								// echo "<li><a onclick='FindTerm(\"". $lVal[0] . "\")' href='#tab_2-2'><i class='fa fa-circle text-yellow'></i>" .$lVal[0] ."</a></li>";
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
		  
		    <div class="box box-solid" style="display: none"  id="myDIVEdited">
            <div class="box-header with-border">
              <h3 class="box-title">Edited</h3>

               
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
			</div>
		</div>
		 <?php
      }
      ?>

		</div>

            <!-- /.box-body -->
          </div>
	
	</div>
	
	<!-- <div class="ui-layout-south">  
	
	</div> -->

	<div class="ui-layout-center">
		<UL  class="nav-tabs-custom">
		<?php
			if ($Styling==1){
			?>
			<LI><a href="#tab_1" onclick="LoadAutomation('Styling');"><SPAN>Styling</SPAN></a></LI>

			<?php
 
			}
			 
			if ($Task=='WRITINGQC'||$Task=='FINALREVIEW'){
					echo "<LI><a href='#tab_4_2'  onClick='LoadFeedbackList()'><SPAN>Feedback Form</SPAN></a></LI>";
				}
			if ($WordViewer==1){
			?>
			<LI><a href="#tab_6-2"><SPAN>Word Viewer</SPAN></a></LI>
			<?php
			}
			?>
			<?php
			if ($XMLEditor==1){
			  
			 	echo "<LI><a href='#tab_2' class='test1' data-id='".$nFile[0].".html' workflowid='".$nWorkFlowID."'><SPAN>XML Editor</SPAN></a></LI>";
			  
				 
			}
			?>

			<?php
			if ($DataEntry==1){
				
			?>
			<LI><a href="#tab_3"><SPAN>Metadata Info.</SPAN></a></LI>
			<?php
			}
			?>
			<?php
			if ($nWorkFlowID==1){

				if ($Task=='COMPOSITION'){
					echo "<LI><a href='#tab_4'  onClick='LoadPDF(\"".$nFile[0]."\")'><SPAN>Generated PDF</SPAN></a></LI>";
				}
				elseif($Task=='QA'){
					// echo "<LI><a href='#tab_4'  onClick='LoadPDF(\"".$nFile[0]."\")'><SPAN>Generated PDF</SPAN></a></LI>";
					echo "<LI><a href='#tab_4_1'  onClick='LoadErrorList()'><SPAN>Audit Form</SPAN></a></LI>";
					echo "<LI><a href='#tab_4_2'><SPAN>Check List</SPAN></a></LI>";
				}

			}
			else{
				if ($TreeView==1){
				
				?>
				<LI><a href="#tab_4"><SPAN>Golden Gate</SPAN></a></LI>
				 <?php
				}


				?>
				<?php
			}
			
			if ($TextCategorization==1){
				
			?>
			<LI><a href="#tab_5"  onclick="DisplayHeadnotes();"><SPAN>Headnotes</SPAN></a></LI>
			 <?php
			}
			?>
		</UL>
		<script>
			 function DownloadWordFile(){
                    var RefID = document.getElementById("ReferenceID").value;
                      var win = window.open("DownloadWordFile.php?ReferenceID=" + RefID, '_blank');
                      win.focus();
                }
			function LoadPDF(strSRC){
				 // alert("https://10.160.1.88/primoTRPLE/HTMLToPDF/" + strSRC + ".pdf");
				 document.getElementById('PDFViewer').src="https://10.160.1.88/primoTRPLE/HTMLToPDF/" + strSRC + ".pdf";

			}
			function DisplayHeadnotes(){
						 
				var HeadnoteViewer=document.getElementById("HeadnoteViewer");
          			HeadnoteViewer.innerHTML="";
          		 
            	  var data = 'data='+encodeURIComponent(document.getElementById("Jobname").value);
                  var xmlhttp = new XMLHttpRequest();
                  
                  xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
                        // alert(xmlhttp.responseText);
                       // alert("File");
                       HeadnoteViewer.innerHTML=xmlhttp.responseText;
                    }
                  }
                  xmlhttp.open("POST","GenerateHeadnotes.php",true);
                        //Must add this request header to XMLHttpRequest request for POST
                  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                  
                  xmlhttp.send(data);
                     
            }
		</script>
		<div class="ui-layout-content"><!--  ui-widget-content -->
		<?php
			if ($Styling==1){
			?>
			<div id="tab_1">
				  <form method ="post" action="API/saveFile.php">
                <div class="box-body pad">
						<input type="hidden" name="fullscr" value="1">

						<div id="editor1" name="editor1">
							<?php
						$info = pathinfo($Filename);
						 $out="";
						 
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
							echo $out;?>
								

							</div>
				 
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

					CKEDITOR.on('instanceReady', function (ev) {

				        // Create a new command with the desired exec function
				        var overridecmd = new CKEDITOR.command(editor1, {
				            exec: function(editor1){
				                // Replace this with your desired save button code
				                alert("test");
				            }
				        });

				        // Replace the old save's exec function with the new one
				        // ev.editor1.commands.save.exec = overridecmd.exec;
				    });
						// CKEDITOR.replace( 'editor1', {
						// 	extraPlugins: 'stylesheetparser',
						// 	height: 540,

						// 	// Custom stylesheet for editor content.
						// 	contentsCss: [ 'bower_components/ckeditor/stylesheetparser.css' ],

						// 	// Do not load the default Styles configuration.
						// 	stylesSet: [],
						// 	on: {
						// 	key: function( event ) {
						// 		// Gather all styles
						// 		var styles = [];
						// 		this.getStylesSet( function( defs ) { styles = defs } );
								
						// 		// CTRL+SHIFT+1
						// 		<?php
						// 		 echo $key;
						// 		?>
						// 	}
						// }
							
						// } );
						 



				</script>
			 	  
						<div class="pull-right">
						<input type="hidden" name="fileVal" value="<?php echo "$file[0].cxml";?>">
					<!-- 	<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-shortcut" ><i class="fa fa-keyboard-o"></i> Shortcut key</button>
						<button type="button" class="btn btn-success" onclick="save()"><i class="fa fa-save"></i> Save</button>
						<button type="submit" class="btn btn-primary"><i class="fa fa-gear"></i> Transform</button> -->
					<script>

						 function save(){
         
		                  
		                  var data = 'data='+encodeURIComponent(CKEDITOR.instances['editor1'].getData());
		                  var xmlhttp = new XMLHttpRequest();
		                  xmlhttp.onreadystatechange=function(){
		                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
		                      //response.innerHTML=xmlhttp.responseText;
		                      // alert("File successfully save!");
		                    }
		                  }
		                  xmlhttp.open("POST","saveStylingFile.php",true);
		                        //Must add this request header to XMLHttpRequest request for POST
		                  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		                  xmlhttp.send(data);

		                }

						 </script>
					</form>
					 </div>
					 
				
			</div>
			<?php
		}
			if ($Task=='WRITINGQC'||$Task=='FINALREVIEW'){

				?>
			 <div id="tab_4_2">
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

			 <?php
			}
			?>
			<?php
			if ($XMLEditor==1){
				


 $sXML = file_get_contents($sXMLFile );
// $sXML =formatXmlString($sXML);


?>
			<div id="tab_2">
				 <div id="divStatus"></div>
 
			<?php
			if ($FileStatus!='Done'){
				?>
					<textarea id="code" style="height:100%; width: 100%;" name="test_1"><?php echo $sXML;?></textarea>
			<?php
			}
			else
			{
				if ($Task=='QA'){
				?>
					<textarea id="code" style="height:100%; width: 100%;" name="test_1"><?php echo $sXML;?></textarea>
				<?php
				}
				else{
					echo '<textarea id="code" style="height:37vw; width: 100%;" name="test_1"></textarea>';
				}
			
			}

			?>
				<textarea id="spellcheckText" rows="100" spellcheck="true" style="width:100%; height:65vh;display:none"  ></textarea>

					<script id="script">
					/*
					 * Demonstration of code folding
					 */
					// window.onload = function() {
					 
					  var te_html = document.getElementById("code");
					 
					 
					 //  window.editor_html = CodeMirror.fromTextArea(te_html, {
						// mode: "text/xml",
						// lineNumbers: true,
						// matchTags: {bothTags: true},
						// lineWrapping: true,
						// extraKeys: {"Ctrl-Q": function(cm){ cm.foldCode(cm.getCursor()); }},
						// foldGutter: true,
						// styleActiveLine: true,
						// styleActiveSelected: true,
						// styleSelectedText: true,

						// gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"]
					 //  });
					  
					 //   editor_html.refresh();

	 
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
					   	DisableTag();
					   	 
					   });

					editor_html.refresh();					     


					    editor_html.setSize("100%","75vh");
					
					// };
					  </script>
					  
					   <br/>
					   
					   <script type="text/javascript">
					   	$(function(){
				 		$(document).on("click", ".testx", function(e){
				 			 e.preventDefault();
				 			 var data=$(this).attr("data-id");
				 			 var WorkFlowID=$(this).attr("workflowid");
				 			
				 			 // SaveandConvert(data,WorkFlowID);
							LoadAutomation('XML');
				 			  editor_html.setValue("");
						 	$("#modal-progress1").modal();
							var jTextArea = CKEDITOR.instances['editor1'].getData();
							var data = 'data='+encodeURIComponent(jTextArea);
					                 
					          var xmlhttp = new XMLHttpRequest();
					          xmlhttp.onreadystatechange=function(){
					            if (xmlhttp.readyState==4 && xmlhttp.status==200){
					              //response.innerHTML=xmlhttp.responseText;
					               
					              editor_html.setValue(xmlhttp.responseText);
					               $('#modal-progress1').modal('hide');
					            }
					          }
					          xmlhttp.open("POST","TransformXML.php",true);
					                //Must add this request header to XMLHttpRequest request for POST
					          xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					          xmlhttp.send(data);


				 			 
				 		})
				 	})



					   	// function test(){
				 		
				 	// }
				 	function SaveandConvert(sFileName,WorkFlowID)
					{

					// ExecuteConversion(sFileName);
						if(document.OA1.IsOpened)
						{
							document.OA1.HttpInit();
							
							//var sFileName = document.OA1.GetDocumentName();
							//alert (sFileName);
							document.OA1.HttpAddPostOpenedFile (sFileName); //save as the same file format with the sFileName then upload
							//document.OA1.HttpAddPostOpenedFile (sFileName, 12); //save as docx file then upload
							//document.OA1.HttpAddPostOpenedFile (sFileName, 0); //save as doc file then upload
							
							document.OA1.HttpPost("http://10.160.1.88/primowkus/uploadfiles/upload_weboffice.php");
							if(document.OA1.GetErrorCode() == 0 || document.OA1.GetErrorCode() == 200)
							{		
								//var sPath = "File successfully save! ";
								 
								ExecuteConversion(sFileName,WorkFlowID);
							}
							else
							{
								window.alert("you need enable the IIS Windows Anonymous Authentication if you have not set the username and password in the HttpPost method. you need set the timeout and largefile size in the web.config file.");
							}	
						}
						else{
							//window.alert("Please open a document firstly!");
						}

						ExecuteConversion(sFileName,WorkFlowID);
					}


					function ExecuteConversion(prFilename,WorkFlowID){
						 editor_html.setValue("");
					      document.getElementById('divStatus').innerHTML = "generating XML please wait...";

					      if (WorkFlowID==3){
					      	var data = 'data='+encodeURIComponent(prFilename +"@@@"+WorkFlowID+ "@@@"+document.getElementById("Issue_Number").value+ "@@@"+document.getElementById("Editor").value+ "@@@"+document.getElementById("Date").value+ "@@@"+document.getElementById("copyrightref").value+ "@@@"+document.getElementById("disclaimerref").value);
					      }
					      else if (WorkFlowID==2){
					      	// var addlog = document.getElementById("Attorneys").value ;
					      	var data = 'data='+encodeURIComponent(prFilename +"@@@"+WorkFlowID+ "@@@"+document.getElementById("Citation").value+ "@@@"+document.getElementById("CaseName").value+ "@@@"+document.getElementById("Court").value + "@@@" + document.getElementById("HistoryLine").value + "@@@"+document.getElementById("LawReference").value + "@@@"+document.getElementById("DocketNo").value + "@@@"+document.getElementById("DocketCitation").value + "@@@"+document.getElementById("DocketDate").value + "@@@"+document.getElementById("Attorneys").value);
// + "@@@"+document.getElementById("CaseName").value+ "@@@"+document.getElementById("Court").value+ "@@@"+document.getElementById("HistoryLine").value+ "@@@"+document.getElementById("LawReference").value + "@@@"+document.getElementById("DocketNo").value+ "@@@"+document.getElementById("DocketCitation").value+ "@@@"+document.getElementById("DocketDate").value+ "@@@"+document.getElementById("KeyPhrase").value+ "@@@"+document.getElementById("Headnote").value+ "@@@"+document.getElementById("Attorneys").value
								// alert(addlog);
							 	// alert(data);
					      }
					      else{
					      	var data = 'data='+encodeURIComponent(prFilename +"@@@"+WorkFlowID );
					      }
					      
					      var xmlhttp = new XMLHttpRequest();

					      xmlhttp.onreadystatechange=function(){
					        if (xmlhttp.readyState==4 && xmlhttp.status==200){
					           
					           editor_html.setValue(xmlhttp.responseText);
					           document.getElementById('divStatus').innerHTML = "";
					        }
					      }
					      xmlhttp.open("POST","ConvertCommXML.php",true);
					            //Must add this request header to XMLHttpRequest request for POST
					      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					      
					      xmlhttp.send(data);
					      
					  }
					   </script>

					  <div class="pull-left">
					  	<?php
						//echo "<LI><a href='#tab_2' class='testx' data-id='". $nFile[0].".rtf'><SPAN>XML Editor</SPAN></a></LI>";
						// echo "<button type='button' id='uploadBTN' data-id='". $nFile[0]."' class='btn btn-primary .btn-sm'>Generate PDF </button>";
						if ($Task!='QA'){

					 
					  	?>
					  		<!--  <button type="button" class="btn btn-info .btn-sm" onclick="PrintPDF();" id="btnPreview">Generate PDF</button> -->
					  		<!-- <a href="PDFGeneration.php" target="_blank"><button type="button" class="btn btn-info .btn-sm" id="btnPreview">Generate PDF</button></a> -->
					  		<div id="response"></div>
					  		<?php
					  	}
					  	?>
					  </div>
					 

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
					  function PrintPDF(){
                    	$("#modal-progress2").modal();
							 
                      //var jTextArea=document.getElementById("jTextArea").value;
                      var jTextArea = CKEDITOR.instances['editor1'].getData();
                      
                      var data = 'data='+encodeURIComponent(jTextArea);
                      var xmlhttp = new XMLHttpRequest();
                      xmlhttp.onreadystatechange=function(){
                        if (xmlhttp.readyState==4 && xmlhttp.status==200){
                          //response.innerHTML=xmlhttp.responseText;
                          // alert(xmlhttp.responseText);
                           // LoadPDF(xmlhttp.responseText);
                           alert("PDF Generated successfully!");
                           $('#modal-progress2').modal('hide');
                        }
                      }
                      xmlhttp.open("POST","PrintPDF.php",true);
                            //Must add this request header to XMLHttpRequest request for POST
                      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                      
                      xmlhttp.send(data);
                       
                  }

					  </script>
					  
				 
						<script type="text/javascript">
							$(function(){
								 $('#uploadBTN').on('click', function(){ 
								// 	if($("#file").prop('files').length > 0)
						  //       	{
						  				var data=$(this).attr("data-id");
						   
						  				saveXML(data);
						 				// window.location.href="PDFGeneration.php?filename=" + data;	
						 				window.open('http://10.160.1.88/primoips/PDFGeneration.php?filename=' + data,'_blank');
									 
									// }     
							     });
								 

							    function saveXML(prFilename){
				 
								var response=document.getElementById("response");
								var data = 'data='+encodeURIComponent(editor_html.getValue() + "||" + prFilename +".cxml");
								var xmlhttp = new XMLHttpRequest();
								xmlhttp.onreadystatechange=function(){
								  if (xmlhttp.readyState==4 && xmlhttp.status==200){
								 		alert("File successfully saved!");     
								  }
								}
								xmlhttp.open("POST","saveXMLForComposition.php",true);
							        //Must add this request header to XMLHttpRequest request for POST
							        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
								xmlhttp.send(data);

								}

							    function step2(token, fd){
							    	document.getElementById('response').innerHTML = "";
						 			document.getElementById('response').innerHTML = "Authentication...";
							    console.log("STEP 2");
							    	$.ajax({	
										//method: 'POST',		    		
									   	url: 'http://virndatyp01.noida.innodata.net:7000/icp2-worflow-server/api/jobRegistation',  
									   	type: "POST",
						                data: fd,
						                processData: false,
						                contentType: false,
						                dataType: 'json',
									        beforeSend: function (xhr) {
											    xhr.setRequestHeader('Authorization', 'Bearer '+token);
											},
									        success:function(result){
									        	console.log(result)
									        	var JobID = result.JobID;
									        	var BatchId = result.BatchId
									        	// console.log(JobID)
									        	// console.log(BatchId)
									        	step3(token, JobID, BatchId);
									        },
									        failure: function(errMsg) {
											    console.log(errMsg);
											}
									});
							    }

							    function step3(token, JobID, BatchId){
							    	console.log("STEP 3");
							    	document.getElementById('response').innerHTML = "";
						 			document.getElementById('response').innerHTML = "Uploading XML File...";
							    	$.ajax({	
										//method: 'POST',		    		
									   	url: 'http://virndatyp01.noida.innodata.net:7000/icp2-worflow-server/api/generateXmlPdf/'+JobID+'/'+BatchId,
									   	type: "POST",
						                processData: false,
						                contentType: false,
						                // dataType: 'text',
										beforeSend: function (xhr) {
										    xhr.setRequestHeader('Authorization', 'Bearer '+token);
										},
										success:function(result){
											console.log(result);
											document.getElementById('response').innerHTML = "";
						 					document.getElementById('response').innerHTML = "Queueing...";
											step4(token, JobID, BatchId);
										},
										failure: function(errMsg) {
										    console.log(errMsg);
										}
									});
							    }

							    function step4(token, JobID, BatchId){
							    	console.log("STEP 4");
							    	document.getElementById('response').innerHTML = "";
						 			document.getElementById('response').innerHTML = "Generating Pdf...";
							    	$.ajax({	
										//method: 'GET',		    		
									   	url: 'http://virndatyp01.noida.innodata.net:7000/icp2-worflow-server/api/getPdfGenerationStatus/'+JobID+'/'+BatchId,
									   	type: "GET",
						                processData: false,
						                contentType: false,
										beforeSend: function (xhr) {
											xhr.setRequestHeader('Authorization', 'Bearer '+token);
										},
									    success:function(result){
											console.log(result);
											if(result=="Queued"){
												setTimeout(function(){ 
													step4(token, JobID, BatchId); 
												}, 20000);
											}else if(result=="Completed"){
												step5(token, JobID, BatchId);
											}
										},
										failure: function(errMsg) {
										    console.log(errMsg);
										}
									});
							    }

							   function step5(token, JobID, BatchId){
						    		console.log("STEP 5");
							    	$.ajax({	
										//method: 'GET',		    		
									   	url: 'http://virndatyp01.noida.innodata.net:7000/icp2-worflow-server/api/getGeneratedPdf/'+JobID+'/'+BatchId,
									   	type: "GET",
						                processData: false,
						                contentType: false,
										xhrFields: {
										    responseType: 'blob'
										},
						                beforeSend: function (xhr) {
										    xhr.setRequestHeader('Authorization', 'Bearer '+token);
										},
										success:function(result){
											// console.log (result);
											// var blob = new Blob([result]);
						    				// var blob = new Blob([result], {type: 'application/pdf'});
						       				var blobData = new FormData();
						            		blobData.append('pdf', result);
						            		blobData.append('filename', BatchId);
				
											
						    				$.ajax({	
												//method: 'POST',		    		
											   	url: 'saveblob.php',
											   	type: "POST",
											   	data: blobData,
								                processData: false,
								                contentType: false,
												success:function(x){

													console.log(x);

													// var file = window.navigator.msSaveOrOpenBlob(result, BatchId+".pdf");
													// var file = window.URL.createObjectURL(result);
						        					// document.querySelector("iframe").src = file;
												},
												failure: function(errMsg) {
												    console.log(errMsg);
												}
											});		
						    				
										},
										failure: function(errMsg) {
										    console.log(errMsg);
										}
									});
						    }
							})

					function GetPDFFile(){

					          var data = 'data='+encodeURIComponent(jTextArea);
					          var xmlhttp = new XMLHttpRequest();

					          xmlhttp.onreadystatechange=function(){
					            if (xmlhttp.readyState==4 && xmlhttp.status==200){
					               
					               document.getElementById("Start").style.display = "none";
					               document.getElementById("Completed").style.display = "block";
					               document.getElementById("Pending").style.display = "block";
					                document.getElementById("Resume").style.display = "none";
					              
					               chkStatus.innerHTML="Ongoing";
					              // if (prTask!='CONVERSION'){
					                
					               	OpenFromServer(prFilename);
					              // }
					               

					            }
					          }
					          xmlhttp.open("POST","StartJob.php",true);
					                //Must add this request header to XMLHttpRequest request for POST
					          xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					          
					          xmlhttp.send(data);
					}

					
						</script>


					  <br>
						
			</div>
			 <?php
			}
			?>
			<?php
			if ($DataEntry==1){
				
			?>
			<div id="tab_3">
				 

				 
					
					<fieldset>
				<?php
				//<button type="button"  onclick="TableView()">Table View</button>
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
							<select class="form-control" name="<?php echo $FieldName;?>" id="<?php echo $FieldName;?>">
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
							<textarea class="form-control" id="<?php echo $FieldName;?>" name="<?php echo $FieldName;?>" row=5></textarea>
						</div>

				   <?php
				    }
				    elseif($FieldType=='hidden'){
				    	?>
					<input type="<?php echo $FieldType;?>" class="form-control" placeholder="<?php echo $FieldCaption;?>" name="<?php echo $FieldName;?>" id="<?php echo $FieldName;?>" >
				    	<?php
				    }
				    else{
				    	?>
				    	 <div class="form-group">
							<label><?php echo $FieldCaption;?></label><br>
							 <input type="<?php echo $FieldType;?>" class="form-control" placeholder="<?php echo $FieldCaption;?>" name="<?php echo $FieldName;?>" id="<?php echo $FieldName;?>" >
						  </div>
				    <?php
				    }
				 
				}
			}
			?>
					<div class="box-footer">
		             <input type="hidden" class="form-control" placeholder="" name="UID" value="<?php echo $UID;?>">
		           
		            <!-- <button type="submit" class="btn btn-primary">Save</button>
		           	<button type="reset" class="btn btn-danger">Cancel</button> -->
		          </div>
				</fieldset>
			 
			 
					 
			</div>
			 <?php
			}
		 
			if ($nWorkFlowID==1){

				if ($Task=='COMPOSITION'){
					?>
				<div id="tab_4">

					 <iframe id="PDFViewer" src="<?php echo "HTMLToPDF/".$BookSource.".pdf";?>"  style="width:100%; height:37vw;"  frameBorder="0" scrolling="no"></iframe>
				</div>
				 <?php
				}

				if ($Task=='QA'){
				?>
				<div id="tab_4_1">

					<div class="col-lg-6">
                      <div class="form-group">
                        <label>Error Value</label><br>
                        <textarea  class="form-control" id="ErrorValue"></textarea>  
                      </div>
                      <div class="form-group">
                        <label>Expected Value</label>
                        <textarea  class="form-control" id="ExpectedValue"></textarea>  
                      </div>
                      
                      <div class="form-group">
                        <label>Count</label>
                        <input type="number" class="form-control"   id="ErrorCount" value="" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                       <div class="form-group">
                        <label>PageNo</label>
                        <input type="number" class="form-control"   id="PageNo" value="" required>
                      </div>
                      
                      <div class="form-group">
                        <label>Error Type</label>
                        <Select class="form-control" id="ErrorType">
                          <option value="Wrong Amendment">Wrong Amendment</option>
                          <option value="Excess Text">Excess Text</option>
                        </Select>
                      </div>
                      <div class="form-group">
                        <button class="btn-success" type="button" onclick="SaveError()">Save</button>
                        <button class="btn-danger" type="button" onclick="ClearForm()">Cancel</button>
                      </div>

                  </div>
                  <span id ="ErrorList">

                  </span>



				</div>

					<div id="tab_4_2">
						<iframe id="QAChecklist" src="QAChecklist.html"  style="width:100%; height:37vw;"  frameBorder="0" scrolling="no"></iframe>
					</div>
				<?php
				}




			}
			else{
			if ($TreeView==1){
			?>
				<div id="tab_4">
					 <iframe src="https://wb.innodatalabs.com/mapping/#/job/<?php echo $GGJobID;?>?token=dXNlci10ZXN0LWZiYWQ5OThmMmYxNzNiNDM3NDE0YjQxOWZkNjhkMzAwMDVkN2QzMDc6" id="GoldenGateFrame" style="width:100%; height:80vh;"   frameBorder="0" scrolling="no"></iframe>
				</div>
				 <?php
				}
			}
			?>
			<?php
			if ($WordViewer==1){
				
			?>

			<div id="tab_6-2">
				<table border="0"   style="width:100%; height:40vw;" id="table1" bordercolorlight="#008080" bordercolordark="#008080" cellspacing="1">
					<tr>
						<td bordercolorlight="#FFFFFF" bordercolordark="#FFFFFF" rowspan="18" width="81%">
						<!-- <object  id="OA1"  classid="clsid:7677E74E-5831-4C9E-A2DD-9B1EF9DF2DB4" width="100%" height="100%" codebase="https://10.160.0.88/primowktaa/download/officeviewer.cab#version=8,0,0,863"> -->
							<object  id="OA1"  classid="clsid:7677E74E-5831-4C9E-A2DD-9B1EF9DF2DB4" width="100%" height="100%" codebase="http://www.edrawsoft.com/download/edword.cab#version#version=8,0,0,863"> 
							<param name="Toolbars" value="-1">
							<param name="LicenseName" value="Innod100407570">
							<param name="LicenseCode" value="EDO8-5501-1246-ABEB">
							<param name="BorderColor" value="15647136">
							<param name="BorderStyle" value="2">
						</object>
						<script language="JavaScript" type="text/javascript" src="NoIEActivate.js"></script>
						</td>
					</tr>
					 
				</table>

			</div>

			<?php
			}
			if ($TextCategorization==1){
				
			?>
			<div id="tab_5">
				<div class="box box-solid">
            
            	<div class="box-body no-padding">
				<div id="HeadnoteViewer"></div>
				 
				
			<!-- 	 
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
				  
				   
              </ul> -->
<!-- 			  <div class="box-footer with-border">
				   
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
				</div></form> -->
				  
            </div>
			</div>
			 <?php
			}
			?>
		</div>
	</div>
 	 


<!-- 

DIALOG BOXES

 -->



 		<form method="post" action="SetAsCompleted.php">
			<div class="modal modal-primary fade" id="modal-success">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span></button>
					<!-- <h4 class="modal-title">Set As Completed</h4> -->
				  </div>
				  <div class="modal-body">
				   <input type="hidden" name="BatchID" id="BatchID" value="<?php echo "$BatchID";?>">
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
					<!-- <h4 class="modal-title">Job Started</h4> -->
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
					<!-- <h4 class="modal-title">Job Pending</h4> -->
				  </div>
				  <div class="modal-body">
				   <input type="hidden" name="BatchID2" id="BatchID2" value="<?php echo "$BatchID";?>">
					<p>Are you sure you want to set this batch as Pending?</p>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>

					<?php
					if ($Task=='WRITING'||$Task=='WRITINGQC'){
						echo '<button type="button" class="btn btn-outline" data-dismiss="modal" onclick="PendingJobAndSave()">Pending</button>';
					}
					else{
						echo '<button type="button" class="btn btn-outline" data-dismiss="modal" onclick="PendingJob()">Pending</button>';
					}
					?>

					
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

		<!-- /.shortcut key-->
		<div class="modal modal-info fade" id="modal-shortcut">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span></button>
					 
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
 
		
			
<script type="text/javascript">



   function LoadAutomation(prTab){	

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
	LoadErrorList();
	}

  function StyleDoc (prStyle,prType) {
    
    var editor =CKEDITOR.instances['editor1'];
    var selectedHtml = "";
    var selection = editor.getSelection();
    if (selection) {
        selectedHtml = getSelectionHtml(selection);
    }
    var strHTML;
    if (prType==1){
      // selectedHtml=  selectedHtml.replace("<div","<p");
      // selectedHtml=  selectedHtml.replace("</div>","</p>");
      
      strHTML='<span class="'+ prStyle +'">' + selectedHtml + '</span>';
      
    }
    else{
       selectedHtml=  selectedHtml.replace(/<p /gi,'<p class="'+ prStyle +'" ');
      // selectedHtml=  selectedHtml.replace(/<div>$/,'<p>');
      // selectedHtml=  selectedHtml.replace(/<\/div>$/,'</p>');
      // selectedHtml=  selectedHtml.replace(/<div>$/,'');
      // selectedHtml=  selectedHtml.replace(/(<(div[^>]+)>)/gi,"");
      strHTML='<div class="'+ prStyle + '">' + selectedHtml + '<input name="'+ prStyle + '" type="hidden"/></div>';
      // strHTML='<' + prStyle + '>' + selectedHtml + '</'+ prStyle +'>';
       
    }
     // alert(strHTML);
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
	 function LoadStyles(){

	 
	  var response=document.getElementById("Styleslist");
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

	
	$(function(){
	 		$(document).on("click", ".TermVal", function(e){
	 			 e.preventDefault();
	 			 var data=$(this).attr("data-id");
	 			 
	 			 var findString = data.replace(/(<([^>]+)>)/ig,"");
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
	 			 
	 		})
	 	})

	function FindTerm(findString) {
			 
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
 
	</script>
		 

  
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
  _("status").innerHTML = event.target.responseText;
  _("progressBar").value = 0;
   DisplayAttachment("");
}
function errorHandler(event){
  _("status").innerHTML = "Upload Failed";
}
function abortHandler(event){
  _("status").innerHTML = "Upload Aborted";
}

  function DisplayAttachment(){
        
      var response=document.getElementById("divFileList");
      //var jTextArea=document.getElementById("jTextArea").value;
       
        prBookID = document.getElementById("BookID").value;  
      
      document.getElementById("BookID").value=prBookID;
      response.innerHTML=="";
      var jTextArea = prBookID+"/COMPOSITION" ;
      var data = 'data='+encodeURIComponent(jTextArea);
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
          response.innerHTML=xmlhttp.responseText;

          document.getElementById("pbar").style.display = "none";
        }
      }
      xmlhttp.open("POST","ReadFile3.php",true);
            //Must add this request header to XMLHttpRequest request for POST
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      
      xmlhttp.send(data);
      
  }

</script>
<script src="js/Feedback.js"></script>
</body>
</html>