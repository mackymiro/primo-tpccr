<?php
  include ("conn.php");
  // error_reporting(0);
  session_start();
   if(!empty($_POST['chk'])) {
		foreach($_POST['chk'] as $check) {

			$QAID=$check;



			// $sql="Select * from primo_view_Jobs Where JobId='$BatchID'";



			// $Filename= GetWMSValue($sql,'Filename',$conWMS);
			// $ActualFile= GetWMSValue($sql,'ActualFile',$conWMS);

			$rs=odbc_exec($conWMS,"Select * from tblXMLFilename WHERE QAID='$QAID'");
			$ctr = odbc_num_rows($rs);
			while(odbc_fetch_row($rs))
			{
				$sNFilename=odbc_result($rs,'XMLFilename');
				$FileName=odbc_result($rs,'BatchFileName');

				$ActualFile= GetWMSValue("Select * from   PRIMO_Integration WHERE Filename='$FileName'",'ActualFile',$conWMS);
				$fSize =filesize("uploadfiles/".$sNFilename).' bytes';
				$sLog=$sLog.$ActualFile."\t".$FileName."\t".$sNFilename."\t".filesize("uploadfiles/".$sNFilename).' bytes'."\r\n";

				$file_names[]=$sNFilename;	

				ExecuteQuerySQLSERVER("Update PRIMO_Integration SET Status='Transmitted' WHere Filename='$FileName'",$conWMS);
			}		 

			// ExecuteQuerySQLSERVER("Update PRIMO_Integration SET Status='Transmitted' WHere JobId='$BatchID'",$conWMS);
			ExecuteQuerySQLSERVER("Update tblQA SET Status='Transmitted' WHere QAID='$QAID'",$conWMS);

			$archive_file_name= 'ForTransmission.zip';

			$file_path= getcwd(). '\uploadfiles\/';

		}
		file_put_contents("uploadfiles/Logs.log" , $sLog );	
		$file_names[]="Logs.log";
		 
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
