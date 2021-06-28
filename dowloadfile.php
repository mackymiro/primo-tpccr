<?php
    require_once "Config.php";
    session_start();

    $file = $_GET['file'];
    
    $fExp = explode('/', $file);
   

    $source = $file; // Target file on FTP server
    $destination = "downloadedFtpFiles/$fExp[5]"; // Save to this file


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
