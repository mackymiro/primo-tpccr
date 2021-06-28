<?php
session_start();
//If directory doesnot exists create it.

$BookID= $_SESSION['login_user'];
$FileType= "PDF";
if (!is_dir("uploadfiles/$BookID")){
  mkdir("uploadfiles/$BookID"); 
}

if (!is_dir("uploadfiles/$BookID/$FileType")){
  mkdir("uploadfiles/$BookID/$FileType"); 
}

$output_dir = "uploadfiles/$BookID/$FileType/";

if(isset($_FILES["myfile"]))
{
	$ret = array();

	$error =$_FILES["myfile"]["error"];
   {
    
    	if(!is_array($_FILES["myfile"]['name'])) //single file
    	{
       	 	$fileName = $_FILES["myfile"]["name"];
       	 	move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir. $_FILES["myfile"]["name"]);
       	 	 //echo "<br> Error: ".$_FILES["myfile"]["error"];
       	 	 
	       	 	 $ret[$fileName]= $output_dir.$fileName;
             $info = pathinfo($output_dir.$fileName);
             $HTMLFilename = $output_dir.$info['filename'].".html";
             RunConversion($ret[$fileName],$HTMLFilename,$info['filename']);
    	}
    	else
    	{
    	    	$fileCount = count($_FILES["myfile"]['name']);
    		  for($i=0; $i < $fileCount; $i++)
    		  {
    		  	$fileName = $_FILES["myfile"]["name"][$i];
	       	 	 $ret[$fileName]= $output_dir.$fileName;
    		     move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName );

             $info = pathinfo($output_dir.$fileName);
             $HTMLFilename = $output_dir.$info['filename'].".html";
             RunConversion($ret[$fileName],$HTMLFilename,$info['filename']);
    		  }
    	
    	}
    }
    echo json_encode($ret);
 
}

function RunConversion($PDFFilename,$HTMLFilename,$Filename){
   


  $pdf_file = $Filename.".pdf";
  $html_dir = $Filename.".html";
  copy($PDFFilename,$pdf_file);

  $cmd = 'mutool convert -o "'.$html_dir.'" '.'"'.$pdf_file.'"';
  exec($cmd, $out, $ret);

  copy($html_dir, $HTMLFilename);

  $strHTML = file_get_contents($HTMLFilename);
  // file_put_contents("uploadfiles/".$BookID."/pdf/".$_SESSION['Filename']."_test.html", $strHTML);
  $sTag =  strip_tags($strHTML);

  $sTag= preg_replace('/[\w]+{[\w-:; ]+}/i', "", $sTag);
  $sTag = str_replace("\n", '', $sTag);  
  $sTag = str_replace("\r", '', $sTag);


  unlink($pdf_file);
  unlink ($html_dir);

  if ($sTag==''){
    unlink ($HTMLFilename);

    copy($PDFFilename,"OCR/Input/".$Filename.".pdf");
    $pdfFile =$Filename.".pdf";
    while(!file_exists($pdfFile));
    {
     
    }

    $output="D:\\XAMPP\\htdocs\\primoLicSplitter\\".$pdfFile;
    $pdf_file =  $Filename.".pdf";
    $html_dir =  $Filename.".html";

    $cmd = "mutool convert -o $html_dir $pdf_file";
    exec($cmd, $out, $ret);

    // $_SESSION['PageFrom']=1;
    // $_SESSION['PageTo']=1;
    // unlink($input);
    unlink($output);
    copy($html_dir, $HTMLFilename);
    unlink($html_dir);

    // echo file_get_contents("uploadfiles/".$BookID."/pdf/".$_SESSION['Filename'].".html");

    
  }
}

?>