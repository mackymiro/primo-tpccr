<?php
//CONFIGURATION START HERE//
require_once "Config.php";

//CONFIGURATION END HERE//

//$con=mysqli_connect($mySQLServer,$mySQLUsername,$mySQLPassword,$mySQLDbase);
$con=mysqli_connect('localhost','root','','primo');
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


if ($Mode=='SQLDirect'){
	$conSearchnet=odbc_connect($SearchnetDSN,$SearchnetUsername,$SearchnetPword);
		//$conSearchnet=odbc_connect('SearchnetIdeagen','adminsearchnet','admin12345');
		if(!$conSearchnet)
		{exit("Connection Failed: " . $conSearchnet);}

	//$conWMS=odbc_connect($WMSDSN,$WMSUsername,$WMSPassword);
	$conWMS=odbc_connect($WMSDSN,$WMSUsername,$WMSPassword);
	//$conWMS=odbc_connect("Driver={SQL Server};Server=.\SQLEXPRESS;Database=WMSDEV_PRIMO_DEMO",$WMSUsername,$WMSPassword);
		if (!$conWMS)
		{exit("Connection Failed: " . $conWMS);}

}


function getAPIKey($GGUserName,$GGPassword,$GGProductionMode){
 	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://api.innodata.com/v1.1/users/login');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"authentication_method\":\"password\",\"password\":\"".$GGPassword."\",\"request_root\":true,\"username\":\"".$GGUserName."\"}");

	$headers = array();
	$headers[] = 'Accept: application/json';
	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);


	$jobj = json_decode($result);

	// $token = $jobj->response->api_keys->live;
	if ($GGProductionMode=='ON'){
		$token = $jobj->response->api_keys->live;
	}
	else{
		$token = $jobj->response->api_keys->test;	
	}

	if(curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);

	return $token;
}



function GetRecordCount($sql,$conWMS){
	$rs=odbc_exec($conWMS,$sql);
	$ctr = odbc_num_rows($rs);	 
	return $ctr;
		
}

function ExecuteQuery($prSQL,$con){
	if (!mysqli_query($con,$prSQL)){
		// echo $prSQL;
		// echo $prSQL;
		header("location:../error.html");
		die('Error: ' . mysqli_error());
	}  

}

function ExecuteQuerySQLSERVER($prSQL,$conWMS){
	$res= odbc_exec($conWMS,$prSQL);
	
	if (!$res) {
		echo odbc_error($conWMS);
		//print("SQL statement failed with error:\n");
		
	} else {
		// print("One data row inserted.\n");
	}  
}
	
function GetFieldValue($sql,$fieldVal,$con){
	 
	if ($result=mysqli_query($con,$sql))
	  {
	  // Fetch one and one row
	  while ($row=mysqli_fetch_row($result))
		{
			 
			return $row[0];
			 
		}
	  }
}
	
function GetWMSValue($sql,$fieldVal,$conWMS){
		  
		$Val='';	
		$rs=odbc_exec($conWMS,$sql);
		$ctr = odbc_num_rows($rs);
		while(odbc_fetch_row($rs))
		{
			$Val=odbc_result($rs,$fieldVal);
		}
		return $Val;
		
}

	
function GenerateGraphData($prDateFrom,$prDateTO,$prStatus,$prCode,$conWMS) {
		$prDateFrom = $prDateFrom.' 11:59:59 PM';
		$prDateTO = $prDateTO.' 12:00:00 AM';
		if ($prStatus=='On-Going'){
			 $sqlInfo = "Select Count(*) as TotalCount from  primo_view_jobs  Where StatusString IN ('Allocated','Started','Ongoing') AND LastUpdate>='$prDateFrom' AND LastUpdate<='$prDateTO' AND ProcessCode='STYLING'  ";
		}
		elseif ($prStatus=='New'){
			 $sqlInfo = "Select Count(*) as TotalCount from  primo_view_jobs  Where StatusString IN ('New') AND LastUpdate>='$prDateFrom' AND LastUpdate<='$prDateTO' AND ProcessCode='STYLING' and SourceURL<>'test'";
		}
		else{
			 $sqlInfo = "Select Count(*) as TotalCount from  primo_view_jobs  Where StatusString IN ('$prStatus') AND LastUpdate>='$prDateFrom' AND LastUpdate<='$prDateTO' AND ProcessCode='STYLING' ";

	   	 

		}
	  $rsInfo = odbc_exec($conWMS,$sqlInfo);
	  $ADM=odbc_result($rsInfo,"TotalCount");
	  
	  
	  if ($ADM==''){
	    $ADM=0;
	  }
	  if ($DataVault==''){
	    $DataVault=0;
	  }
	  if ($Dissertations==''){
	    $Dissertations=0;
	  }
	  $valAmount = $ADM.','.$DataVault.','.$Dissertations;
	    
	  return $valAmount;
}

	
function GenerateBookID($sql,$idVal,$fieldVal,$conWMS){
		  	
		$rs=odbc_exec($conWMS,$sql);
		$ctr = odbc_num_rows($rs);
		$Val="";
		while(odbc_fetch_row($rs))
		{
			$nVal=odbc_result($rs,$fieldVal);
			$Val=odbc_result($rs,$fieldVal);
		}

		if ($Val!=''){
			$Val= substr($Val,-6);
			
			$Val=intval($Val)+1;
			$Val = $idVal.str_pad($Val, 6, '0', STR_PAD_LEFT);
		}
		else{
			$Val = $idVal.str_pad(1, 6, '0', STR_PAD_LEFT);	
		}
		
		return $Val;
		
} 

	

function formatXmlString($xml) {
  // add marker linefeeds to aid the pretty-tokeniser (adds a linefeed between all tag-end boundaries)
  $xml = preg_replace('/(>)(<)(\/*)/', "$1\n$2$3", $xml);
  // now indent the tags
  $token      = strtok($xml, "\n");
  $result     = ''; // holds formatted version as it is built
  $pad        = 0; // initial indent
  $matches    = array(); // returns from preg_matches()
  // scan each line and adjust indent based on opening/closing tags
  while ($token !== false) :
    // test for the various tag states
    // 1. open and closing tags on same line - no change
    if (preg_match('/.+<\/\w[^>]*>$/', $token, $matches)) :
      $indent=0;
    // 2. closing tag - outdent now
    elseif (preg_match('/^<\/\w/', $token, $matches)) :
      $pad--;
    // 3. opening tag - don't pad this one, only subsequent tags
    elseif (preg_match('/^<\w[^>]*[^\/]>.*$/', $token, $matches)) :
      $indent=1;
    // 4. no indentation needed
    else :
      $indent = 0;
    endif;
    // pad the line with the required number of leading spaces
    $line    = str_pad($token, strlen($token)+$pad, "\t", STR_PAD_LEFT);
    $result .= $line . "\n"; // add to the cumulative result, with linefeed
    $token   = strtok("\n"); // get the next token
    $pad    += $indent; // update the pad size for subsequent lines
  endwhile;
  return $result;
}
?>