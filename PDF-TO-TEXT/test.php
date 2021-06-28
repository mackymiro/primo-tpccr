<?php
error_reporting(0);
$fileURL = $_GET['FileURL'];
	$RedirectURL=$_GET['RedirectURL'];
	$file = $_GET['FileName'];
	$sFileVal =explode('.',$file);
	 
	copy($fileURL, "$file.pdf");	
	

$pdf_file =  "$file.pdf";
$html_dir =  "$file.html";
//$cmd = "pdftotext $pdf_file $html_dir";

$cmd = "mutool convert -o $html_dir $pdf_file";
exec($cmd, $out, $ret);
//$strHTML = file_get_contents("$file.html");

//file_put_contents("$file.txt", str_replace("\r\n", "<br>", $strHTML));
$cmd = "ZoneDetection.exe $html_dir";
exec($cmd, $out, $ret);


copy("$file.html",str_replace(".pdf",".html",$fileURL) );	
unlink("$file.pdf");
unlink("$file.html");
?>
<script language="javascript">
window.location = "<?php echo $RedirectURL;?>";
</script>