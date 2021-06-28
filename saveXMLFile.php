<?php
include ("conn.php");

session_start();
$post_data = $_POST['data'];
$filename= $_POST['filename'];
$nfilename= $_POST['filename'];

$batchIds = $_POST['BatchID']; 

if (!empty($post_data)) {
    $dir = 'uploadfiles';
    // $file= explode('.',$sFileVal[1]);
    $filename = pathinfo(basename($filename), PATHINFO_FILENAME);

    $extension= pathinfo(basename($nfilename), PATHINFO_EXTENSION);

    $nfile=$filename.".sgm";

	
	$sqlRef = "SELECT * FROM primo_view_Jobs WHERE BatchId=$batchIds";
	$getDataResult = odbc_exec($conWMS, $sqlRef);

	$getRefId = odbc_fetch_array($getDataResult);
	$getRefId =  $getRefId['RefId']; 

	$sqlDocumentSeg = "SELECT * FROM TPCCR_DOCUMENT_SEG WHERE Id=$getRefId";
	$getRefResult = odbc_exec($conWMS, $sqlDocumentSeg);

	$getRes = odbc_fetch_array($getRefResult);
	$getIdDocSeg = $getRes['Id'];
	$getDocFileName = $getRes['DocFilename'];

	file_put_contents($dir."/".$getIdDocSeg."/".$nfile, $post_data);

	$update = "UPDATE TPCCR_DOCUMENT_SEG SET FinalFilename='$nfile' WHERE Id='$getIdDocSeg'";
	$resUpdate = odbc_exec($conWMS,$update);


    echo "File successfully saved.";

}
?>