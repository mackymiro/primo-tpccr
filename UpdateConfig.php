<?php
  include ("conn.php");
  error_reporting(0);
		
	$TaskID=$_POST['TaskID'];
	$SOURCE=$_POST['SOURCE'];
	$Styling=$_POST['Styling'];
	$XML_Editor=$_POST['XML_Editor'];
	$SequenceLabeling=$_POST['SequenceLabeling'];
	$TextCat=$_POST['TextCat'];
	$DataEntry=$_POST['DataEntry'];
	$TreeView=$_POST['TreeView'];
	$MenuGroup=$_POST['MenuGroup'];
	$ProcessCode=$_POST['ProcessCode'];
	$sgmlTransformation = $_POST['SGMLTransformation'];
	 
	if ($SOURCE!=''){
		$SOURCE=1;
	}
	else{
		$SOURCE=0;
	}
	if ($Styling!=''){
		$Styling=1;
	}
	else{
		$Styling=0;
	}
	if ($XML_Editor!=''){
		$XML_Editor=1;
	}
	else{
		$XML_Editor=0;
	}
	if ($SequenceLabeling!=''){
		$SequenceLabeling=1;
	}
	else{
		$SequenceLabeling=0;
	}
	if ($TextCat!=''){
		$TextCat=1;
	}
	else{
		$TextCat=0;
	}
	if ($DataEntry!=''){
		$DataEntry=1;
	}
	else{
		$DataEntry=0;
	}
	if ($TreeView!=''){
		$TreeView=1;
	}
	else{
		$TreeView=0;
	}
	if($sgmlTransformation != ''){
		$sgmlTransformation = 1;
	}else{
		$sgmlTransformation = 0;
	}

	 $sql="SELECT * FROM tbltaskeditorsetting Where TaskID='$TaskID'";
	if ($result=mysqli_query($con,$sql))
	{
		while ($row=mysqli_fetch_row($result))
		{
			$sID=$row[0];
		}
	}
    
	if ($sID!=''){
		$sql="
			Update tbltaskeditorsetting 
			SET Source='$SOURCE',
			Styling='$Styling',
			XMLEditor='$XML_Editor',
			SequenceLabeling='$SequenceLabeling',
			TextCategorization='$TextCat',
			DataEntry='$DataEntry',
			TreeView='$TreeView',
			MenuGroup='$MenuGroup',
			ProcessCode='$ProcessCode',
			sgml_transformation='$sgmlTransformation'
			WHERE TaskID='$TaskID'";
	}
	else{
		$sql="INSERT INTO tbltaskeditorsetting ( TaskID, Source, Styling, XMLEditor, SequenceLabeling, TextCategorization,MenuGroup,sgml_transformation,ProcessCode,DataEntry,TreeView) VALUES ('$TaskID','$SOURCE','$Styling','$XML_Editor','$SequenceLabeling','$TextCat','$MenuGroup', '$sgmlTransformation', '$ProcessCode','$DataEntry','$TreeView')";
	}
	ExecuteQuery($sql,$con);
	
	$sql="DELETE FROM tbltaskml WHERE TaskID='$TaskID'";
	ExecuteQuery($sql,$con);
	$ctr=1;
	if(!empty($_POST['chk'])) {
		foreach($_POST['chk'] as $check) {
			$BatchID=$check; 
			$AutoLoad=GetAutoloadVal($BatchID);
			$sql="INSERT INTO tbltaskml (TaskID,MLID,Autoload) VALUES ('$TaskID','$BatchID','$AutoLoad')";
			
			$ctr++;
			 ExecuteQuery($sql,$con);
		}
	}
	
	function GetAutoloadVal($prArrayPos){
		 
	 
		if(!empty($_POST['AutoLoad'])) {
			foreach($_POST['AutoLoad'] as $check) {
				$BatchID=$check; 
				if ($BatchID==$prArrayPos){
					 
					return 1;
				}
				 
			}
		}
		
	}
?>
 
<script language="javascript">
	window.location = "TaskSettings.php";
</script>
