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
        $data1 = $value['data'];
        $pages =  $value['pages'];
        $numberOfPages = $value['numberOfPages'];
        $productType =  $value['productType'];

       
        $initId =  $value['initId'];
        $tiContent =  $value['tiContent'];
        $nContent = $value['nContent'];
        $date = $value['date'];
        $finalFileName =  $value['finalFileName'];
        $graphicsFileName =  $value['graphicsFileName'];
        $inlineCode =  $value['inlineCode'];
        $processType = $value['processType'];
        $withTIFF = $value['withTiff'];
        $withImageEdit =  $value['withImageEdit'];
        $wuthDocSegregate =  $value['withDocSegregate'];
        $fileType =  $value['fileType'];
        $byteSize =  $value['byteSize'];
        $jobName  = $value['jobName'];
        $jobId =  $value['jobId'];
        $priorityNo =  $value['priorityNo'];


        $sqlUpdate = "UPDATE TPCCR_INVENTORY SET 
                Data='$data1',
                Pages='$pages',      
                NumberOfPages='$numberOfPages',
                ProductType='$productType',
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
                FileType='$fileType',
                ByteSize='$byteSize',
                Jobname='$jobName',
                JobId='$jobId',
                PriorityNo='$priorityNo'
                WHERE Id='$ids'";
        $res = ExecuteQuerySQLSERVER($sqlUpdate,$conWMS);

   }

   $_SESSION['updateInventory'] = "Update successfully added.";

?>

<img src="images/Loader.gif" style="width:230px; height:200px;" />

<script language="javascript">
    window.location = "inventory.php?path=<?= $getUrl; ?>";
</script>