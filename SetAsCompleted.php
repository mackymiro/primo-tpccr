<?php
  include ("conn.php");
  error_reporting(0);
  	session_start(); 
	$BatchID=$_POST['data'];
	$RelevantValue=$_POST['RelevantValue'];

	if ($RelevantValue=='Not Relevant'){
		if ($_SESSION['Task']=='CONTENTREVIEW'){
			// $nBatchID = GetWMSValue("Select BatchID from primo_view_Jobs Where Filename='".$Filename."' AND Processcode='DATAEXTRACTION'","BatchId",$conWMS);
			$sqls="EXEC USP_PRIMO_HOLDBATCH @BatchId=".$BatchID;
	 
			ExecuteQuerySQLSERVER ($sqls,$conWMS);

		}

	}
	else{
		$sqls="EXEC USP_PRIMO_DONEBATCH @BatchId=".$BatchID;
	 
		ExecuteQuerySQLSERVER ($sqls,$conWMS);

	}





	
	$Filename = GetWMSValue("Select Filename from primo_view_Jobs Where BatchId='".$BatchID."'","Filename",$conWMS);


	if ($_SESSION['Task']=='CONTENTREVIEW'){
		$sqls="Update primo_Integration SET Relevancy='".$RelevantValue."' Where Filename='$Filename'";
	 
		ExecuteQuerySQLSERVER ($sqls,$conWMS);
	}



	if ($_SESSION['Task']=='STYLING'){
		$sFilename= $Filename;
		 
		
		$jaXML = str_replace(".request", '', $Filename);
		$jaXML = $jaXML.".".$extension."response_ja.xml";

		$metadataXML = str_replace(".request", '', $sFilename);
		$metadataXML = $metadataXML.".".$extension."response.metadata.xml";

		copy("uploadfiles/Completed/".$jaXML,"uploadfiles/Completed/For Transmission/".$jaXML);
		copy("uploadfiles/Completed/".$metadataXML,"uploadfiles/Completed/For Transmission/".$metadataXML);



	}

	$fullscr=$_POST['fullscr'];
	
	if ($fullscr==1){
		if ($RelevantValue=='Relevant'){
			if ($_SESSION['Task']=='CONTENTREVIEW'){
				$page="GoldenGateCaller.php?filename=".$Filename;
			}
			else{
				$page="fullscr.php";
			}
		}
		else{
			$page="fullscr.php";
		}

		
	}
	else{
		if ($RelevantValue=='Relevant'){
			if ($_SESSION['Task']=='CONTENTREVIEW'){
				$page="GoldenGateCaller.php?filename=".$Filename;
			}
			else{
				$page="index.php";
			}
		}
		else{
			$page="index.php";
		}
	}

	if ($_SESSION['Task']=='WRITINGQC'){
		$UserID = GetWMSValue("Select UserId from primo_view_Jobs WHERE JobID='".$_SESSION['JobID']."' AND Processcode='WRITING'","UserId",$conWMS);
		$BatchID = GetWMSValue("Select BatchId from primo_view_Jobs WHERE JobID='".$_SESSION['JobID']."' AND Processcode='FINALREVIEW'","BatchId",$conWMS);
		$sqls="EXEC usp_wms_Allocate_BatchToUser @BatchID=".$BatchID.", @UserID=".$UserID;
  
		ExecuteQuerySQLSERVER ($sqls,$conWMS);
	}

	$_SESSION['BatchID']="";
?>
 


<script language="javascript">
	window.location = "<?php echo $page;?>";
</script>