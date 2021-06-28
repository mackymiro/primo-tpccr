<?php
set_time_limit(0);
$fileURL = $_GET['FileURL'];
	$RedirectURL=$_GET['RedirectURL'];
	$file = $_GET['FileName'];
	$sFileVal =explode('.',$file);
	 
	copy($fileURL, "$file.pdf");	
	

$pdf_file =  "$file.pdf";
$html_dir =  "$file.html";
//$cmd = "pdftotext $pdf_file $html_dir";
$tif_File=$file."_0001.tif";
$cmd = "PDF2Image.exe";
exec($cmd, $out, $ret);

while(!file_exists("$file.tif"))
{
	rename("$tif_File","$file.tif");
}

//$strHTML = file_get_contents("$file.html");

//file_put_contents("$file.txt", str_replace("\r\n", "<br>", $strHTML));
$cmd = "tesseract.exe ".$file.".tif ".$file." -l heb -psm 3 hocr";
exec($cmd, $out, $ret);

while(!file_exists("$file.html"))
{
 
}

copy("$file.html",str_replace(".pdf",".html",$fileURL) );	
unlink("$file.pdf");
unlink("$file.html");
unlink("$tif_File");
?>
<script language="javascript">
window.location = "<?php echo $RedirectURL;?>";
</script>