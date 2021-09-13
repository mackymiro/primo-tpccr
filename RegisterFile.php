<?php
include "conn.php";

error_reporting(0);
session_start();
 

$txtFiles=$_FILES['txtFiles']['name'];


$WithImageEdit = "New";


/*$path = "uploadfiles/SourceFiles/CFLQ-39.1.pdf";
$totalPages = countPages($path);

function countPages($path) {

  $pdftext = file_get_contents($path);
  $num = preg_match_all("/\/Page\W/", $pdftext, $dummy);

  if($num > 10){
    echo "BATCHING PROCESS";
  }else{
    echo "not more than 10 pages";
  }
}*/

if ($txtFiles!='') {
  $dirname="uploadfiles/SourceFiles";

  MultipleFileUploadEX('txtFiles',$BookID,'SourceFiles',$conWMS,$GGUserName,$GGPassword,$GGProductionMode);
}
 


function MultipleFileUploadEX($prFileName,$TLID,$SubFolder,$conWMS,$GGUserName,$GGPassword,$GGProductionMode){
    ini_set('upload_max_filesize', '50M');
    ini_set('post_max_size', '50M');
    ini_set('max_input_time', 300);
    ini_set('max_execution_time', 300);

    $total = count($_FILES[$prFileName]['name']);

    if ($total>0) {
      // delete_directory($dirname);
      
      mkdir("uploadfiles/".$SubFolder);
    }
    // Loop through each file
  for($i=0; $i<$total; $i++) {
    //Get the temp file path
    $tmpFilePath = $_FILES[$prFileName]['tmp_name'][$i];

    //Make sure we have a filepath
  if ($tmpFilePath != ""){
    //Setup our new file path

    $newFilePath = "uploadfiles/".$SubFolder."/". $_FILES[$prFileName]['name'][$i];
    //Upload the file into the temp dir
    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
         
        $ext = pathinfo($newFilePath, PATHINFO_EXTENSION);
        $filename=pathinfo($newFilePath, PATHINFO_FILENAME).".".$ext;

        //$sqls="EXEC USP_PRIMO_INTEGRATE_old @ExecutionId=1,  @mainUrl='www.example.com',  @SourceUrl='www.example.com?filename=".$filename."',@Filename='".$filename."',@Jobid=''";
        //$sqls="EXEC USP_PRIMO_INTEGRATE @Filename='".$filename."',@Jobid=''";
        //$sqls="EXEC USP_PRIMO_INTEGRATE @Filename='".$filename."',@ProcessType='".$ProcessType."',@Jobid='' ";

        $sqls="EXEC USP_PRIMO_INTEGRATE @Filename='".$filename."',@ProcessType='".$ProcessType."',@WithImageEdit='".$WithImageEdit."',@Jobid='' ";

        ExecuteQuerySQLSERVER ($sqls,$conWMS);


        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        $JobID= GetWMSValue("Select JobID From PRIMO_Integration WHERE Filename='".$filename."'","JobId",$conWMS);

        //this is commented out
        // $BatchId=GetWMSValue("Select BatchId from primo_view_Jobs Where JobID='$JobID'","BatchId",$conWMS);

        //this is commented out
        // $sqls="EXEC USP_PRIMO_HOLDBATCH @BatchId=".$BatchId;
   
        //this is commented
        // ExecuteQuerySQLSERVER ($sqls,$conWMS);
 
        // ExecuteQuerySQLSERVER ("Update PRIMO_Integration Set DocumentType='Awards' Where JobId='".$JobID."'",$conWMS);

        $sFilename=$filename;
           
        $token = getAPIKey($GGUserName,$GGPassword,$GGProductionMode);

        UploadToGoldenGate($filename,$JobID,$token,$conWMS,$sFilename);

    } 
    
  }
}
}


//  function getAPIKey(){
//   $ch = curl_init();

// curl_setopt($ch, CURLOPT_URL, 'https://api.innodata.com/v1.1/users/login');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"authentication_method\":\"password\",\"password\":\"Inn0d@t@\",\"request_root\":true,\"username\":\"jbello@innodata.com\"}");

