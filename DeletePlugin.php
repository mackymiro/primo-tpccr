<?php
  include ("conn.php");
  //error_reporting(0);
	$TaskID=$_POST['TaskID'];
	$ProcessCode=$_POST['ProcessCode'];	
	
	if(!empty($_POST['chk'])) {
		foreach($_POST['chk'] as $check) {
			$BatchID=$check; 
			
			$sql="Delete FROM tbltaskplugin Where PluginID='$BatchID'";
			ExecuteQuery($sql,$con);
			
			
		}
	}
	
	function delete_files($target) {
    if(is_dir($target)){
        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

        foreach( $files as $file ){
            delete_files( $file );      
        }

        rmdir( $target );
    } elseif(is_file($target)) {
        unlink( $target );  
    }
}
?>
<script language="javascript">
	window.location = "PluginConfig.php?UID=<?php echo $TaskID;?>&ProcessCode=<?php echo $ProcessCode;?>";
</script>

