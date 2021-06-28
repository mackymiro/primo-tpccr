<?php
error_reporting(0);

$XMLTemplate=$_POST['XMLTemplate'];
$Filename=$_POST['Filename'];
	
file_put_contents($Filename, $XMLTemplate); 

?>
 
<script language="javascript">
	window.location = "Pattern.php?Filename=<?php echo $Filename;?>";
</script>
