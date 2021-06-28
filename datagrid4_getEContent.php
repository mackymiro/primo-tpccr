<?php

error_reporting(0);
set_time_limit(0);
session_start();
include 'conn.php';

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
//$offset = isset($_POST['offset']) ? intval($_POST['offset']) : 1;  
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;  

$offset = ($page-1)*$rows;
// ...  

$filterRules = isset($_POST['filterRules']) ? ($_POST['filterRules']) : '';
	$cond = '1=1';
	if (!empty($filterRules)){
		$filterRules = json_decode($filterRules);
		//print_r ($filterRules);
		foreach($filterRules as $rule){
			$rule = get_object_vars($rule);
			$field = $rule['field'];
			$op = $rule['op'];
			$value = $rule['value'];
			if (!empty($value)){
				

				if($field=='CurrentTask'){

					$cond .= " and (tblBatchInfo.CurrentTask like '%$value%')";
				}
				else{
					$cond .= " and ($field like '%$value%')";	
				}
				
			}
		}
	}
	 // $cond .= " and (tblBatchInfo.CurrentTask like 'Pro')";

	$_SESSION['rows']=$rows;
		$dtFrom= $_GET['dtFrom'];

		if ($dtFrom==''){
			$dtFrom=$_POST["dtFrom"];
		}
		
		if ($dtFrom==''){
			$dtFrom=$_SESSION['dtFrom'];
		
		}
		
		$_SESSION['dtFrom']=$dtFrom;


		$dtTo= $_GET['dtTo'];

		if ($dtTo==''){
			$dtTo=$_POST["dtTo"];
		}
		
		if ($dtTo==''){
			$dtTo=$_SESSION['dtTo'];
		
		}
		
		$_SESSION['dtTo']=$dtTo;

	 
	 
		$date2 = $dtTo;
		$date1 = $dtFrom;
		
		//echo $dateRange;
		//echo date_format( date_create($dtFrom), 'Y-m-d');
		//echo $dtTo;
		 
	  
		
		
		$Status=$_GET["Status"];
		if ($Status==''){
			$Status=$_POST["Status"];
		}
		
		// if ($Status==''){
		// 	$Status=$_SESSION['Status'];
		
		// }
		$_SESSION['Status']=$Status;

		$State=$_GET["State"];
		if ($State==''){
			$State=$_POST["State"];
		}
		
		// if ($State==''){
		// 	$State=$_SESSION['State'];
		
		// }
		
		$_SESSION['State']=$State;
		$username=$_SESSION['login_user'];
 
	 	$strSQL1="SELECT  Count( *) as Counter from  SN_Executions  Where  StartDate>='$date1' AND EndDate<='$date2' AND isnull(ConfigName,'')='".$State."_Regulation'";
		 
 
		
				  
		 
		$strSQL1 = $strSQL1 . ' and '. $cond;
	   
 	//$strSQL1 = $strSQL1 . ' and '. $cond;		

		$objExec= odbc_exec($conSearchnet,$strSQL1);
		
		$row =  odbc_fetch_array($objExec);  
		$result["total"] = $row['Counter']; 
		if ($rows==0){
			$rows=$result["total"];
		}

		
		if ($result["total"]<$rows){
			$rows=$result["total"];
		}
		
  		//$rows = odbc_result($objExec,"Counter");

	 //$rows=900; 
 
 /////////////////////////////////////////////////////////////////////	
 
		 
	 		$strSQL="select top ".$rows." * from (Select *, ROW_NUMBER() over (order by ExecutionID) as r_n_n   from SN_Executions  Where StartDate>='$date1' AND EndDate<='$date2' AND isnull(ConfigName,'')='".$State."_Regulation' AND (<condition>)) xx where r_n_n >=$offset";
	 
	 
	 
  		$strSQL = str_replace('<condition>',$cond,$strSQL);
 		
	 
		
		$items = array(); 
		//odbc_exec($conn, "SET NAMES 'UTF8'");
		//odbc_exec($conn, "SET client_encoding='UTF-8'");
		$objExec= odbc_exec($conSearchnet,$strSQL);

		
	while($row=odbc_fetch_object($objExec))
		{
			$row = utf8_array_encode($row);
			$row = str_replace_json("\r\n", "",  $row);
			$row = str_replace_json("'", "`",  $row);

			$row = str_replace_json("<", "[",  $row);
			$row = str_replace_json(">", "]",  $row);
			//$row[]=array_map("utf8_encode", $row);
			//$row[] = array_map("utf8_decode",$row);			 
		
			
			array_push($items, $row);  

		}
  
$result["rows"] = str_replace_json("<", "[",$items);  
//$result["rows"] = $items;  
// echo $result["rows"];


header("Content-type: application/json");
 echo json_encode( $result );  
 

function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}
function str_replace_json($search, $replace, $subject) 
{

    return json_decode(str_replace($search, $replace, json_encode($subject)), true);
}

function utf8_array_encode($input) 
{ 
    $return = array(); 

    foreach ($input as $key => $val) 
    { 
        if( is_array($val) ) 
        { 
            $return[$key] = utf8_array_encode($val); 
        } 
        else 
        { 
            $return[$key] = utf8_encode($val); 
        } 
    } 
    return $return;           
} 
?>