// $headers = array();
// $headers[] = 'Accept: application/json';
// $headers[] = 'Content-Type: application/json';
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// $result = curl_exec($ch);


// $jobj = json_decode($result);

// // $token = $jobj->response->api_keys->live;

// $token = $jobj->response->api_keys->test;


// if (curl_errno($ch)) {
//     echo 'Error:' . curl_error($ch);
// }
// curl_close($ch);

// return $token;
// }

function UploadToGoldenGate($prFilename,$prJobID,$token,$conWMS,$sFilename){
  include 'Config.php';
  $fields = array();
  $_SESSION['token']=$token;
      // files to upload
  $filenames = array($SourceFilePath.$prFilename);

    $files = array();
    foreach ($filenames as $f){
      $files[$f] = file_get_contents($f);
    }
    
    // URL to upload to
    $url = "https://api.innodata.com/v1.1/documents";


    $curl = curl_init();

    $url_data = http_build_query($fields);
    $ext = pathinfo($prFilename, PATHINFO_EXTENSION);

    $boundary = uniqid();
    $delimiter = '-------------' . $boundary;

    $post_data = build_data_files($boundary, $fields, $files);

    if (strtoupper($ext)=='PDF'){
      $xType='application/pdf';
    }
    else{
      $xType='text/'.$ext;
    }


    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_MAXREDIRS => 10,
      //CURLOPT_TIMEOUT => 30,
      CURLOPT_TIMEOUT => 0,
      //CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POST => 1,
      CURLOPT_POSTFIELDS => $post_data,
      CURLOPT_USERPWD => $token.":".$token,
      // "Authorization: Basic dXNlci1saXZlLTYzMmE1YTYzLWQ2ZDYtNDI0Ni05MWNhLWQ1NDY2MzI2OThkMzo=",
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/octet-stream; boundary=" . $delimiter,
        "X-Name: " . $prFilename,
        "X-type: ".$xType ,
        "Content-Length: " . strlen($post_data)

      ),

      
    ));


    //
    $response = curl_exec($curl);

    $jobj = json_decode($response);

    $ContentURI = $jobj->response->contents_uri;
    $fSize = $jobj->response->size;

    ExecuteQuerySQLSERVER("Update PRIMO_integration SET ContentURI='".$ContentURI."' Where JobId='".$prJobID."'",$conWMS);

    // POST JOBS
    // echo $ContentURI;
    
    $info = curl_getinfo($curl);

    
    curl_close($curl);

    PostJob($token,$ContentURI,$prFilename,$fSize,$conWMS,$isImage,$prJobID);

}

