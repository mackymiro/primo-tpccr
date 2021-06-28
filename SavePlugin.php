<?php
  include ("conn.php");
  //error_reporting(0);
		
	$TaskID=$_POST['TaskID'];
	$ProcessCode=$_POST['ProcessCode'];
	$PluginName=$_POST['PluginName'];
	$EXEName=$_POST['EXEName'];
	$UI=$_POST['UI'];
	$PluginType=$_POST['PluginType'];
	
	  
	$sql="INSERT INTO tbltaskplugin ( PluginName, PluginEXE, UI, PluginType, TaskID, Processcode) VALUES ('$PluginName','$EXEName','$UI','$PluginType','$TaskID','$ProcessCode')";
	
	ExecuteQuery($sql,$con);
	
	$txtAttachFile=$_FILES['txtAttachFile']['name'];
	
	MultipleFileUpload('txtAttachFile',$PluginName);
	
	mkdir("uploadfiles/Plugin/".$UI."/".$PluginName);
	mkdir("uploadfiles/Plugin/".$UI."/".$PluginName."/Input");
	mkdir("uploadfiles/Plugin/".$UI."/".$PluginName."/Output");
	 
function MultipleFileUpload($prFileName,$TLID){
	ini_set('upload_max_filesize', '10M');
	ini_set('post_max_size', '10M');
	ini_set('max_input_time', 300);
	ini_set('max_execution_time', 300);


	$total = count($_FILES[$prFileName]['name']);
	if ($total>0) {
		mkdir("Application/".$TLID);
	}
	// Loop through each file
	for($i=0; $i<$total; $i++) {
	  //Get the temp file path
	  $tmpFilePath = $_FILES[$prFileName]['tmp_name'][$i];

	  //Make sure we have a filepath
	  if ($tmpFilePath != ""){
		//Setup our new file path
		$newFilePath = "Application/".$TLID."/". $_FILES[$prFileName]['name'][$i];

		//Upload the file into the temp dir
		if(move_uploaded_file($tmpFilePath, $newFilePath)) {

		  //Handle other code here

		}
	  }
	}
}
?>
 <script language="javascript">
	window.location = "PluginConfig.php?UID=<?php echo $TaskID;?>&ProcessCode=<?php echo $ProcessCode;?>";
</script>

