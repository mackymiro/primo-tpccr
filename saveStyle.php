<?php
error_reporting(0);
  include ("conn.php");
  
  $InLine=$_POST['InLine'];
	 
	if ($InLine!=''){
		$InLine=1;
	}
	else{
		$InLine=0;
	}
	
	
	$ctrlKey=$_POST['ctrlKey'];
	 
	if ($ctrlKey!=''){
		$ctrlKey=1;
	}
	else{
		$ctrlKey=0;
	}
	$Shftkey=$_POST['Shftkey'];
	 
	if ($Shftkey!=''){
		$Shftkey=1;
	}
	else{
		$Shftkey=0;
	}
	 
 
	if ($_GET['TransType']=='Delete'){
		$sql="DELETE FROM tblstyles WHERE StyleID='$_GET[txtID]'";
		ExecuteQuery($sql,$con);
	}
	else{
		
		
		if ($_POST['UID']!=''){
			$sql="Update tblstyles SET StyleName='$_POST[StyleName]',Color='$_POST[Color]',FontColor='$_POST[FontColor]',InLine='$InLine',ctrlKey='$ctrlKey',Shftkey='$Shftkey',KeyVal='$_POST[KeyVal]' WHERE StyleID='$_POST[UID]'";
			ExecuteQuery($sql,$con);
		}
		else{
			$stylename=$_POST['StyleName'];
			$sVal=GetFieldValue("Select * from tblStyles WHERE StyleName='$stylename'","StyleName",$con);
		 
		 
			if ($sVal!=''){
				?>
			<script language="javascript">
				alert("The stylename is already exists!Please check!");
				window.location = "addnew_style.php";
			</script>
			<?php
			}
			else{
			$sql="INSERT INTO tblstyles (StyleName,Color,FontColor,InLine,ctrlKey,Shftkey,KeyVal) VALUES ('$_POST[StyleName]','$_POST[Color]','$_POST[FontColor]','$InLine','$ctrlKey','$Shftkey','$_POST[KeyVal]')";
			ExecuteQuery($sql,$con);
			}
		}
	}

	
	$prTExt="body\r\n{\r\nfont-family: Arial, Verdana, sans-serif;\r\nfont-size: 12px;\r\ncolor: #222;\r\nbackground-color: #fff;\r\n}\r\n";
	
	
	$sql="SELECT * FROM tblStyles";
	 
	if ($result=mysqli_query($con,$sql))
	  {
	  // Fetch one and one row
	  while ($row=mysqli_fetch_row($result))
		{
			$StyleName=$row[1];
			$Color=$row[2];
			$FontColor=$row[3];
			$Inline=$row[4];
			if ($Inline==1){
				$prTExt=$prTExt."span.".$StyleName." { background-color:".$Color."; color: ".$FontColor.";}\r\n";
			}
			else{
				$prTExt=$prTExt."div.".$StyleName." {  background-color:".$Color.";border-style:solid; border-color:".$Color."; color: ".$FontColor.";}\r\n";

			 
			}
			
			 
		}
	  }
	
	$prTExt=$prTExt."span.ATC { text-decoration: underline;text-decoration-color: red; text-decoration-style: wavy;}";
	file_put_contents("bower_components/ckeditor/stylesheetparser.css", $prTExt);
	
	
?>
  <script language="javascript">
	 
			window.location = "Editor_Settings.php";
		</script>

  