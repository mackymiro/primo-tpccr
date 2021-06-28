<?php
//error_reporting(E_ALL);
//var_dump($_SERVER);

session_start();
$post_data = trim($_POST['data']);


$fileVal=trim($_SESSION['FileName']);
$sFileVal =explode('.',$fileVal);
 
if (!empty($post_data)) {
    $dir = 'uploadfiles';
 
    
    if (file_exists($dir."/".$sFileVal[0] .".htm")) {
    	//Do nothing
        unlink($dir."/".$sFileVal[0] .".htm");
        file_put_contents($dir."/".$sFileVal[0] .".htm", $post_data); 
        file_put_contents($sFileVal[0] .".htm", $post_data); 
    }
    else{
    	file_put_contents($dir."/".$sFileVal[0] .".htm", $post_data); 
        file_put_contents($sFileVal[0] .".htm", $post_data);  
    }
    
    $html_dir=$sFileVal[0] .".htm";
    $cmd = "ZoneDetection.exe $html_dir";
    exec($cmd, $out, $ret);

    copy($sFileVal[0] .".xml", $dir."/".$sFileVal[0] .".xml");   
    unlink($sFileVal[0] .".xml");
    $sFile= file_get_contents($dir."/".$sFileVal[0] .".xml");
    echo $sFile;
    //echo $nfile;
}

  
?>


