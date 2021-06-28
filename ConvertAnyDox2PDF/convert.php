<?php
	$fileURL = $_GET['FileURL'];
	$RedirectURL=$_GET['RedirectURL'];
	$file = $_GET['FileName'];
	$sFileVal =explode('.',$file);
	 
	copy($fileURL, "$file");	
	
	$info = pathinfo($file);
	
	$pdfFile= str_replace(".".$info["extension"],".pdf",$file);
  
//$cmd = "pdftotext $pdf_file $html_dir";

$cmd = "doc2any.exe $file $pdfFile";
exec($cmd, $out, $ret);
 

//file_put_contents("$file.txt", str_replace("\r\n", "<br>", $strHTML));



copy($pdfFile,str_replace(".".$info["extension"],".pdf",$fileURL) );	
unlink("$file");
unlink("$pdfFile");
?>
<script language="javascript">
window.location = "<?php echo $RedirectURL;?>";
</script>