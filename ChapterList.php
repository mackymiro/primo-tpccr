<?php
error_reporting(0);
set_time_limit(0);
session_start();

$dtFrom = $_GET['dtFrom'];
$dtTo = $_GET['dtTo'];
$Status = $_GET['Status'];


$rows=$_SESSION['rows']; 

if ($rows==''){
    $rows=100;
}

$_SESSION['rows']=$rows;
 
			
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>List of Chapters</title>
    <link rel="stylesheet" type="text/css" href="cssgrid/easyui.css">
    <link rel="stylesheet" type="text/css" href="cssgrid/icon.css">
    <link rel="stylesheet" type="text/css" href="cssgrid/demo.css">
    <script type="text/javascript" src="jsgrid/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="jsgrid/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="jsgrid/jquery.easyui.min.js"></script>
    
    <link href="cssgrid/modal1.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" type="image/x-icon" href="favicon.png" />
	
	<script type="text/javascript" src="jsgrid/datagrid-filter.js"></script>
    <script type="text/javascript">
        $(function(){
            var dg = $('#tt').datagrid({
            	url: 'datagrid2_getEContent.php?dtFrom=<?php echo $dtFrom;?>&dtTo=<?php echo $dtTo?>&Status=<?php echo $Status;?>', 
                pagination: true,
                remoteFilter: true,
                rownumbers: true
            });
            dg.datagrid('enableFilter', [{
                field:'tests',
                type:'textbox',
                options:{precision:1},
                op:['contains']
            },{
                field:'unitcost',
                type:'numberbox',
                options:{precision:1},
                op:['less','greater']
            }]);
        }); 
         </script>
    <script>
		function getSelected(){
			var row = $('#tt').datagrid('getSelected');		
			if (row){
				window.open("ViewAttachment.php?Path=Attachment/"+row.CtrlNo, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=500,width=400,height=400");	 
			}
		}

	</script>
	<script type="text/javascript">
	var c=document.cookie;
	document.cookie='size='+screen.height+';';
	</script>
         
</head>
<body>
<?php     
$height = $_COOKIE["size"]-550;
 
?>	
    <div style="margin:20px;"></div>
    <table id="tt" class="easyui-datagrid" style="width:100%;height:<?php echo $height;?>px"
     url="datagrid2_getEContent.php?dtFrom=<?php echo $dtFrom;?>&dtTo=<?php echo $dtTo?>&Status=<?php echo $Status;?>&Submit=Go"  
        title="Chapter list Report" 
        rownumbers="true" pagination="true"
        data-options="
                singleSelect:true,collapsible:true,
                remoteSort:false,nowrap:false, multiSort:true"
        pageList="[10,20,50,100,0]"
        pageSize="<?php echo $rows;?>"
        >  
    <thead>  
 

	<tr>  
            <th data-options="field:'BatchId',width:150,sortable:true">BatchID</th>
            <th data-options="field:'JobName',width:150,sortable:true">JobName</th>
            <th data-options="field:'Filename',width:150,sortable:true">Filename</th>
            <th data-options="field:'LastUpdate',width:150,sortable:true">Date Registered</th>
            <th data-options="field:'StatusString',width:150,align:'left',sortable:true">Status</th>
           
 
        </tr>  	
 
    </thead>  
    </table>
   <script>
    function formatPrice(val,row){
        return '<a style="color: <?php echo $color;?>"  target="_blank" href="E_ContentDetails.php?DiscrepancyID='+val+'&txtKeyword=<?php echo $_GET[txtKeyword];?>&dateRange=<?php echo $dateRange;?>&Status=<?php echo $Status;?>">'+val+'</a>';
    }
	</script>
	
	  
</body>
</html>