<?php
error_reporting(0);
include ("connection.php");
set_time_limit(0);
$dateRange= $_GET['dateRange'];

ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once 'Classes/PHPExcel.php';

	if ($dateRange==''){
		$dateRange= $_POST['dateRange'];
	}
	
	if ($dateRange==''){
		$dateRange = date("m/d/Y").' - '.date("m/d/Y");
	}
		
  
		list($date1,$date2) = explode(' - ',$dateRange);
		$date2 = $date2.' 11:59:59 PM';
		$date1 = $date1.' 12:00:00 AM';
		
		
		$keyword=$_GET["txtKeyword"];
		if ($keyword==''){
			$keyword=$_POST["txtKeyword"];
		}
		
		if ($keyword=='Web A') {
			$keyword='Web A&I';
		}
		
		$Status=$_GET["Status"];
		if ($Status==''){
			$Status='Open';
		}

		$Search =$_GET["Search"];
		
		if ($Search==''){
			$Search=$_POST["Search"];
		}

		$ReportType=$_GET["ReportType"];
		if ($ReportType==''){
			$ReportType='0';
		}
		
		$Claimer=$_GET["Claimer"];
		if ($Claimer==''){
			$Claimer=$_POST["Claimer"];
		}

		
	$Updated=$_GET["Updated"];

	if ($ReportType=='1'){
		$strSQL="SELECT Case When ISNULL(TransactionType,'')='' then 'Fresh' else TransactionType end  as TransactionType  ,tblWorkOrder.WOID,ServiceType,CONVERT(VARCHAR(10),tblWorkOrder.RegisteredDate,110) As Ship_Date,Case WHEN TrackingNo ='123456' Then '' else TrackingNo end as TrackingNo, SourceTypes, tblWorkOrder.PublicationTitles, tblWorkOrder.PMID,tblWorkOrder.IssueDateLong as IssueDate, tblWorkOrder.Volume, tblWorkOrder.Issue,  tblWorkOrder.Supplement, Part AS PC_Part,TAT,tblWorkOrder.TARFilename as ZIP_Filename, JobCode, MFG_Type, Accuracy_level as Req_AQ, CASE WHEN (IsNULL(Auto_Abstract, 'No') = 'No' OR IsNULL(Auto_Abstract, 'No') = '') AND  (ISNULL(Auto_Index, 'No') = 'No' OR ISNULL(Auto_Index, 'No') = '' ) AND (ISNULL(Abstract_Required, 'No') = 'No' OR ISNULL(Abstract_Required, 'No') = '') AND (ISNULL(Index_Required, 'No') = 'No' OR ISNULL(Index_Required, 'No') = '')AND (ISNULL(nStein, 'No') = 'No' OR ISNULL(nStein, 'No') = '' ) AND  (ISNULL([Pub Abs CSA], 'No') = 'No' OR   ISNULL([Pub Abs CSA], 'No') = '')  THEN 'Fulltext' ELSE 'With IA' END AS Other_Info,IBSS,PM_qual,Total_Pages,Total_Refs, WorkFlow, Type,TAT_Monitoring,REPLACE(CONVERT(VARCHAR(10),DATEADD(day, -1, tblWorkOrder.RegisteredDate),110),'-','/') as Downloading_Date, CONVERT(VARCHAR(10),Expected_Due_Date,110) as Expected_Due_Date,CONVERT(VARCHAR(10),Expected_Due_Date,110) as Proposed_Delivery_Date,  CONVERT(VARCHAR(10),Delivery_Date_to_Client,110) as Delivery_Date_to_Client,PQStatus As Status,PM_qual as A_I_Requirement, Reference_Linking,DateName(Month,Delivery_Date_to_Client) as  Month_Transmitted,Billed_Pages,Billed_Records,Downloading_Filename,tblWorkOrder.ProjectCode,Source_Input FROM tblWorkOrder LEFT OUTER JOIN tblTitleList ON tblWorkOrder.TLID = tblTitleList.TLID Left Outer Join tblProject On tblWorkOrder.ProjectCode = tblProject.ProjectCode Where (tblWorkOrder.PQCode='$keyword' OR tblProject.PQCode='$keyword') AND (tblWorkOrder.RegisteredDate>='$date1' AND tblWorkOrder.RegisteredDate<='$date2')  AND ISNULL(tblWorkOrder.PQStatus,'')<>'Not For Process' AND tblWorkOrder.PMID like '%$Search%' ORDER BY tblWorkOrder.WOID";
		 
	}
	else{
		$SearchType= $_GET['SearchType'];

		if ($SearchType=='MultipleSearch'){
			$PMID= $_GET['PMID'];
			$Title= $_GET['Title'];
			$Claimer= $_GET['Claimer'];
			$PQAuthor= $_GET['PQAuthor'];
			$OrigOffice= $_GET['OrigOffice'];
			$QueryDetails= $_GET['QueryDetails'];
			$Condition= $_GET['Condition'];
			if ($Condition=='NOT CONTAINS'){
				$strKeyword="PMID Not like '%$PMID%' AND PublicationTitle Notlike '%$Title%' AND Claimer Not like '%$Claimer%' AND PQAuthor NOT like '%$PQAuthor%' AND OriginatingOffice NOT like '%$OrigOffice%' AND QueryDetails NOT like '%$QueryDetails%' AND ISNULL(Deleted,0)=0";
			//	echo $strKeyword;
			}
			else{
				$strKeyword="PMID like '%$PMID%' $Condition PublicationTitle like '%$Title%' $Condition Claimer like '%$Claimer%' $Condition PQAuthor like '%$PQAuthor%' $Condition OriginatingOffice like '%$OrigOffice%' $Condition QueryDetails like '%$QueryDetails%' AND ISNULL(Deleted,0)=0";
				
			}
			$strSQL="SELECT Claimer,CtrlNo,INNO_Ctrl_Number,PQMissingIssueID as TrackingNo, OriginatingOffice, QueryDate, Hardcopy_Electronic, PMID, PublicationTitle, IssueDate, Vol_Issue, Filename,TAT, Priority, QueryDetails, QueryResponse,DateResponse, PQAuthor, InnodataAuthor, Status, InnodataDateDownloaded, InnodataRemarks,InnodataStatus  , TarFilename,tblUser.FirstName +' ' + tblUser.LastName as UpdatedBy,UpdatedDate,IssueNo FROM tblCombinedDiscrepancy LEFT OUTER JOIN tblUser ON tblUser.userName = UpdatedBy Where $strKeyword";
			//echo $strSQL;


		}
		else{
			if ($Search==''){
				if ($Status=='All'){
					if($Updated=='Updated'){
							$strSQL="SELECT CtrlNo,INNO_Ctrl_Number,PQMissingIssueID as TrackingNo, OriginatingOffice, QueryDate, Hardcopy_Electronic, PMID, PublicationTitle, IssueDate, Vol_Issue, Filename,TAT, Priority, QueryDetails, QueryResponse,DateResponse, PQAuthor, InnodataAuthor, Status, InnodataDateDownloaded, InnodataRemarks,InnodataStatus  , TarFilename,tblUser.FirstName +' ' + tblUser.LastName as UpdatedBy,UpdatedDate,Claimer,IssueNo FROM tblCombinedDiscrepancy LEFT OUTER JOIN tblUser ON tblUser.userName = UpdatedBy Where PQCode='$keyword' AND UpdatedDate>='$date1' AND UpdatedDate<='$date2' AND UpdatedBy <>'' AND ISNULL(Deleted,0)=0";
					}
					else{
							$strSQL="SELECT  CtrlNo,INNO_Ctrl_Number,PQMissingIssueID as TrackingNo, OriginatingOffice, QueryDate, Hardcopy_Electronic, PMID, PublicationTitle, IssueDate, Vol_Issue, Filename,TAT, Priority, QueryDetails, QueryResponse,DateResponse, PQAuthor, InnodataAuthor, Status, InnodataDateDownloaded, InnodataRemarks,InnodataStatus , TarFilename,tblUser.FirstName +' ' + tblUser.LastName as UpdatedBy,UpdatedDate,Claimer,IssueNo FROM tblCombinedDiscrepancy  LEFT OUTER JOIN tblUser ON tblUser.userName = UpdatedBy Where PQCode='$keyword' AND QueryDate>='$date1' AND QueryDate<='$date2' AND ISNULL(Deleted,0)=0";
					}
					
				}
				else{
					if($Updated=='Updated'){
						$strSQL="SELECT CtrlNo,INNO_Ctrl_Number,PQMissingIssueID as TrackingNo, OriginatingOffice, QueryDate, Hardcopy_Electronic, PMID, PublicationTitle, IssueDate, Vol_Issue, Filename,TAT, Priority, QueryDetails, QueryResponse,DateResponse, PQAuthor, InnodataAuthor, Status, InnodataDateDownloaded, InnodataRemarks,InnodataStatus , TarFilename,tblUser.FirstName +' ' + tblUser.LastName as UpdatedBy,UpdatedDate,Claimer,IssueNo FROM tblCombinedDiscrepancy  LEFT OUTER JOIN tblUser ON tblUser.userName = UpdatedBy Where PQCode='$keyword' AND UpdatedDate>='$date1' AND UpdatedDate<='$date2'  And InnodataStatus='$Status' AND UpdatedBy <>'' AND ISNULL(Deleted,0)=0";
					}
					else{
							$strSQL="SELECT CtrlNo,INNO_Ctrl_Number,PQMissingIssueID as TrackingNo, OriginatingOffice, QueryDate, Hardcopy_Electronic, PMID, PublicationTitle, IssueDate, Vol_Issue, Filename,TAT, Priority, QueryDetails, QueryResponse,DateResponse, PQAuthor, InnodataAuthor, Status, InnodataDateDownloaded, InnodataRemarks,InnodataStatus , TarFilename,tblUser.FirstName +' ' + tblUser.LastName as UpdatedBy,UpdatedDate,Claimer,IssueNo FROM tblCombinedDiscrepancy  LEFT OUTER JOIN tblUser ON tblUser.userName = UpdatedBy Where PQCode='$keyword' AND QueryDate>='$date1' AND QueryDate<='$date2'  And InnodataStatus='$Status' AND ISNULL(Deleted,0)=0";
					}
					
				}
			}
			else{
				if ($Status=='All') {
					if($Updated=='Updated'){
						$strSQL="SELECT CtrlNo,INNO_Ctrl_Number,PQMissingIssueID as TrackingNo, OriginatingOffice, QueryDate, Hardcopy_Electronic, PMID, PublicationTitle, IssueDate, Vol_Issue, Filename,TAT, Priority, QueryDetails, QueryResponse,DateResponse, PQAuthor, InnodataAuthor, Status, InnodataDateDownloaded, InnodataRemarks,InnodataStatus , TarFilename,tblUser.FirstName +' ' + tblUser.LastName as UpdatedBy,UpdatedDate,Claimer,IssueNo FROM tblCombinedDiscrepancy  LEFT OUTER JOIN tblUser ON tblUser.userName = UpdatedBy Where (PQCode like '%$Search%' OR PMID like '%$Search%' OR PublicationTitle like '%$Search%' OR OriginatingOffice like '%$Search%' OR QueryDetails like '%$Search%'  OR QueryResponse like '%$Search%' OR PQAuthor like '%$Search%' OR InnodataAuthor like '%$Search%' OR TarFilename like '%$Search%') AND UpdatedBy<>'' AND ISNULL(Deleted,0)=0";
					}
					else{
							$strSQL="SELECT CtrlNo,INNO_Ctrl_Number,PQMissingIssueID as TrackingNo, OriginatingOffice, QueryDate, Hardcopy_Electronic, PMID, PublicationTitle, IssueDate, Vol_Issue, Filename,TAT, Priority, QueryDetails, QueryResponse,DateResponse, PQAuthor, InnodataAuthor, Status, InnodataDateDownloaded, InnodataRemarks,InnodataStatus , TarFilename,tblUser.FirstName +' ' + tblUser.LastName as UpdatedBy,UpdatedDate,Claimer,IssueNo FROM tblCombinedDiscrepancy  LEFT OUTER JOIN tblUser ON tblUser.userName = UpdatedBy Where (PQCode like '%$Search%' OR PMID like '%$Search%' OR PublicationTitle like '%$Search%' OR OriginatingOffice like '%$Search%' OR QueryDetails like '%$Search%'  OR QueryResponse like '%$Search%' OR PQAuthor like '%$Search%' OR InnodataAuthor like '%$Search%' OR TarFilename like '%$Search%') AND ISNULL(Deleted,0)=0";
					}
					
				}
				else{
					if ($Updated=='Updated'){
						$strSQL="SELECT CtrlNo,INNO_Ctrl_Number,PQMissingIssueID as TrackingNo, OriginatingOffice, QueryDate, Hardcopy_Electronic, PMID, PublicationTitle, IssueDate, Vol_Issue, Filename,TAT, Priority, QueryDetails, QueryResponse,DateResponse, PQAuthor, InnodataAuthor, Status, InnodataDateDownloaded, InnodataRemarks,InnodataStatus , TarFilename,tblUser.FirstName +' ' + tblUser.LastName as UpdatedBy,UpdatedDate,Claimer,IssueNo FROM tblCombinedDiscrepancy  LEFT OUTER JOIN tblUser ON tblUser.userName = UpdatedBy Where (PQCode like '%$Search%' OR PMID like '%$Search%' OR PublicationTitle like '%$Search%' OR OriginatingOffice like '%$Search%' OR QueryDetails like '%$Search%'  OR QueryResponse like '%$Search%' OR PQAuthor like '%$Search%' OR InnodataAuthor like '%$Search%' OR TarFilename like '%$Search%')  And InnodataStatus='$Status' AND UpdatedBy <>'' AND ISNULL(Deleted,0)=0";
						
					}
					else{
						
							$strSQL="SELECT CtrlNo,INNO_Ctrl_Number,PQMissingIssueID as TrackingNo, OriginatingOffice, QueryDate, Hardcopy_Electronic, PMID, PublicationTitle, IssueDate, Vol_Issue, Filename,TAT, Priority, QueryDetails, QueryResponse,DateResponse, PQAuthor, InnodataAuthor, Status, InnodataDateDownloaded, InnodataRemarks,InnodataStatus , TarFilename,tblUser.FirstName +' ' + tblUser.LastName as UpdatedBy,UpdatedDate,Claimer,IssueNo FROM tblCombinedDiscrepancy  LEFT OUTER JOIN tblUser ON tblUser.userName = UpdatedBy Where (PQCode like '%$Search%' OR PMID like '%$Search%' OR PublicationTitle like '%$Search%' OR OriginatingOffice like '%$Search%' OR QueryDetails like '%$Search%'  OR QueryResponse like '%$Search%' OR PQAuthor like '%$Search%' OR InnodataAuthor like '%$Search%' OR TarFilename like '%$Search%')  And InnodataStatus='$Status' AND ISNULL(Deleted,0)=0";
					}
					
				}
			}
			
			if ($Claimer!='(Select All)'){
				$strSQL = $strSQL . " and Claimer='$Claimer'";
			}

		}
	}
