<?php
include "conn.php";
// error_reporting(0);
$JobID=$_POST['data'];
$filename = $_POST['filename'];


$batchIds = $_POST['BatchID']; 
$sqlRef = "SELECT * FROM primo_view_Jobs WHERE BatchId=$batchIds";
$getDataResult = odbc_exec($conWMS, $sqlRef);

$getRefId = odbc_fetch_array($getDataResult);
$getRefId =  $getRefId['RefId']; 

$sqlDocumentSeg = "SELECT * FROM TPCCR_DOCUMENT_SEG WHERE Id=$getRefId";
$getRefResult = odbc_exec($conWMS, $sqlDocumentSeg);

$getRes = odbc_fetch_array($getRefResult);
$getIdDocSeg = $getRes['Id'];
$getDocFileName = $getRes['DocFilename'];


$GGUserName = 'hj1@innodata.com';
$GGPassword='test@1qaz';
$GGProductionMode='OFF';//ON or OFF
 
$token = getAPIKey($GGUserName,$GGPassword,$GGProductionMode);
 
$ch = curl_init();
 
curl_setopt($ch, CURLOPT_URL, 'https://api.innodata.com/v1.1/jobs/'.$JobID);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

curl_setopt($ch, CURLOPT_USERPWD, $token . ":" . $token);  
$headers = array();
$headers[] = 'Accept: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);


$jobj = json_decode($result);

$GGStatus = $jobj->response->status;
 

curl_close($ch);

if ($GGStatus == 'completed'){
   $GGProgress='100';
   $URL= $jobj->response->output_content->uri;
   // echo $URL;
   $path_parts = pathinfo($filename);
   $nFilename=$path_parts['filename'];

   
    $url = $URL;
    $start = curl_init();
    curl_setopt($start, CURLOPT_URL, $url);
    curl_setopt($start, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($start, CURLOPT_CUSTOMREQUEST, 'GET');

    curl_setopt($start, CURLOPT_USERPWD, $token . ":" . $token);  
    $file_data = curl_exec($start);

    curl_close($start);
    $file_path = 'uploadfiles/' . $nFilename . '.xml';
    // echo $file_path;
    $file = fopen($file_path, 'w+');
    fputs($file, $file_data);

    $file_path1 = 'uploadfiles/' . $nFilename . '_response.xml';
    // echo $file_path;
    $file = fopen($file_path1, 'w+');
    fputs($file, $file_data);

    $file_path2 = 'uploadfiles/' . $nFilename. '.sgm';
    $file = fopen($file_path2, 'w+');
    fputs($file, $file_data);

    $file_path3 = 'uploadfiles/' .$nFilename. '_response.sgm';
    $file = fopen($file_path3, 'w+');
    fputs($file, $file_data);

    fclose($file);
    

   exec('C:\\xampp\\htdocs\\tpccr\\GGImageCropping\\GGImageCrop.exe "C:\\xampp\\htdocs\\tpccr\\uploadfiles\\'.$getIdDocSeg.'\\'.$getDocFileName.'"  "C:\\xampp\\htdocs\\tpccr\\uploadfiles\\'.$nFilename.'.xml" "C:\\xampp\\htdocs\\tpccr\\uploadfiles\\'.$getIdDocSeg.'"');

   exec('C:\\xampp\\htdocs\\tpccr\\TPCCR17-InnoDomTransformation\\TPCCR17-InnoDomTransformation.exe "C:\\xampp\\htdocs\\tpccr\\uploadfiles\\'.$nFilename.'.xml" "C:\\xampp\\htdocs\\tpccr\\uploadfiles\\'.$nFilename.'.sgm"');
 
}
else{
  $GGProgress = $jobj->response->progress->current;
}
 


echo $GGStatus."(".$GGProgress."%)" ;

 
// $get_data = callAPI('GET', 'https://54.151.177.173/GOLDG/getggstatus/'.$JobID, false);
// echo $get_data;
// $response = json_decode($get_data, true);

// $errors = $response['response']['errors'];
// $data = $response['response']['data'][0];



// $curlHandler = curl_init();

// curl_setopt_array($curlHandler, [
//     CURLOPT_URL => $url,
//     CURLOPT_RETURNTRANSFER => true,
//       CURLOPT_SSL_VERIFYPEER=>false,
//      CURLOPT_SSL_VERIFYHOST=>false,
//     /**
//      * Specify POST method
//      */
//     CURLOPT_GET => true,

//     /**
//      * Specify array of form fields
//      */
//     CURLOPT_POSTFIELDS => [
//         'user' =>'user2',
//         'live'=> true,
//         'job_id'=>$JobID
//     ],
// ]);

// $response = curl_exec($curlHandler);

// curl_close($curlHandler);
// echo $response;
// echo "<br/>";



function callAPI($method, $url, $data){
   $curl = curl_init();
   switch ($method){
      case "POST":
         curl_setopt($curl, CURLOPT_POST, 1);
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      case "PUT":
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      default:
         if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
   }
   // OPTIONS:
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'APIKEY: 111111111111111111111',
      'Content-Type: application/json',CURLOPT_RETURNTRANSFER => true,
      CURLOPT_SSL_VERIFYPEER=>false,
     CURLOPT_SSL_VERIFYHOST=>false,
   ));
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
   // EXECUTE:
   $result = curl_exec($curl);
   if(!$result){die("Connection Failure");}
   curl_close($curl);
   return $result;
}

 
?>