<?php
  include ("conn.php");
   error_reporting(0);
    session_start();
 

   if(!empty($_POST['chk'])) {
		foreach($_POST['chk'] as $check) {
			$BatchID=$check; 

			// $sqls="Update primo_Integration SET Status='Submitted' Where RecordID='".$BatchID."'";
			ExecuteQuerySQLSERVER ($sqls,$conWMS);
			$sql="Select * from primo_view_Jobs Where BatchId='$BatchID'";
			 
			$sFilename= GetWMSValue($sql,'Filename',$conWMS);
			$Filename= GetWMSValue($sql,'Filename',$conWMS);
			
			$jaXML = str_replace(".request", '', $Filename);
			$jaXML = $jaXML.".".$extension."response_ja.xml";

			$file_names[]=$jaXML;
			 
			
			$metadataXML = str_replace(".request", '', $sFilename);
			$metadataXML = $metadataXML.".".$extension."response.metadata.xml";
			 
			$file_names[]=$metadataXML; 	

			 if(!empty($_POST['SubmitToSniffing'])) {
			 	copy("uploadfiles/Completed/".$jaXML,"uploadfiles/Completed/For Transmission/".$jaXML);
			 	copy("uploadfiles/Completed/".$metadataXML,"uploadfiles/Completed/For Transmission/".$metadataXML);
			 }

			
			 
		}

		if(!empty($_POST['SubmitToSniffing'])) {
			?>

		<script language="javascript">
			window.location = "ListofCompleted.php";
		</script>
			<?php

		}
		else{
			$archive_file_name= 'Completed.zip';
			$file_path= getcwd(). '\uploadfiles\Completed\/';
			zipFilesAndDownload($file_names,$archive_file_name,$file_path);	 	
		}
		
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
 
<!-- <script language="javascript">
	window.location = "ListofCompleted.php";
</script>
 --> 