function PostJob($token,$ContentURI,$filename,$fSize,$conWMS,$isImage,$prJobID){
    // echo "TOKEN:".$token."<br>";
    include 'Config.php';
    // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://api.innodata.com/v1.1/jobs');

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // CURLOPT_USERPWD => $token.":".$token,
    curl_setopt($ch, CURLOPT_POST, 1);
    

    // curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"collaboration\":{\"teams\":[{\"name\":\"WKLI\",\"steps\":[\"*\"]}]},\"input_content\":{\"role\":\"input\",\"uri\":\"".$ContentURI."\"},\"metadata\":{\"mapping\":{\"high_confidence_threshold\":\"1.0\",\"qa\":{\"teams\":[{ \"from\": \"8e651b35-074e-4d44-a306-5be24baac8e7\", \"to\": \"764bc3b8-94d0-4228-a218-b83f6078ea8a\" }]},\"taxonomy\":\"wkli-taxonomy.json\"},\"text-extraction\":{\"ocr\":true},\"zoning\":{\"high_confidence_threshold\":\"0\"}},\"type\":\"data-point-extraction\",\"use_for_training\":true}");
    //curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"collaboration\":{\"teams\":[{\"name\":\"".$GGTeam."\",\"steps\":[\"*\"]}]},\"input_content\":{\"role\":\"input\",\"uri\":\"".$ContentURI."\"},\"metadata\":{\"mapping\":{\"high_confidence_threshold\":\"1.0\",\"qa\":{\"teams\":[]},\"taxonomy\":\"".$GGTaxonomy."\"},\"zoning\":{\"high_confidence_threshold\":\"1.0\"}},\"type\":\"data-point-extraction\",\"use_for_training\":false}");
    //curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"collaboration\":{\"teams\":[{\"name\":\"TPCCR\",\"steps\":[\"*\"]}]},\"input_content\":{\"role\":\"input\",\"uri\":\"".$ContentURI."\"},\"metadata\":{\"mapping\":{\"high_confidence_threshold\":\"1.0\",\"qa\":{\"teams\":[]},\"taxonomy\":\"legal-bu-taxonomy-test-v2.json\"},\"zoning\":{\"high_confidence_threshold\":\"1.0\",\"taxonomy\":\"19-zones-taxonomy.json\"},\"reading\":{\"high_confidence_threshold\":\"1.0\"}},\"type\":\"data-point-extraction\",\"use_for_training\":true}"); doc2xml
    //curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"collaboration\":{\"teams\":[{\"name\":\"".$GGTeam."\",\"steps\":[\"*\"]}]},\"input_content\":{\"role\":\"input\",\"uri\":\"".$ContentURI."\"},\"metadata\":{\"mapping\":{\"high_confidence_threshold\":\"1.0\",\"qa\":{\"teams\":[]},\"taxonomy\":\"".$GGTaxonomyMapping."\"},\"zoning\":{\"high_confidence_threshold\":\"1.0\",\"taxonomy\":\"".$GGTaxonomyZoning."\"},\"reading\":{\"high_confidence_threshold\":\"1.0\"}},\"type\":\"".$GGJobType."\",\"use_for_training\":true}"); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"collaboration\":{\"teams\":[{\"name\":\"".$GGTeam."\",\"steps\":[\"*\"]}]},\"input_content\":{\"role\":\"input\",\"uri\":\"".$ContentURI."\"},\"metadata\":{\"mapping\":{\"high_confidence_threshold\":\"".$mapping."\",\"qa\":{\"teams\":[]},\"taxonomy\":\"".$GGTaxonomyMapping."\"},\"zoning\":{\"high_confidence_threshold\":\"".$zoning."\",\"taxonomy\":\"".$GGTaxonomyZoning."\"},\"reading\":{\"high_confidence_threshold\":\"1.0\"}},\"type\":\"data-point-extraction\",\"use_for_training\":true}"); 
      
      curl_setopt($ch, CURLOPT_USERPWD, $token . ":" . $token);  
      $headers = array();
      $headers[] = 'Accept: application/json';
      $headers[] = 'Content-Type: application/json';
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

      $result = curl_exec($ch);


      $jobj = json_decode($result);


      // $A1=explode('"id":"',$result);
      // $A2=explode('"', $A1[1]);

      // $GGJobID = $A2[0];
        
      $GGJobID = $jobj->response->id;


      ExecuteQuerySQLSERVER("Update PRIMO_integration SET GGJobID='".$GGJobID."'  Where JobId='".$prJobID."'",$conWMS);


      if (curl_errno($ch)) {
          echo 'Error:' . curl_error($ch);
      }
      curl_close($ch);


}
 



function reArrayFiles($file)
{
    $file_ary = array();
    $file_count = count($file['name']);
    $file_key = array_keys($file);
   
    for($i=0;$i<$file_count;$i++)
    {
        foreach($file_key as $val)
        {
            $file_ary[$i][$val] = $file[$val][$i];
        }
    }
    return $file_ary;
}

function BookFileContent($prFileName,$TLID,$conWMS){
ini_set('upload_max_filesize', '50M');
ini_set('post_max_size', '50M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);

$total = count($_FILES[$prFileName]['name']);

// if ($total>0) {
//   delete_directory($dirname);
//  mkdir("uploadfiles/".$TLID);
// }
// Loop through each file
for($i=0; $i<$total; $i++) {
  //Get the temp file path
  $tmpFilePath = $_FILES[$prFileName]['tmp_name'][$i];

  //Make sure we have a filepath
  if ($tmpFilePath != ""){
    //Setup our new file path

    $newFilePath = "uploadfiles/".$TLID."/". $_FILES[$prFileName]['name'][$i];
    $prFileName=$_FILES[$prFileName]['name'][$i];
     ExecuteQuerySQLSERVER("Update tblBookInfo SET BaseFile='".$prFileName."' WHERE BookID='".$TLID."'",$conWMS);
    //Upload the file into the temp dir
    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
      //Handle other code here
      
      
    } 
    
  }
}
}


