<?php
    require_once "Config.php";
    session_start();

    $file = $_GET['file'];
    echo $file; 
    echo "<br />";
  
    $fExp = explode('/', $file);
   
    //echo $fExp[3];
    echo "<br />";
    echo $fExp[4];
    echo "<br />";
    echo $fExp[5];
    echo "<br />";
    

    $fileConCat = $fExp[3]."-".$fExp[4];

    echo $fileConCat; 

    $local_file_path = mkdir("TPCCR-Inventory/".$fileConCat."/");

    $sftp->get($fExp[5], $local_file_path);
    $sftp->put($fExp[5], 'helo sample');

    exit;

    $source = $file; // Target file on FTP server
    $destination = "downloadedFtpFiles/$fExp[5]"; // Save to this file

    if($fExp[3] == "BCSC"){
      $ref = "BCSEC";
      $sqlSave = "INSERT INTO tbl_tpccr_outlook_files(Ref, Bundle_No, Subject1, TAT, Delivery_Date, No_of_files, Source_Type, Source_Path, status, created_at, updated_at)
      VALUES('$ref', '')";
    }else{

    }


    // (B) CONNECT TO FTP SERVER
    $ftp = ftp_connect($ftp_server) or die("Failed to connect to $ftp_server");


    // (C) LOGIN & DOWNLOAD
    if (ftp_login($ftp, $ftp_username, $ftp_userpass)) {
        ftp_pasv($ftp, true); 
        ftp_get($ftp, $destination, $source, FTP_BINARY)
        ? "Saved to $destination"
        : "Error downloading $source" ;
    } else { echo "Invalid user/password"; }

    $_SESSION['succSave'] = "File Successfully Downloaded.";
    
    // (D) CLOSE FTP CONNECTION
    ftp_close($ftp);

?>

<script language="javascript">
  window.location = "ftpfile.php";
</script>
