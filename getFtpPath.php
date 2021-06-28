<?php
    require_once "Config.php";
    $path = $_GET['path'];


    $ftp_connection = ftp_ssl_connect($ftp_server); 
    $login = ftp_login($ftp_connection, $ftp_username, $ftp_userpass);
    ftp_pasv($ftp_connection, true);  
    $file_list = ftp_nlist($ftp_connection, $path);

    foreach($file_list as $dat){

        echo $dat ."<br />"; 
    }

   
?>