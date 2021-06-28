<?php
// error_reporting(0);
set_time_limit(0);
session_start();
include ("conn.php");
 

	 
$strSQL=$_SESSION['strSQL'];
		

$SQL = $strSQL;

  
// $exportData = mysqli_exec($conn,$SQL ) or die ( "Sql error : " . mysql_error());
 
// $fields = mysqli_num_fields ( $exportData );
 
// for ( $i = 1; $i <= $fields; $i++ )
// {
//     $header .= mysqli_field_name($exportData , $i ) . "\t";
// }
  

// if($fields > 0){
    $delimiter = ",";
    $filename = "Collection_" . date('Y-m-d') . ".csv";
    
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
    $fields = array('ID','SourceURL','Filename', 'Court', 'Case No.', 'Case Name', 'Note', 'Date Registered');
    fputcsv($f, $fields, $delimiter);
    
    //output each row of the data, format line as csv and write to file pointer
    // while(mysqli_fetch_row($exportData) ){
  	    
    //     $lineData = array(odbc_result($exportData,'Name'), odbc_result($exportData,'Email'), odbc_result($exportData,'Contact Information'),odbc_result($exportData,'Address'));


    //     fputcsv($f, $lineData, $delimiter);
    // }


    $objExec= odbc_exec($conWMS,$SQL);
      {
      // Fetch one and one row
        $strText='';
      while ($row= odbc_fetch_array($objExec))
        {

          
          $nFilename=pathinfo($row["Filename"], PATHINFO_FILENAME);
          $ext = pathinfo($row["Filename"], PATHINFO_EXTENSION);

          $sFilename =$nFilename.".".$ext;


          
              $lineData = array($row["RefID"],$row["SourceURl"],$sFilename,$row["Court"], $row["CaseNumber"],$row["CaseName"],$row["Note"],$row["DateCreated"]);
            // $strText=$strText." ".$row[$fieldVal].", ";
              fputcsv($f, $lineData, $delimiter);
        }
        // return $strText;
      }
    
    //move back to beginning of file
    fseek($f, 0);
    
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //output all remaining data on a file pointer
    fpassthru($f);
// }
exit;
 

?>