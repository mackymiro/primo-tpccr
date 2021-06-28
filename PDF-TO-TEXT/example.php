<?php
	include ( 'PdfToText.phpclass' ) ;

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
	
	file_put_contents("$file.txt", str_replace("\r\n", "<br>", $pdf -> Text));
	
	//if (!unlink("$file.pdf"))
	//{
		echo ("Error deleting $file");
	//}
	//else
	//{
	//	echo ("Deleted $file");
	//}
	 copy("$file.txt",str_replace(".pdf",".txt",$fileURL) );	
unlink("$file.pdf");
unlink("$file.txt");
header("Location:".$RedirectURL); 	
?>

