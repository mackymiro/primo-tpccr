<?php
include "conn.php";

$sql="Select * from tblstyles ORDER BY StyleName";
 $sLog ="";
if ($result=mysqli_query($con,$sql))
  {
  // Fetch one and one row
  while ($row=mysqli_fetch_array($result))
	{
		$StyleName=$row['StyleName'];
		$Color=$row['Color'];
		$FontColor=$row['FontColor'];
		$Inline=$row['Inline'];
		if ($row['ctrlKey']==1){
			  $ctrl='CTRL';
		  }
		  else{
			  $ctrl='';
		  }
		
		
		 if ($row['Shftkey']==1){
			  $Shift='Shift';
		  }
		  else{
			  $Shift='';
		  }
			$keyVal=$row['KeyVal'];
			
			
			$ShortcutKey='';
			
			if ($ctrl!=''){
				$ShortcutKey=$ctrl;
			}
			
			if ($Shift!=''){
				if ($ctrl!=''){
				$ShortcutKey=$ShortcutKey.'+'.$Shift;
				}
				else{
					$ShortcutKey=$Shift;
				}
			}
			
			if ($keyVal!=''){
				if ($Shift!=''){
					if ($ctrl!=''){
					$ShortcutKey=$ctrl.'+'.$Shift.'+'.$keyVal;
					}
					else{
						$ShortcutKey=$Shift.'+'.$keyVal;
					}
				}
				else{
					if ($ctrl!=''){
						$ShortcutKey=$ctrl.'+'.$keyVal;
					}
				}
			}
			else{
				$ShortcutKey='';
			}

		// $sLog = $sLog."<p style='background-color:".$Color.";color:red;'><a href='#' onclick='StyleDoc(\"".$StyleName."\",\"".$Inline."\")'> ".$StyleName."</a></p>";

		if ($Inline==1){
			$sLog = $sLog."<p style='background-color:".$Color.";'><a href='#'style='color: ".$FontColor."' onclick='StyleDoc(\"".$StyleName."\",\"".$Inline."\")'> ".$StyleName."  <sub>".$ShortcutKey."</sub></a></p>";
		}
		else{
			$sLog = $sLog."<p style='background-color:".$Color.";border-style: solid;border-color:".$Color.";'><a href='#'style='color: ".$FontColor."' onclick='StyleDoc(\"".$StyleName."\",\"".$Inline."\")'> ".$StyleName."  <sub>".$ShortcutKey."</sub></a></p>";
		}

		  
		}
	}
  
echo $sLog;
?>