//	echo $strSQL;

$SQL = $strSQL;


$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("PQ Dashboard")
							 ->setLastModifiedBy("PQ dashboard")
							 ->setTitle("PQ dashboard")
							 ->setSubject("PQ dashboard")
							 ->setDescription("PQ Dashboard")
							 ->setKeywords("PQ dashboard")
							 ->setCategory("PQ Dashboard");



$header = '';
$result ='';
$exportData = odbc_exec($conn,$SQL ) or die ( "Sql error : " . mysql_error( ) );
 
$fields = odbc_num_fields ( $exportData );
 
for ( $i = 1; $i <= $fields; $i++ )
{
    $header .= odbc_field_name($exportData , $i ) . "\t";
}
 
 	if ($ReportType=='1'){
 		$Title='Consolidated Report';
		 $objPHPExcel->setActiveSheetIndex(0)
           	 ->setCellValue('A1','WOID')
            ->setCellValue('B1','Ship_Date')
			->setCellValue('C1','TrackingNo')
			->setCellValue('D1','SourceTypes')
			->setCellValue('E1','IBSS')
			->setCellValue('F1','PublicationTitles')
			->setCellValue('G1','PMID')
			->setCellValue('H1','IssueDate')
			->setCellValue('I1','Volume')
			->setCellValue('J1','Issue')
			->setCellValue('K1','Supplement')
			->setCellValue('L1','TAT')
			->setCellValue('M1','ZIP_Filename')
			->setCellValue('N1','JobCode')
			->setCellValue('O1','MFG_Type')
			->setCellValue('P1','Req_AQ')
			->setCellValue('Q1','Other_Info')
			->setCellValue('R1','PM_Qual')
			->setCellValue('S1','Total_Pages')
			->setCellValue('T1','WorkFlow')
			->setCellValue('U1','Type')
			->setCellValue('V1','TAT_Monitoring')
			->setCellValue('W1','Downloading_Date')
			->setCellValue('X1','Expected_Due_Date')
			->setCellValue('Y1','Delivery_Date_to_Client')
			->setCellValue('Z1','Status')
			->setCellValue('AA1','Month_Transmitted')
			->setCellValue('AB1','Downloading_Filename')
			->setCellValue('AC1','TransactionType')
			->setCellValue('AD1','Fulltext Service_Type')
			->setCellValue('AE1','Billed_Pages')
			->setCellValue('AF1','Total Billed Records')
			->setCellValue('AG1','A&I_1(Nstein-ABI) CHVADEAO')
			->setCellValue('AH1','A&I_2(Regular A&I-ABI) CHVADEAP')
			->setCellValue('AI1','A&I_3(Regular A&I-PA) CHVADEAQ')
			->setCellValue('AJ1','A&I_4(Indexing Only-TI) CHVADEAR')
			->setCellValue('AK1','A&I_5(Indexing Only-PA/Softline) CHVADEAS')
			->setCellValue('AL1','A&I_6(Foreign-PA) CHVADEAT')
			->setCellValue('AM1','A&I_7(Nstein-PA) CHVADEAU')
			->setCellValue('AN1','A&I_8(Nstein - ABI/Abstracting) CHVADEAV')
			->setCellValue('AO1','A&I_SelectionCHVADEAW')
			->setCellValue('AP1','Actual_Fulltext_Cost (Billed Pages)')
			->setCellValue('AQ1','Actual_A&I_Cost (Total_Billed_Records)')
			->setCellValue('AR1','Total Actual_Cost')
			->setCellValue('AS1','ProjectCode');
	}
	
	else{
	 	$Title='Combined Discrepancy Report';
		 $objPHPExcel->setActiveSheetIndex(0)
	//	->setCellValue('A1','CtrlNo')
		->setCellValue('A1','INNO_Ctrl_Number')
		->setCellValue('B1','TrackingNo')
		->setCellValue('C1','OriginatingOffice')
		->setCellValue('D1','QueryDate')
		->setCellValue('E1','Hardcopy_Electronic')
		->setCellValue('F1','PMID')
		->setCellValue('G1','PublicationTitle')
		->setCellValue('H1','IssueDate')
		->setCellValue('I1','Volume/IssueNo')
		->setCellValue('J1','Filename')
		->setCellValue('K1','TAT')
		->setCellValue('L1','Priority')
		->setCellValue('M1','QueryDetails')
		->setCellValue('N1','QueryResponse')
		->setCellValue('O1','UpdatedDate')
		->setCellValue('P1','Claimer')
		->setCellValue('R1','Status')
		->setCellValue('S1','InnodataDateDownloaded')
		->setCellValue('Q1','InnodataAuthor')
		->setCellValue('T1','InnodataRemarks')
		->setCellValue('U1','TarFilename')
		->setCellValue('V1','UpdatedBy');
		
	}
