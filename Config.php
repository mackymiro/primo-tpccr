<?php

GLOBAL $conSearchnet,$conWMS;
$Endpoint = "https://52.220.114.60/WMS.Services/WMS.Services.asmx";
$Mode="SQLDirect"; //API/SQLDirect

$GGUserName = 'hj1@innodata.com';
$GGPassword='test@1qaz';
$GGProductionMode='OFF';//ON or OFF;
$GGTaxonomyZoning = "legal-bu-zoning-taxonomy-test-v2.json";
$GGTaxonomyMapping = "legal-bu-taxonomy-test-v2.json";

//job type: data-point-extraction or doc2xml
$GGJobType = "data-point-extraction";
$GGTeam="TPCCR";

//treshold set to 1.0 or 0
$mapping = 1.0;
$zoning  = 1.0;
$reading = 0;


/* Connecting Gmail server with IMAP */
$connection = imap_open('{imap.gmail.com:993/imap/ssl}INBOX', 'ask.macky.miro@gmail.com', 'gu3stadmintmp@abc') or die('Cannot connect to Gmail: ' . imap_last_error());


//connnection from FTP server
$ftp_server = "staging.crm.dnogroup.ph";
$ftp_username="testing"; //username
$ftp_userpass="helloworld"; //password
$ftp_path = "/TO_INNO/CONVERSION"; //file path

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