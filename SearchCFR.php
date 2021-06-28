<?php
include("conn.php") ;
$post_data = trim($_POST['data']);
$A1=explode("|||",$post_data);
$sTitle = str_pad($A1[0], 3, "0", STR_PAD_LEFT);
	if ($A1[2]!=''){
		$strSQL = "Select * from tblCFR Where Title='Title $sTitle' AND Part='PART $A1[1]' AND Section like '%$A1[2]%'";
	}
	elseif ($A1[1]==''){
		$strSQL = "Select * from tblCFR Where Title='Title $sTitle'";
	}
	
	else{
		$strSQL = "Select * from tblCFR Where Title='Title $sTitle' AND Part='PART $A1[1]'";
	}
	
$sLog ="";

	$objExec= odbc_exec($conWMS,$strSQL);

	while ($row = odbc_fetch_array($objExec)) 
	{
			$sFile=$row["Section"];
		  $encoding = mb_detect_encoding($sFile, mb_detect_order(), false);
  
               if($encoding == "UTF-8")
              {
                $sFile = mb_convert_encoding($sFile, "UTF-8", "Windows-1252");    
              }
            
            
              $out = iconv(mb_detect_encoding($sFile, mb_detect_order(), false), "UTF-8//IGNORE", $sFile);
              $out = str_replace("Â§â€‰", "", $out);
              $out = str_replace("â€‰", " ", $out);
              $out = str_replace("â€￾", "", $out);
              $out = str_replace("â€”", " ", $out);
              $out = str_replace("â€œ", "", $out);
    	 $sLog = $sLog."<li class='active treeview menu-open'><a href='CFRView.php?ID=".$row["ID"]."' style='color: black' target='_blank'><b>Title:</b>".$row["Title"]."|<b>Part:</b>".$row["Part"]."|<b>Sect:</b>".$out."</a></li>";
    
  }
  echo $sLog;

?>