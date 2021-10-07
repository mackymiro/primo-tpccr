<?php
    session_start();
   //echo "<pre>";
   //print_r($_POST);
   //echo "</pre>";
   require_once "conn.php";

   $getUrl = $_POST['getUrl'];

   foreach($_POST['data'] as $id => $value){
       // echo $id. '<br />';
        $ids =  $id;
      
        $data1 = isset($value['data']) ? $value['data'] : '';
        $pages = isset($value['pages']) ? $value['pages'] : '';
        $numberOfPages = isset($value['numberOfPages']) ? $value['numberOfPages'] : '';
        $productType =  $value['productType'];

        $subCat1 = isset($value['subCat1']) ? $value['subCat1'] : '';
        $subCat2 = isset($value['subCat2']) ? $value['subCat2'] : '';
        $subCat3 = isset($value['subCat3']) ? $value['subCat3'] : '';

        $subCategory = "";
        if($subCat1 == "0" && $subCat2 == "0" && $subCat3 == "0"){
            $subCategory= 0;
        }else{
           if($productType == "6"){
               if($subCat1 != "0"){
                    $subCategory = $subCat1;
                  
               }
           }
          
           if($productType == "7"){
               if($subCat2 != "0"){
                    $subCategory = $subCat2;
                  
               }
           }
     
           if($productType == "15"){
               if($subCat3 != "0"){
                    $subCategory = $subCat3;
                   
               }
           }
              
        }
        
        $initId =  isset($value['initId']) ? $value['initId'] : '';
        $tiContent =  isset($value['tiContent']) ? $value['tiContent'] : '';
        $nContent = isset($value['nContent']) ? $value['nContent'] : '';
        $date = isset($value['date']) ? $value['date'] : '';
        $finalFileName =  isset($value['finalFileName']) ? $value['finalFileName'] : '';
        $graphicsFileName =  isset($value['graphicsFileName']) ? $value['graphicsFileName'] : '';
        $inlineCode =  isset($value['inlineCode']) ? $value['inlineCode'] : '';
        $processType = isset($value['processType']) ? $value['processType'] : '';
        $withTIFF = isset($value['withTiff']) ? $value['withTiff'] : '';
        $withImageEdit =  isset($value['withImageEdit']) ? $value['withImageEdit'] : '';
        $wuthDocSegregate =  isset($value['withDocSegregate']) ? $value['withDocSegregate'] : '';
        $fileType =  isset($value['fileType']) ? $value['fileType'] : '';
       //$byteSize =  $value['byteSize'];
        //$jobName  = $value['jobName'];
        //$jobId =  $value['jobId'];
        //$priorityNo =  $value['priorityNo'];

        if($productType != "Inventory"){
            $sqlUpdate = "UPDATE TPCCR_INVENTORY SET 
            Data='$data1',
            Pages='$pages',      
            NumberOfPages='$numberOfPages',
            ProductType='$productType',
            sub_category='$subCategory',
            INITID='$initId',
            TI_content='$tiContent',
            N_content='$nContent',
            Date='$date',
            FinalFilename='$finalFileName',
            GraphicsFilename='$graphicsFileName',
            InlineCode='$inlineCode',
            ProcessType='$processType',
            WithTIFF='$withTIFF',
            WithImageEdit='$withImageEdit',
            WithDocSegregate='$wuthDocSegregate',
            FileType='$fileType'
            WHERE Id='$ids'";
            $res = ExecuteQuerySQLSERVER($sqlUpdate,$conWMS);
        }

   }

   $_SESSION['updateInventory'] = "Update successfully added.";

?>

<img src="images/Loader.gif" style="width:230px; height:200px;" />

<script language="javascript">
    window.location = "viewInventory.php?path=<?= $getUrl; ?>";
</script>