<?php
	include ( '../../PdfToText.phpclass' ) ;

	function  output ( $message )
	   {
		if  ( php_sapi_name ( )  ==  'cli' )
			echo ( $message ) ;
		else
			echo ( nl2br ( $message ) ) ;
	    }
	$fileURL = $_GET['FileURL'];
	$RedirectURL=$_GET['RedirectURL'];
	$file = $_GET['FileName'];
	$sFileVal =explode('.',$file);
	 
	copy($fileURL, "$file.pdf");	
	
	$file	=  $sFileVal[0] ;
	$pdf	=  new PdfToText ( "$file.pdf" ) ;
 
	//output ( "Extracted file contents :\n" ) ;
	// output ( $pdf -> Text ) ;


	$sText= $pdf -> Text;
	$sText= str_replace("  "," ",$sText);
	$sText= str_replace("  "," ",$sText);
	$sText= str_replace("  "," ",$sText);
	$sText= str_replace("<br> <br>","<bbr>",$sText);
	$sText= str_replace("<br>","",$sText);
	$sText= str_replace("<bbr>","<p>",$sText);
	$sText= str_replace("<br>","<p>",$sText);

	file_put_contents("$file.txt", $sText);
	
	//if (!unlink("$file.pdf"))
	//{
		echo ("Error deleting $file");
	//}
	//else
	//{
	//	echo ("Deleted $file");
	//}
	 copy("$file.txt",str_replace(".pdf",".txt",$fileURL) );	

header("Location:".$RedirectURL); 	
?>

