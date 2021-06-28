<?php
  include ("conn.php");
 
	$sql="Update tbluser SET Password='$_POST[Password]' Where UserName='$_POST[UserName]'";
  
	ExecuteQuery($sql,$con);
?>
 
    <script language="javascript">
	 
			window.location = "<?php echo $_POST['RedirectPage'];?>";
		</script>
