<?php
require __DIR__ . '/vendor/autoload.php';

use phpseclib3\Net\SFTP;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

GLOBAL $conSearchnet,$conWMS;
$Endpoint = "https://52.220.114.60/WMS.Services/WMS.Services.asmx";
$Mode="SQLDirect"; //API/SQLDirect

$GGUserName = 'hj1@innodata.com';
$GGPassword='test@1qaz';
$GGProductionMode='OFF';//ON or OFF;
//$GGTaxonomyZoning = "legal-bu-zoning-taxonomy-test-v2.json";
//$GGTaxonomyMapping = "legal-bu-taxonomy-test-v2.json";

$GGTaxonomyZoning = "19-zones-taxonomy.json";
$GGTaxonomyMapping = "legal-citations-taxonomy.json";

//job type: data-point-extraction or doc2xml
$GGJobType = "data-point-extraction";
$GGTeam="TPCCR";

//treshold set to 1.0 or 0
$mapping = 1.0;
$zoning  = 1.0;
$reading = 0;

imap_timeout(IMAP_OPENTIMEOUT, 300);
imap_timeout(IMAP_READTIMEOUT, 300);

/* Connecting Gmail server with IMAP */
$connection = imap_open('{40.100.54.2:993/imap/ssl/novalidate-cert}INBOX', 'hxn@innodata.com', 'Thankyouniverse1') or die('Cannot connect to Outlook: ' . imap_last_error());

//connnection from FTP server
//$ftp_server = "staging.crm.dnogroup.ph";
//$ftp_username="testing"; //username
//$ftp_userpass="helloworld"; //password
//$ftp_path = "/TO_INNO/CONVERSION"; //file path

// SFTP connection 
$sftp = new SFTP('ftpmnl.innodata.com'); // Replace 'server' with your server ip address, or server name

// Login with username and password
if (!$sftp->login('TPC01', 'T9ZcoG6s')) { // Replace 'username' and 'password', with your credentials
    exit('Login Failed');
}


$SourceFilePath = "C:\\XAMPP\\htdocs\\tpccr\\uploadfiles\\SourceFiles\\";

$WorkflowID=2;

$mySQLServer="localhost";
$mySQLUsername="root";
$mySQLPassword ="";
$mySQLDbase="primo";


$WMSDSN="WMSprimotpccr";
$WMSUsername="admin";
$WMSPassword="admin12345";

$SearchnetDSN="SearchnetIdeagen";
$SearchnetUsername="admin";
$SearchnetPword="admin12345";

 
if ($GGProductionMode=='ON'){
	$TokenVAL ='dXNlci1saXZlLTA3OTZjYmNlYWVkODZkOGE1ZDAzYTM0MjMwNjQwYzY0YTMwNzZiZWE6';
}
else{
	//$TokenVAL ='dXNlci10ZXN0LWFjZWMzNWQ1OWM1OGUyMGEyMDU3NGEzYmJlMTg3ZTBhODhkOWUwN2Q6';	
	$TokenVAL = 'dXNlci10ZXN0LTUzY2FkNzZmYzIzOGUzNTgwNWU5NjgzY2YxNDFlNTE4ZjliZWUzMTA6';
}

$ProjectName = explode('/', $_SERVER['REQUEST_URI'])[1];
$folderName = "TPCCR-Inventory";
$SubFolder = "SourceFiles";
?>