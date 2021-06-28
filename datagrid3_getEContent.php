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
	 
		if ($Status==''){
	 	$strSQL1="SELECT  Count( *) as Counter from  primo_view_Jobs  Where  DateRegistered>='$date1' AND DateRegistered<='$date2' AND isnull(Jurisdiction,'')='$State'";
		 }
		else{
			
			if ($Status=='ALL'){
				$strSQL1="select   Count( *) as Counter   from primo_view_Jobs  Where DateRegistered>='$date1' AND DateRegistered<='$date2' AND  Jurisdiction ='$State' AND PROCESSCODE='CONTENTREVIEW'  ";
			}
			elseif ($Status=='Relevant'){
				$strSQL1="select   Count( *) as Counter  from primo_view_Jobs  Where DateRegistered>='$date1' AND DateRegistered<='$date2' AND isnull(Jurisdiction,'')='$State' AND PROCESSCODE='CONTENTREVIEW' and Relevancy='Relevant'   ";
			}
			elseif ($Status=='Not Relevant'){
				$strSQL1="select   Count( *) as Counter   from primo_view_Jobs  Where DateRegistered>='$date1' AND DateRegistered<='$date2' AND  Jurisdiction ='$State' AND PROCESSCODE='CONTENTREVIEW' and Relevancy='Not Relevant'  ";
			}
			elseif ($Status=='CONTENTREVIEW'){
				$strSQL1="select   Count( *) as Counter    from primo_view_Jobs  Where DateRegistered>='$date1' AND DateRegistered<='$date2' AND isnull(Jurisdiction,'')='$State' AND PROCESSCODE='CONTENTREVIEW' and Isnull(Relevancy,'')<>'' AND StatusString IN ('DONE','HOLD')    ";
			}
			else{
				$strSQL1="select   Count( *) as Counter   from primo_view_Jobs  Where DateRegistered>='$date1' AND DateRegistered<='$date2' AND isnull(Jurisdiction,'')='$State' AND PROCESSCODE='".$Status."'  AND StatusString IN ('DONE') ";
			}

		 
		}
 
		
		 
		$strSQL1 = $strSQL1 . ' and '. $cond;
		
				  
	   
 	//$strSQL1 = $strSQL1 . ' and '. $cond;		

		$objExec= odbc_exec($conWMS,$strSQL1);
		
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
 
		if ($Status==''){
	 		$strSQL="select top ".$rows." * from (Select *, ROW_NUMBER() over (order by BatchId) as r_n_n   from primo_view_Jobs  Where DateRegistered>='$date1' AND DateRegistered<='$date2' AND isnull(Jurisdiction,'')='$State' AND (<condition>)) xx where r_n_n >=$offset";
		}
		else{

			if ($Status=='ALL'){
				$strSQL="select top ".$rows." * from (Select *, ROW_NUMBER() over (order by BatchId) as r_n_n   from primo_view_Jobs  Where DateRegistered>='$date1' AND DateRegistered<='$date2' AND isnull(Jurisdiction,'')='$State' AND PROCESSCODE='CONTENTREVIEW' AND (<condition>)) xx where r_n_n >=$offset";
			}
			elseif ($Status=='Relevant'){
				$strSQL="select top ".$rows." * from (Select *, ROW_NUMBER() over (order by BatchId) as r_n_n   from primo_view_Jobs  Where DateRegistered>='$date1' AND DateRegistered<='$date2' AND isnull(Jurisdiction,'')='$State' AND PROCESSCODE='CONTENTREVIEW' and Relevancy='Relevant' AND (<condition>)) xx where r_n_n >=$offset";
			}
			elseif ($Status=='Not Relevant'){
				$strSQL="select top ".$rows." * from (Select *, ROW_NUMBER() over (order by BatchId) as r_n_n   from primo_view_Jobs  Where DateRegistered>='$date1' AND DateRegistered<='$date2' AND isnull(Jurisdiction,'')='$State' AND PROCESSCODE='CONTENTREVIEW' and Relevancy='Not Relevant' AND (<condition>)) xx where r_n_n >=$offset";
			}
			elseif ($Status=='CONTENTREVIEW'){
				$strSQL="select top ".$rows." * from (Select *, ROW_NUMBER() over (order by BatchId) as r_n_n   from primo_view_Jobs  Where DateRegistered>='$date1' AND DateRegistered<='$date2' AND isnull(Jurisdiction,'')='$State' AND PROCESSCODE='CONTENTREVIEW'  AND StatusString IN ('DONE','HOLD') and Isnull(Relevancy,'')<>'' AND (<condition>)) xx where r_n_n >=$offset";
			}
			else{
				$strSQL="select top ".$rows." * from (Select *, ROW_NUMBER() over (order by BatchId) as r_n_n   from primo_view_Jobs  Where DateRegistered>='$date1' AND DateRegistered<='$date2' AND isnull(Jurisdiction,'')='$State' AND PROCESSCODE='".$Status."'  AND StatusString IN ('DONE') AND (<condition>)) xx where r_n_n >=$offset";
			}

		 
			 
		}
	 
 
 		$strSQL = str_replace('<condition>',$cond,$strSQL);
 		
	  
		
		$items = array(); 
		//odbc_exec($conn, "SET NAMES 'UTF8'");
		//odbc_exec($conn, "SET client_encoding='UTF-8'");
		$objExec= odbc_exec($conWMS,$strSQL);

		
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





		if ($Status==''){
	 		$strSQL="select  * from (Select *, ROW_NUMBER() over (order by BatchId) as r_n_n   from primo_view_Jobs  Where DateRegistered>='$date1' AND DateRegistered<='$date2' AND isnull(Jurisdiction,'')='$State' ) xx where r_n_n >=$offset";
		}
		else{

			if ($Status=='ALL'){
				$strSQL="select  * from (Select *, ROW_NUMBER() over (order by BatchId) as r_n_n   from primo_view_Jobs  Where DateRegistered>='$date1' AND DateRegistered<='$date2' AND isnull(Jurisdiction,'')='$State' AND PROCESSCODE='CONTENTREVIEW' AND (<condition>)) xx where r_n_n >=$offset";
			}
			elseif ($Status=='Relevant'){
				$strSQL="select   * from (Select *, ROW_NUMBER() over (order by BatchId) as r_n_n   from primo_view_Jobs  Where DateRegistered>='$date1' AND DateRegistered<='$date2' AND isnull(Jurisdiction,'')='$State' AND PROCESSCODE='CONTENTREVIEW' and Relevancy='Relevant') xx where r_n_n >=$offset";
			}
			elseif ($Status=='Not Relevant'){
				$strSQL="select  * from (Select *, ROW_NUMBER() over (order by BatchId) as r_n_n   from primo_view_Jobs  Where DateRegistered>='$date1' AND DateRegistered<='$date2' AND isnull(Jurisdiction,'')='$State' AND PROCESSCODE='CONTENTREVIEW' and Relevancy='Not Relevant' ) xx where r_n_n >=$offset";
			}
			elseif ($Status=='CONTENTREVIEW'){
				$strSQL="select   * from (Select *, ROW_NUMBER() over (order by BatchId) as r_n_n   from primo_view_Jobs  Where DateRegistered>='$date1' AND DateRegistered<='$date2' AND isnull(Jurisdiction,'')='$State' AND PROCESSCODE='CONTENTREVIEW'  AND StatusString IN ('DONE','HOLD') and Isnull(Relevancy,'')<>'' ) xx where r_n_n >=$offset";
			}
			else{
				$strSQL="select  * from (Select *, ROW_NUMBER() over (order by BatchId) as r_n_n   from primo_view_Jobs  Where DateRegistered>='$date1' AND DateRegistered<='$date2' AND isnull(Jurisdiction,'')='$State' AND PROCESSCODE='".$Status."'  AND StatusString IN ('DONE') ) xx where r_n_n >=$offset";
			}

		 
			 
		}
	 

	 	$_SESSION['strSQL'] = str_replace("<condition>", "1=1", $strSQL);
  
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