function MultipleFileUpload($prFileName,$TLID){
  ini_set('upload_max_filesize', '50M');
  ini_set('post_max_size', '50M');
  ini_set('max_input_time', 300);
  ini_set('max_execution_time', 300);

  $total = count($_FILES[$prFileName]['name']);

  // if ($total>0) {
  //   delete_directory($dirname);
  // 	mkdir("uploadfiles/".$TLID);
  // }
  // Loop through each file
for($i=0; $i<$total; $i++) {
  //Get the temp file path
  $tmpFilePath = $_FILES[$prFileName]['tmp_name'][$i];

  //Make sure we have a filepath
  if ($tmpFilePath != ""){
    //Setup our new file path

    $newFilePath = "uploadfiles/".$TLID."/". $_FILES[$prFileName]['name'][$i];
    //Upload the file into the temp dir
    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
      //Handle other code here



      
    } 
    
  }
}
}

function MultipleFileUpload1($prFileName,$TLID,$SubFolder){
ini_set('upload_max_filesize', '50M');
ini_set('post_max_size', '50M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);

$total = count($_FILES[$prFileName]['name']);

if ($total>0) {
  // delete_directory($dirname);
  mkdir("uploadfiles/".$SubFolder);
}

  for($i=0; $i<$total; $i++) {
    //Get the temp file path
    $tmpFilePath = $_FILES[$prFileName]['tmp_name'][$i];

    //Make sure we have a filepath
    if ($tmpFilePath != ""){
      //Setup our new file path

      $newFilePath = "uploadfiles/".$SubFolder."/". $_FILES[$prFileName]['name'][$i];
      //Upload the file into the temp dir
      if(move_uploaded_file($tmpFilePath, $newFilePath)) {
         
        
      } 
      
    }
  }
}


function UploadPhoto($prFilename,$prUser){
ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);
  if(isset($_FILES[$prFilename])){
      $name_array = $_FILES[$prFilename]['name'];
      $tmp_name_array = $_FILES[$prFilename]['tmp_name'];
      $type_array = $_FILES[$prFilename]['type'];
      $size_array = $_FILES[$prFilename]['size'];
      $error_array = $_FILES[$prFilename]['error'];
      
      mkdir("uploadfiles/".$prUser);

        if(move_uploaded_file($tmp_name_array, "uploadfiles/".$prUser."/".$prUser.".".$type_array)){
          // echo $name_array[$i]." upload is complete<br>";
        } else {
            //echo "move_uploaded_file function failed for ".$name_array[$i]."<br>";
        }
  
  }
}


function build_data_files($boundary, $fields, $files){
    $data = '';
    $eol = "\r\n";

    $delimiter = '-------------' . $boundary;

    foreach ($fields as $name => $content) {
        $data .= "--" . $delimiter . $eol
            . 'Content-Disposition: form-data; name="' . $name . "\"".$eol.$eol
            . $content . $eol;
    }


    foreach ($files as $name => $content) {
      $fieldname='file';
        $data .= "--" . $delimiter . $eol
            . 'Content-Disposition: form-data; name="' . $fieldname . '"; filename="' . $name . '"' . $eol
            . 'Content-Type: xml/text'.$eol
            // . 'Content-Transfer-Encoding: binary'.$eol
            ;

        $data .= $eol;
        $data .= $content . $eol;
       
    }
    $data .= "--" . $delimiter . "--".$eol;


    return $data;
}
?>
<?php 
   $_SESSION['message'] = "File Successfully Uploaded.";
?>
<script language="javascript">
  window.location = "Registration.php?page=Acquire";
</script>
