<?php
include ("conn.php");
$Filename=$_POST['data'];

// $isExist = GetWMSValue("Select RecordID from tblRecord Where Filename ='".$Filename."'",'RecordID',$conWMS);

// if ($isExist!=''){

// 	$sql="SELECT * FROM tblRecord Where RecordID='$isExist'";	
		
// 		$rs=odbc_exec($conWMS,$sql);
// 		$ctr = odbc_num_rows($rs);
// 		$JSON="{";
// 		while(odbc_fetch_row($rs))
// 		{
			 
// 			$Title=odbc_result($rs,"Title");
// 			$Register=odbc_result($rs,"Register");
// 			$Type=odbc_result($rs,"Type");
// 			$Priority=odbc_result($rs,"Priority");
// 			$Topic=odbc_result($rs,"Topic");
// 			$OriginatingDate=odbc_result($rs,"OriginatingDate");
// 			$StateDate=odbc_result($rs,"StateDate");
// 			$Status=odbc_result($rs,"Status");
// 			$Remarks=odbc_result($rs,"Remarks");

			
			
// 		}
// 		$JSON = $JSON.'"title" : "'.$Title.'", "register" : "'.$Register.'", "type" : "'.$Type.'", "priority" : "'.$Priority.'", "topic1" : "'.$Topic.'", "status" : "'.$Status.'", "dates1originating_date1" : "'.$OriginatingDate.'", "dates1state_date1" : "'.$StateDate.'", "Remarks" : "'.$Remarks.'"}';

// }
// else{
	$path_parts = pathinfo($Filename);
	 $nFilename=$path_parts['filename'];


	$XMLFile = file_get_contents("uploadfiles/".$nFilename.".sgm");
	
	//$XMLFile = str_replace("</para><para>", "</para>\r\n<para>", $XMLFile);
	//$XMLFile = str_replace( "\r\n</para>","</para>", $XMLFile);

	$reformatted_xml = preg_replace('/\h+/', ' ', $XMLFile); //multiple spaces
    $reformatted_xml = preg_replace('/^[ \t]*[\r\n]+/m', '', $reformatted_xml);// remove multiple blank new line and tab
    $reformatted_xml = preg_replace('/( <)/', "<", $reformatted_xml); //remove space before start tag
    $reformatted_xml = preg_replace('/>\s+/', '>', $reformatted_xml); //multiple spaces
    $reformatted_xml = preg_replace('/><+/', '>'.PHP_EOL.'<', $reformatted_xml); //set new line for new tags

	//$string = str_replace("/<[^/>][^>]*><\/[^>]+>/", "", $XMLFile);
	echo trim($reformatted_xml);
// }


// echo json_encode($JSON);
// echo $JSON;

 
?>

