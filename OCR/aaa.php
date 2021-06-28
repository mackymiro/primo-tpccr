<?php
 
//file_put_contents("$file.txt", str_replace("\r\n", "<br>", $strHTML));
$cmd = "tesseract.exe a1.tif a1 -l heb -psm 3 hocr";
exec($cmd, $out, $ret);
 
?>
<script language="javascript">
window.location = "<?php echo $RedirectURL;?>";
</script>