<?php
include "conn.php";

// error_reporting(0);
$JobID=$_POST['data'];
$filename = $_POST['filename'];
// $JobID='0925ed03-e241-4baa-bc0c-7f918a257344';

// URL to upload to
   
$token = getAPIKey($GGUserName,$GGPassword,$GGProductionMode);


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.innodata.com/v1.1/jobs/'.$JobID.'/rewind');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_USERPWD, $token . ":" . $token);  
    $headers = array();
    $headers[] = 'Accept: application/json';
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    $jobj = json_decode($result);
    
   
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);


// $curlHandler = curl_init();

// curl_setopt_array($curlHandler, [
//     CURLOPT_URL => 'https://54.151.177.173/GOLDG/ggrewind?user=user2&live=false&job_id='.$JobID,
//     CURLOPT_RETURNTRANSFER => true,
//       CURLOPT_SSL_VERIFYPEER=>false,
//      CURLOPT_SSL_VERIFYHOST=>false,
//      CURLOPT_CUSTOMREQUEST=>'POST',
    
  
// ]);

// $response = curl_exec($curlHandler);
 

//  $jobj = json_decode($response);

//   echo $response;

// curl_close($curlHandler);

?>