$ctr2=2;
 
while(odbc_fetch_row($exportData) )
{
  	  	// $value = str_replace( '"' , '""' ,GetFieldValue(odbc_result($exportData,odbc_field_name($exportData , $i ) ),odbc_field_name($exportData , $i ),odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')));
         //$value = '"' . $value . '"' . "\t";
         //echo GetFieldValue(odbc_result($exportData,'PublicationTitles'),'PublicationTitles',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'));
        if ($ReportType=='1'){
		 	$objPHPExcel->setActiveSheetIndex(0)
		 	
           ->setCellValue('A'.$ctr2,GetFieldValue(odbc_result($exportData,'WOID'),'WOID',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')))
			->setCellValue('B'.$ctr2,GetFieldValue(odbc_result($exportData,'Ship_Date'),'Ship_Date',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')))
			->setCellValue('C'.$ctr2,GetFieldValue(odbc_result($exportData,'TrackingNo'),'TrackingNo',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')))
			->setCellValue('D'.$ctr2,GetFieldValue(odbc_result($exportData,'SourceTypes'),'SourceTypes',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input')))
			->setCellValue('E'.$ctr2,GetFieldValue(odbc_result($exportData,'IBSS'),'IBSS',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')))
			->setCellValue('F'.$ctr2,GetFieldValue(odbc_result($exportData,'PublicationTitles'),'PublicationTitles',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')))
			->setCellValue('G'.$ctr2,GetFieldValue(odbc_result($exportData,'PMID'),'PMID',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')))
			->setCellValue('H'.$ctr2,GetFieldValue(odbc_result($exportData,'IssueDate'),'IssueDate',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')))
			->setCellValue('I'.$ctr2,GetFieldValue(odbc_result($exportData,'Volume'),'Volume',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')))
			->setCellValue('J'.$ctr2,GetFieldValue(odbc_result($exportData,'Issue'),'Issue',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')))
			->setCellValue('K'.$ctr2,GetFieldValue(odbc_result($exportData,'Supplement'),'Supplement',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')))
			->setCellValue('L'.$ctr2,GetFieldValue(odbc_result($exportData,'TAT'),'TAT',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')))
			->setCellValue('M'.$ctr2,GetFieldValue(odbc_result($exportData,'ZIP_Filename'),'ZIP_Filename',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')))
			->setCellValue('N'.$ctr2,GetFieldValue(odbc_result($exportData,'JobCode'),'JobCode',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')))
			->setCellValue('O'.$ctr2,GetFieldValue(odbc_result($exportData,'MFG_Type'),'MFG_Type',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')))
			->setCellValue('P'.$ctr2,GetFieldValue(odbc_result($exportData,'Req_AQ'),'Req_AQ',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')))
			->setCellValue('Q'.$ctr2,GetFieldValue(odbc_result($exportData,'Other_Info'),'Other_Info',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')))
			->setCellValue('R'.$ctr2,GetFieldValue(odbc_result($exportData,'PM_Qual'),'PM_Qual',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')))
			->setCellValue('S'.$ctr2,GetFieldValue(odbc_result($exportData,'Total_Pages'),'Total_Pages',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')))
			->setCellValue('T'.$ctr2,GetFieldValue(odbc_result($exportData,'WorkFlow'),'WorkFlow',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')))
			->setCellValue('U'.$ctr2,GetFieldValue(odbc_result($exportData,'Type'),'Type',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input')))
			->setCellValue('V'.$ctr2,GetFieldValue(odbc_result($exportData,'TAT_Monitoring'),'TAT_Monitoring',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')))
			->setCellValue('W'.$ctr2,GetFieldValue(odbc_result($exportData,'Downloading_Date'),'Downloading_Date',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input'),$conn))
			->setCellValue('X'.$ctr2,GetFieldValue(odbc_result($exportData,'Expected_Due_Date'),'Expected_Due_Date',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')))
			->setCellValue('Y'.$ctr2,GetFieldValue(odbc_result($exportData,'Delivery_Date_to_Client'),'Delivery_Date_to_Client',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')))
			->setCellValue('Z'.$ctr2,GetFieldValue(odbc_result($exportData,'Status'),'Status',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')))
			->setCellValue('AA'.$ctr2,GetFieldValue(odbc_result($exportData,'Month_Transmitted'),'Month_Transmitted',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')))
			->setCellValue('AB'.$ctr2,GetFieldValue(odbc_result($exportData,'Downloading_Filename'),'Downloading_Filename',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')))
			->setCellValue('AC'.$ctr2,GetFieldValue(odbc_result($exportData,'TransactionType'),'TransactionType',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')))
			->setCellValue('AD'.$ctr2,GetFieldValue(odbc_result($exportData,'ServiceType'),'ServiceType',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input'),$conn,odbc_result($exportData,'MFG_Type')))
			->setCellValue('AS'.$ctr2,GetFieldValue(odbc_result($exportData,'ProjectCode'),'ProjectCode',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes')));
	
	}
	
	else{
		 $objPHPExcel->setActiveSheetIndex(0)
	//	->setCellValue('A'.$ctr2,GetFieldValue(odbc_result($exportData,'CtrlNo'),'CtrlNo',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input')))
		->setCellValue('A'.$ctr2,GetFieldValue(odbc_result($exportData,'INNO_Ctrl_Number'),'INNO_Ctrl_Number',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input')))
		->setCellValue('B'.$ctr2,GetFieldValue(odbc_result($exportData,'TrackingNo'),'TrackingNo',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input')))
		->setCellValue('C'.$ctr2,GetFieldValue(odbc_result($exportData,'OriginatingOffice'),'OriginatingOffice',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input')))
		->setCellValue('D'.$ctr2,GetFieldValue(odbc_result($exportData,'QueryDate'),'QueryDate',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input')))
		->setCellValue('E'.$ctr2,GetFieldValue(odbc_result($exportData,'Hardcopy_Electronic'),'Hardcopy_Electronic',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input')))
		->setCellValue('F'.$ctr2,GetFieldValue(odbc_result($exportData,'PMID'),'PMID',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input')))
		->setCellValue('G'.$ctr2,GetFieldValue(odbc_result($exportData,'PublicationTitle'),'PublicationTitle',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input')))
		->setCellValue('H'.$ctr2,GetFieldValue(odbc_result($exportData,'IssueDate'),'IssueDate',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input')))
		->setCellValue('I'.$ctr2,GetFieldValue(odbc_result($exportData,'Vol_Issue'),'Vol_Issue',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input')))
		->setCellValue('J'.$ctr2,GetFieldValue(odbc_result($exportData,'Filename'),'Filename',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input')))
		->setCellValue('K'.$ctr2,GetFieldValue(odbc_result($exportData,'TAT'),'TAT',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input')))
		->setCellValue('L'.$ctr2,GetFieldValue(odbc_result($exportData,'Priority'),'Priority',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input')))
		->setCellValue('M'.$ctr2,GetFieldValue(odbc_result($exportData,'QueryDetails'),'QueryDetails',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input')))
		->setCellValue('N'.$ctr2,GetFieldValue(odbc_result($exportData,'QueryResponse'),'QueryResponse',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input')))
		->setCellValue('O'.$ctr2,GetFieldValue(odbc_result($exportData,'UpdatedDate'),'UpdatedDate',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input')))
		->setCellValue('P'.$ctr2,GetFieldValue(odbc_result($exportData,'Claimer'),'Claimer',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input')))
		->setCellValue('R'.$ctr2,GetFieldValue(odbc_result($exportData,'InnodataStatus'),'InnodataStatus',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input')))
		->setCellValue('S'.$ctr2,GetFieldValue(odbc_result($exportData,'InnodataDateDownloaded'),'InnodataDateDownloaded',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input')))
		->setCellValue('Q'.$ctr2,GetFieldValue(odbc_result($exportData,'InnodataAuthor'),'InnodataAuthor',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input')))		
		->setCellValue('T'.$ctr2,GetFieldValue(odbc_result($exportData,'InnodataRemarks'),'InnodataRemarks',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input')))
		->setCellValue('U'.$ctr2,GetFieldValue(odbc_result($exportData,'TarFilename'),'TarFilename',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input')))
		->setCellValue('V'.$ctr2,GetFieldValue(odbc_result($exportData,'UpdatedBy'),'UpdatedBy',odbc_result($exportData,'ProjectCode'),odbc_result($exportData,'SourceTypes'),odbc_result($exportData,'Source_Input')));
		}
         
         $ctr2++;
         
 }
 
 // Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle($Title);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);



// Redirect output to a clientÃ¢â‚¬â„¢s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="exported record.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
 

function GetFieldValue($prValue, $prField,$prCode,$prOptionalVal,$prOptionalVal1,$conn,$prOptionalVal2){
   	
	if ($prField=='SourceTypes') {
		if ($prCode=='CHVCP(PDF)'){
			return 'Issue Level PDF';

		}
		elseif ($prCode=='CHVCP (Hardcopy)'){
			return 'Scanned Images';
		}
		elseif ($prCode=='CHVGR'){
			return 'TIFF/PDF';
		}
		elseif ($prCode=='CHVGR(CSA/PDF)'){
			return 'CSA';
		}
		elseif ($prCode=='CHVSO'){
			return 'Newspaper';
		}
		elseif ($prCode=='CHVWB'){
			return 'Web A&I';
		}
		elseif ($prCode=='Intellinews'){
			
		}
		elseif ($prCode=='CHVEP(PDF)'){
			return $prOptionalVal1;
		}
		elseif ($prCode=='CHVEP (ASCII/HTML)'){
			return $prOptionalVal1;
		}
		elseif ($prCode=='CHVRF'){
			
		}
		elseif ($prCode=='CHVGR(CSA/Hardcopy)'){
			return 'CSA';
		}
	}
	elseif($prField=='WorkFlow'){
		if ($prValue==''){
			
			if ($prCode=='CHVCP(PDF)'){
				return 'Websourced/FTP Pick-Up';
			}
			elseif ($prCode=='CHVCP (Hardcopy)'){
				return 'FTP Pick-Up';
			}
			elseif ($prCode=='CHVGR'){
				return 'FTP Pick-Up';
			}
			elseif ($prCode=='CHVGR(CSA/PDF)'){
				return 'Websourced';
			}
			elseif ($prCode=='CHVSO'){
				return 'FTP Pick-Up';
			}
			elseif ($prCode=='CHVWB'){
				return 'Websourced/FTP Pick-Up';
			}
			elseif ($prCode=='Intellinews'){
				
			}
			elseif ($prCode=='CHVEP(PDF)'){
				return 'Websourced/FTP Pick-Up';
			}
			elseif ($prCode=='CHVEP (ASCII/HTML)'){
				return 'Websourced/FTP Pick-Up';
			}
			elseif ($prCode=='CHVRF'){
				
			}
			elseif ($prCode=='CHVGR(CSA/Hardcopy)'){
				return 'FTP Pick-Up';
			}
		}
		else{
			return $prValue;
			
		}
	}
 	 elseif($prField=='Type'){
		if ($prCode=='CHVCP(PDF)'){
			return 'Issue Level';
		}
		elseif ($prCode=='CHVCP (Hardcopy)'){
			return 'Hardcopy';
		}
		elseif ($prCode=='CHVGR'){
			return 'Data';
		}
		elseif ($prCode=='CHVGR(CSA/PDF)'){
			return 'CSA';
		}
		elseif ($prCode=='CHVSO'){
			return 'English';
		}
		elseif ($prCode=='CHVWB'){
			return 'Web A&I';
		}
		elseif ($prCode=='Intellinews'){
			
		}
		elseif ($prCode=='CHVEP(PDF)'){
			return 'Article Level';
		}
		elseif ($prCode=='CHVEP (ASCII/HTML)'){
			return $prOptionalVal1;
		}
		elseif ($prCode=='CHVRF'){
			
		}
		elseif ($prCode=='CHVGR(CSA/Hardcopy)'){
			return 'CSA';
		}
		
	}
	elseif($prField=='Status'){
			if ($prValue=='On-Going'){
				return 'In Progress';
			}
			else{
				return $prValue;
			}
	}
	
	elseif($prField=='ServiceType'){
		if ($prCode=='CHVCP(PDF)'){
			return 'S5';
		}
		elseif ($prCode=='CHVCP (Hardcopy)'){
			if (strtoupper ($prOptionalVal2)=='IMAGE ONLY' || strtoupper ($prOptionalVal2)=='IMAGE ONLY COLOR'){
				return 'S2';
			}
			else{
				return 'S1';
			}

		}
		elseif ($prCode=='CHVGR'){
			return 'Article Select';
		}
		elseif ($prCode=='CHVGR(CSA/PDF)'){
			return 'Article Select';
		}
		elseif ($prCode=='CHVSO'){
			return 'S3';
		}
		elseif ($prCode=='CHVWB'){
			return 'Article Select';
		}
		elseif ($prCode=='Intellinews'){
			
		}
		elseif ($prCode=='CHVEP(PDF)'){
			return 'S4';
		}
		elseif ($prCode=='CHVEP (ASCII/HTML)'){
			return 'S4';
		}
		elseif ($prCode=='CHVRF'){
			
		}
		elseif ($prCode=='CHVGR(CSA/Hardcopy)'){
			return 'ASCI';
		}
	}
	 
	elseif($prField=='MFG_Type'){
		if ($prValue==''){
			
			if ($prCode=='CHVCP(PDF)'){
				return 'Websourced/FTP Pick-Up';
			}
			elseif ($prCode=='CHVCP (Hardcopy)'){
				return 'FTP Pick-Up';
			}
			elseif ($prCode=='CHVGR'){
				return 'FTP Pick-Up';
			}
			elseif ($prCode=='CHVGR(CSA/PDF)'){
				return 'ASCII';
			}
			elseif ($prCode=='CHVSO'){
				return 'FTP Pick-Up';
			}
			elseif ($prCode=='CHVWB'){
				return 'Websourced/FTP Pick-Up';
			}
			elseif ($prCode=='Intellinews'){
				
			}
			elseif ($prCode=='CHVEP(PDF)'){
				return 'Websourced/FTP Pick-Up';
			}
			elseif ($prCode=='CHVEP (ASCII/HTML)'){
				return 'Websourced/FTP Pick-Up';
			}
			elseif ($prCode=='CHVRF'){
				
			}
			elseif ($prCode=='CHVGR(CSA/Hardcopy)'){
				return 'ASCII';
			}
		}

		else{
			return $prValue;
			
		}
	}
		elseif($prField=='Downloading_Date'){
		
		$my_date = date('l', strtotime($prValue));
		$my_date1 = date('d/m/Y', strtotime($prValue));
		$x = 0;
		$date = date_create($prValue);	
		
		while ($x==0){
			if ($my_date=='Sunday') {

				date_sub($date, date_interval_create_from_date_string('2 days'));	
			}
			elseif ($my_date=='Saturday') {
				date_sub($date, date_interval_create_from_date_string('1 days'));	
			}
			elseif (GetHoliday($date->format('m-d-Y'),$conn)!=''){
				date_sub($date, date_interval_create_from_date_string('1 days'));	
			}
			
			$my_date= $date->format('l');
			
			if ($my_date!='Sunday' && $my_date!='Saturday' && GetHoliday($date->format('m-d-Y'),$conn)==''){
				$x=1;
			}

		}
 
		//echo $date->format('m-d-Y');

		
		return $date->format('m-d-Y');
		
	}
	elseif($prField=='PublicationTitles'){
		$encoding = mb_detect_encoding($prValue, mb_detect_order(), false);
	
	    if($encoding == "UTF-8")
	    {
	        $prValue = mb_convert_encoding($prValue, 'UTF-8', 'UTF-8');    
	    }
	
	
	    $out = iconv(mb_detect_encoding($prValue, mb_detect_order(), false), "UTF-8//IGNORE", $prValue);
			return $out; 
	}
	else{
			return $prValue;
			
		}


}
function GetHoliday($prCtrlNo, $conn){
   	$sqlInfo = "SELECT HolidayID From tblHoliday Where HolidayDate='$prCtrlNo'";

	$rsInfo = odbc_exec($conn,$sqlInfo);
	
	
 	$QueryResponse = odbc_result($rsInfo,"HolidayID");
  

 	return $QueryResponse;

}

?>