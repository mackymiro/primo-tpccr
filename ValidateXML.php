<?php
error_reporting(0);
//var_dump($_SERVER);
session_start();
$post_data = $_POST['data'];
$fileVal=$_POST['filename'];

 
if (!empty($post_data)) {
    $dir = 'uploadfiles';
    // $file= explode('.',$sFileVal[1]);
     $filename = pathinfo(basename($fileVal), PATHINFO_FILENAME);
    $nfile=$filename.".xml";
    $post_data= str_replace("\n","\r\n", $post_data);
    $post_data = trim($post_data);
    $dir = 'uploadfiles';
     
    file_put_contents($dir."/".$nfile, $post_data);
    
    //$cmd = "D:\\THUCL\\iChecker\\iChecker.exe C:\\xampp\\htdocs\\primoLN\\uploadfiles\\".$nfile;
    $cmd = "C:\\XAMPP\\htdocs\\tpccr\\iChecker\\iChecker.exe C:\\xampp\\htdocs\\tpccr\\uploadfiles\\".$nfile;
    
    exec($cmd, $out, $ret);
    if (file_exists("uploadfiles/LOGS/uploadfiles/logs/".$filename.".ERR")){
        $LogFile = file_get_contents("uploadfiles/LOGS/uploadfiles/logs/".$filename.".ERR"); 
        $nVal=1;
    	$sLog ="";
    	$cats = explode("\r\n", $LogFile);
    	$ctr =0;
    	foreach($cats as $keyword) {
    		if ($ctr>2){
    			$keyword = trim($keyword);
    		    if(trim($keyword)!=""){  
    				$Log= explode(" - ",$keyword);
    				if ($Log[0]!=''){
    					$lineNo = intval(trim($Log[0]));
    					$ColNo = intval(trim($Log[1]));
    					$ErrorType = trim($Log[2]);

    					$ErrorType= str_replace("<", "",$ErrorType);
    					$ErrorType= str_replace(">", "",$ErrorType);
    					$Description = trim($Log[3]);
    					$lenVal=strlen($Description);
    					// if ($ErrorType=='Error'){
    						$Color='red';
    					// }
    					// else{
    					// 	$Color='orange';
    					// }
    					if($ErrorType!=''){
    						$sLog = $sLog."<li><a href='#$nVal' class='myclass' onclick='jumpToLine($lineNo,$ColNo,$lenVal);'><i class='fa fa-circle text-$Color'></i>$ErrorType ($Description) </a></li>";
                            $nVal++;
    					}
    					
    				}

    			}

    		}
    	    

    		$ctr++;
    	}

     
    	// unlink("uploadfiles/LOGS/uploadfiles/logs/".$filename.".ERR");
    	// unlink($filename.".xml");
    }

        
     //$cmd = 'C:\\xampp\\htdocs\\primoTHUCL\\xmlparser\\parser\\XMLBatchParser.exe "C:\\xampp\\htdocs\\primoLN\\uploadfiles\\'.$nfile.'" "C:\xampp\htdocs\primoTHUCL\xmlparser\parser\schema\judicial.artifact.xsd" C:\\xampp\\htdocs\\primoLN\\uploadfiles\\'.$filename.'.log"';
    $cmd = 'C:\\xampp\\htdocs\\tpccr\\xmlparser\\parser\\XMLBatchParser.exe "C:\\xampp\\htdocs\\tpccr\\uploadfiles\\'.$nfile.'" "C:\xampp\htdocs\tpccr\xmlparser\parser\schema\judicial.artifact.xsd" C:\\xampp\\htdocs\\tpccr\\uploadfiles\\'.$filename.'.log"';
    //$cmd = __DIR__.'\xmlparser\\parser\\XMLBatchParser.exe' .__DIR__.'\tpccr\\uploadfiles\\'.$nfile.' '.__DIR__.'\xmlparser\parser\schema\judicial.artifact.xsd"" '.__DIR__.'\tpccr\\uploadfiles\\'.$filename.'.log"';


    exec($cmd, $out, $ret);

    $LogFile = file_get_contents("uploadfiles/".$filename.".log"); 

    // $sLog = $sLog.$LogFile;

    $cats = explode("\r\n", $LogFile);
    $ctr =0;
        
    foreach($cats as $keyword) {
        $keyword = trim($keyword);

        if(trim($keyword)!=""){  
            $Log= explode(". Line",$keyword);
            
            if ($Log[0]!=''){
                
                $ErrorType = trim($Log[0]);
                $lenVal=3;
                $ErrorType= str_replace("<", "",$ErrorType);
                $ErrorType= str_replace("<", "",$ErrorType);
                //$ErrorType= str_replace("C:\\xampp\\htdocs\\primoTHUCL\\uploadfiles\\".$nfile.":", "",$ErrorType);
                $ErrorType= str_replace(__DIR__."\uploadfiles\\".$nfile.":", "",$ErrorType);
                $A1 = explode(":",$ErrorType);

                $lineNo = intval(trim($A1[0]));
                $ColNo = intval(trim($A1[1]));
                
                $Color='red';
                
                if($ErrorType!=''){
                    $sLog = $sLog."<li><a href='#$nVal' class='myclass' onclick='jumpToLine($lineNo,$ColNo,$lenVal);'><i class='fa fa-circle text-$Color'></i>Parser:$ErrorType</a></li>";
                    $nVal++;
                }
                
            }

        }
    }

    unlink ("uploadfiles/".$filename.".log");

	echo $sLog;

}else{
	echo "No XML FILE";
}


function libxml_display_error($error){
    $return = "<br/>\n";
    switch ($error->level) {
        case LIBXML_ERR_WARNING:
            $return .= "<b>Warning $error->code</b>: ";
            break;
        case LIBXML_ERR_ERROR:
            $return .= "<b>Error $error->code</b>: ";
            break;
        case LIBXML_ERR_FATAL:
            $return .= "<b>Fatal Error $error->code</b>: ";
            break;
    }
    $return .= trim($error->message);
    if ($error->file) {
        // $return .=    " in <b>$error->file</b>";
    }
    $return .= " LINE NO $error->line---";

    return $return;
}

function libxml_display_errors() {
    $errors = libxml_get_errors();
    $sError ="";
    $sLog="";
    $nVal=1;
    foreach ($errors as $error) {
        // print libxml_display_error($error);
        $sError =  libxml_display_error($error);

        $Log= explode(" LINE NO",$sError);

        if ( $Log[0]!=''){
            $Description = $Log[0];
            // $Log= explode(" LINE NO",$sError);
            $A1= explode("--",$Log[1]);

            $lineNo = trim($A1[0]);
            $ColNo=10;
            
            $lenVal=10;
            $Color='Red';
            $ErrorType='Error';
            

            $sLog = $sLog."<li><a href='#p$nVal' class='myclass' onclick='jumpToLine($lineNo,$ColNo,$lenVal);'><i class='fa fa-circle text-$Color'></i>$ErrorType ($Description) </a></li>";
            $nVal++;
        }
        

    }
    return $sLog;
    libxml_clear_errors();
}



?>