<?php
require("class.filetotext.php");
$fileURL = $_GET['FileURL'];
	$RedirectURL=$_GET['RedirectURL'];
	$file = $_GET['FileName'];
	$sFileVal =explode('.',$file);
	 
	copy($fileURL, "$file.pdf");	
	
	
$docObj = new Filetotext("$file.pdf");
//$docObj = new Filetotext("test.pdf");
$return = $docObj->convertToText();
file_put_contents("$file.txt", str_replace("\r\n", "<br>",$return));
copy("$file.txt",str_replace(".pdf",".txt",$fileURL) );	
unlink("$file.pdf");
unlink("$file.txt");
//header("Location:".$RedirectURL); 	
 
?>
<script language="javascript">
window.location = "<?php echo $RedirectURL;?>";
</script>