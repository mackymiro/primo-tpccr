<?php
  include ("conn.php");
  // error_reporting(0);
  session_start();

 
  $sLog="";

   if(!empty($_POST['chk'])) {

   	$ClusterName=$_POST['ClusterName'];
 	$sDate=date('mdY');
 	$sDate1=date('m/d/Y');
	$AuditCounter= GetWMSValue("Select * from tblQA WHERE QAID='$ClusterName'",'AuditCounter',$conWMS);

	if ($AuditCounter==''){
		$AuditCounter=1;
	}
	else{
		$AuditCounter=$AuditCounter+1;	
	}	 
	// $ClusterVal="FASRRQA".$sDate;

	// 	$sql="Select Max(QAID) As QAID From tblQA Where QAID like '%$ClusterVal%'";
	// 	$ClusterName =GenerateID($sql,"QAID",$conWMS);

	// 	if ($ClusterName==''){

	// 	   $ClusterName= $ClusterVal."0001";
	// 	}
	// 	$sLog=$sLog."ClusterName:\t".$ClusterName."\r\n";
	// 	ExecuteQuerySQLSERVER("INSERT INTO tblQA (QAID,QADate,Status) VALUES ('$ClusterName','$sDate1','New')",$conWMS);

		foreach($_POST['chk'] as $check) {
			$BatchID=$check; 

			$sql="Select * from primo_view_Jobs Where JobId='$BatchID'";
			$Filename= GetWMSValue($sql,'Filename',$conWMS);
			$ActualFile= GetWMSValue($sql,'ActualFile',$conWMS);

			// $ClusterName= GetWMSValue("Select * from tblXMLFIlename WHERE BatchFileName='$Filename'",'QAID',$conWMS);

		

			$file_names[]=$Filename;
			// $file= explode('.',$Filename);

			$filename = pathinfo(basename($Filename), PATHINFO_FILENAME);

			$strContent =file_get_contents("uploadfiles/".$filename.".xml");
			$strContent= str_replace('<?xml version="1.0"?>', "", $strContent);
			$strContent= str_replace("\r\n", "\n", $strContent);
			$cats = explode("\n\n<Content",  $strContent);
			$ctr =1;
			$sNFilename="";
			$sActNo="";

			foreach($cats as $cat) {

				$A1 = explode("<ShortName>",  $cat);

				if (count($A1)>0) {
					$A2 = explode("</ShortName>",  $A1[1]);
					$sActNo=$A2[0];
					$sActNo=str_replace("<", "-", $sActNo);
					$sActNo=str_replace(">", "-", $sActNo);
					$sActNo=str_replace(":", "-", $sActNo);
					$sActNo=str_replace('"', "-", $sActNo);
					$sActNo=str_replace(":", "-", $sActNo);
					$sActNo=str_replace("/", "-", $sActNo);
					$sActNo=str_replace("\\", "-", $sActNo);
					$sActNo=str_replace("|", "-", $sActNo);
					$sActNo=str_replace("?", "-", $sActNo);
				}


				if ($sActNo==''){
					$sNFilename=$filename."-".$ctr.".xml";
				}
				else{
					$A3= explode("_",  $filename);

					$A4=  explode("<ActNumber>",  $cat);

					if (count($A4)>0) {
						$A5 = explode("</ActNumber>",  $A4[1]);
						$sActNo1 = $A5[0];
					}



					$sNFilename=$sActNo1."_".$sActNo."_".$ctr.".xml";
					// $sNFilename=$A3[0]."_".$sActNo."_".$ctr.".xml";
				}


				$sLog=$sLog.$ActualFile."\t".$Filename."\t".$sNFilename."\r\n";

				$cat = str_replace("<p>","&lt;p&gt;", $cat);				
				$cat = str_replace("</p>","&lt;/p&gt;", $cat);
				$cat = str_replace("<u>","&lt;u&gt;", $cat);				
				$cat = str_replace("</u>","&lt;/u&gt;", $cat);
				$cat = str_replace("<b>","&lt;b&gt;", $cat);				
				$cat = str_replace("</b>","&lt;/b&gt;", $cat);
				$cat = str_replace("<i>","&lt;i&gt;", $cat);				
				$cat = str_replace("</i>","&lt;/i&gt;", $cat);
				$cat = str_replace("<strike>","&lt;strike&gt;", $cat);				
				$cat = str_replace("</strike>","&lt;/strike&gt;", $cat);
				$cat = str_replace('<font color="#f00">','&lt;font color=&quot;#f00&quot;&gt;', $cat);				
				$cat = str_replace("</font>","&lt;/font&gt;", $cat);


				if ($ctr==1) {
					file_put_contents("uploadfiles/".$sNFilename , $cat );	
				}
				else{
					file_put_contents("uploadfiles/".$sNFilename , "<Content".$cat );
				}
				// ExecuteQuerySQLSERVER("INSERT INTO tblXMLFIlename (QAID,XMLFilename,BatchFileName) VALUES ('$ClusterName','$sNFilename','$Filename')",$conWMS);
				$file_names[]=$sNFilename;	
				$ctr++;
			}

			ExecuteQuerySQLSERVER("Update PRIMO_Integration SET Status='QA' WHere JobId='$BatchID'",$conWMS);
			$archive_file_name= $ClusterName.'.zip';

			$file_path= getcwd(). '\uploadfiles\/';



			//cal the function
			
			// $BatchID=$BatchID+1;
			// $sqls="EXEC usp_wms_Allocate_BatchToUser @BatchId=".$BatchID.",@UserId=22";
			 
			// ExecuteQuerySQLSERVER ($sqls,$conWMS);
			
			// $sqls="EXEC USP_PRIMO_STARTBATCH @BatchId=".$BatchID;
			 
			// ExecuteQuerySQLSERVER ($sqls,$conWMS);
			
			// $sqls="EXEC USP_PRIMO_DONEBATCH @BatchId=".$BatchID;
			 
			// ExecuteQuerySQLSERVER ($sqls,$conWMS);
				 
			// $strSQL="SELECT * FROM primo_view_Jobs Where  BatchID='$BatchID'";	
			 
			// $objExec= odbc_exec($conWMS,$strSQL);
			
			 
			// while ($row = odbc_fetch_array($objExec)) 
			// {
			// $filename=$row["Filename"];;
			// $filename=str_replace(".pdf",".xml",$filename);
			// }
			
			 
			// $source='uploadfiles/'.$filename;
			// $destination = "uploadfiles/Transmission/E-mail/".$filename;
			// copy($source,$destination);

		}
		ExecuteQuerySQLSERVER("Update tblQA SET AuditCounter='$AuditCounter' WHERE QAID='$ClusterName'",$conWMS);

		file_put_contents("uploadfiles/Logs.log" , $sLog );	
		$file_names[]="Logs.log";
		echo $file_path;
		zipFilesAndDownload($file_names,$archive_file_name,$file_path);


	}

	
	function zipFilesAndDownload($file_names,$archive_file_name,$file_path){
    $zip = new ZipArchive();
    //create the file and throw the error if unsuccessful
    if ($zip->open($archive_file_name, ZIPARCHIVE::CREATE )!==TRUE) {
        exit("cannot open <$archive_file_name>\n");
    }
    //add each files of $file_name array to archive
    foreach($file_names as $files)  {
        $zip->addFile($file_path.$files,$files);     
    }
    $zip->close();
	$zipped_size = filesize($archive_file_name);
	header("Content-Description: File Transfer");
	header("Content-type: application/zip"); 
	header("Content-Type: application/force-download");// some browsers need this
	header("Content-Disposition: attachment; filename=$archive_file_name");
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header("Content-Length:". " $zipped_size");
	ob_clean();
	flush();
	readfile("$archive_file_name");
	unlink("$archive_file_name"); // Now delete the temp file (some servers need this option)
    exit;   
  
}
?>
<!--  
<script language="javascript">
	window.location = "ListofCompleted.php";
</script>
  -->
