<?php
    // Connect to FTP server
  
// Use a correct ftp server
$ftp_server = "staging.crm.dnogroup.ph";
// Use correct ftp username
$ftp_username="testing";
  
// Use correct ftp password corresponding
// to the ftp username
$ftp_userpass="helloworld";
  
// File name or path to upload to ftp server
$file = "filetoupload.txt";
   
// Establishing ftp connection 
$ftp_connection = ftp_ssl_connect($ftp_server);
//$ftp_connection = ftp_connect($ftp_server)
//    or die("Could not connect to $ftp_server");
  
if($ftp_connection) {
    echo "successfully connected to the ftp server!";
      
    // Logging in to established connection
    // with ftp username password
    $login = ftp_login($ftp_connection, $ftp_username, $ftp_userpass);
    ftp_pasv($ftp_connection, true);
      
    if($login){
          
        // Checking whether logged in successfully or not
        echo "<br>logged in successfully!";
           
        // Get file & directory list of current directory
        $file_list = ftp_nlist($ftp_connection, ".");
          
        //output the array stored in $file_list using foreach loop
        foreach($file_list as $key=>$dat) {
            echo $key."=>".$dat."<br>";
       }
    } 
    else {
        echo "<br>login failed!";
    }
      
    // echo ftp_get_option($ftp_connection, 1);
    // Closeing  connection
    if(ftp_close($ftp_connection)) {
        echo "<br>Connection closed Successfully!";
    } 
}

?>