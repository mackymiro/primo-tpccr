
<?php
	session_start();
$fileURL = $_GET['FileURL'];
$file = $_GET['FileName'];
$MLName = $_GET['MLName'];
$sFileVal =explode('.',$file);
$RedirectURL=$_GET['RedirectURL'];

$fileURL=str_replace(".pdf",".html",$fileURL);
$fileURL=str_replace(".PDF",".html",$fileURL);

$file	=  $sFileVal[0] ;
$url = "https://10.160.0.88/primoDataForAI/Case_Classification/CaseClassification.php?FileURL=$fileURL&FileName=$file&RedirectURL=$RedirectURL";

//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
// This is what solved the issue (Accepting gzip encoding)
//curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");     
//$response = curl_exec($ch);
//curl_close($ch);
 
//file_put_contents("../uploadfiles/$file.cls", $response);
$_SESSION[$MLName]=1;
header("Location:".$url); 
?>