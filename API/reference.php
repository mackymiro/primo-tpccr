<?php
include ("../conn.php");
session_start();
set_time_limit(0);
error_reporting(0);
$fileURL = $_GET['FileURL'];
$file = $_GET['FileName'];
$sFileVal =explode('.',$file);
$RedirectURL=$_GET['RedirectURL'];
$info = pathinfo($fileURL);
$fileURL= str_replace(".".$info["extension"],".pdf",$fileURL);

unlink("../uploadfiles/$sFileVal[0].htm");

$fileURL=str_replace(".pdf",".html",$fileURL);

copy($fileURL,"../uploadfiles/Input/$sFileVal[0].htm" );

 
//ob_flush();
while(!file_exists("../uploadfiles/$sFileVal[0].htm"))
{
 
}
 

$myFile = "../uploadfiles/$sFileVal[0].htm";
 sleep(5);
 //echo $myFile."<BR>";
$strHTML = file_get_contents($myFile);
//$strHTML=_utf8_decode($strHTML);
 
//$keyword =  mb_convert_encode($keyword,'UTF-8','HTML-ENTITIES'); 

//$strHTML=file("../uploadfiles/$sFileVal[0].htm");

$MLName = $_GET['MLName'];
$strHTML = str_replace('<inno-ref source="neural-net" ','<span class="marker"><',$strHTML);
$strHTML = str_replace('</inno-ref>','</span>',$strHTML);

$sText="";
$ctr=0;
$splittedstring=explode('<confidence="',$strHTML);
$ctr95=0;
$ctr80=0;
$ctrBelow=0;
$_SESSION[$MLName]=1;
foreach ($splittedstring as $key => $value) {
	$sVal=explode('"',$value);
	if($ctr!=0){
		
		$nVal= $sVal[0]*100;
		if($nVal>=95){
			$strHTML = str_replace('<confidence="'.$sVal[0].'">','<span class="above95">',$strHTML);
			$ctr95++;
		}
		elseif($nVal>=80 && $nVal<=94){
			$strHTML = str_replace('<confidence="'.$sVal[0].'">','<span class="above80">',$strHTML);
			$ctr80++;
		}
		else{
			$strHTML = str_replace('<confidence="'.$sVal[0].'">','<span class="below79">',$strHTML);
			$ctrBelow++;
		}
		ob_flush();
		 
	}
	$ctr++;
}

$sqls="Delete From tblConfidenceLevel WHERE Filename='$sFileVal[0]'";
ExecuteQuerySQLSERVER ($sqls,$conWMS);

$cDate=date("Y/m/d");
$sqls="INSERT INTO tblConfidenceLevel (Filename,Type,Count,Date) VALUES ('$sFileVal[0]','95% and up','$ctr95','$cDate')";
ExecuteQuerySQLSERVER ($sqls,$conWMS);

$sqls="INSERT INTO tblConfidenceLevel (Filename,Type,Count,Date) VALUES ('$sFileVal[0]','80 to 94%','$ctr80','$cDate')";

ExecuteQuerySQLSERVER ($sqls,$conWMS);

$sqls="INSERT INTO tblConfidenceLevel (Filename,Type,Count,Date) VALUES ('$sFileVal[0]','79% and below','$ctrBelow','$cDate')";

ExecuteQuerySQLSERVER ($sqls,$conWMS);


$Task=$_SESSION['Task'];
$BatchID=$_SESSION['BatchID'];

$prSQL ="DELETE from tblStatus Where Jobname='$BatchID' AND Process='$Task' AND MLName='Sequence Labelling'";
ExecuteQuery($prSQL,$con);

$prSQL ="INSERT INTO tblStatus (Jobname,Process,MLName) VALUES ('$BatchID','$Task','Sequence Labelling')";
ExecuteQuery($prSQL,$con);


$strHTML = str_replace('<span class="marker">','',$strHTML);
file_put_contents("../uploadfiles/$sFileVal[0].htm", $strHTML);
unlink("../uploadfiles/input/$sFileVal[0].htm");

header("Location:".$RedirectURL); 

function _utf8_decode($string)
{
  $tmp = $string;
  $count = 0;
  while (mb_detect_encoding($tmp)=="UTF-8")
  {
    $tmp = utf8_decode($tmp);
    $count++;
  }
  
  for ($i = 0; $i < $count-1 ; $i++)
  {
    $string = utf8_decode($string);
    
  }
  return $string;
  
}

?>

<script language="javascript">
	window.location = "<?= $RedirectURL;?>";
</script>
 