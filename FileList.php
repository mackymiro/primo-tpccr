<?php
error_reporting(0);
set_time_limit(0);
session_start();

$dtFrom = $_GET['dtFrom'];
$dtTo = $_GET['dtTo'];
$Status = $_GET['Status'];
$State = $_GET['State'];


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
            	url: 'datagrid3_getEContent.php?dtFrom=<?= $dtFrom;?>&dtTo=<?= $dtTo?>&Status=<?= $Status;?>&State=<?= $State?>', 
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
$height = $_COOKIE["size"];
 
?>	
    <div style="margin:20px;"></div>
    <table id="tt" class="easyui-datagrid" style="width:100%;height:500vh"
     url="datagrid3_getEContent.php?dtFrom=<?= $dtFrom;?>&dtTo=<?= $dtTo?>&Status=<?= $Status;?>&Submit=Go&State=<?= $State?>"  
        title="Batch list Report" 
        rownumbers="true" pagination="true"
        data-options="
                singleSelect:true,collapsible:true,
                remoteSort:false,nowrap:false, multiSort:true"
        pageList="[10,20,50,100,0]"
        pageSize="<?php echo $rows;?>"
        >  
    <thead>  
	<tr>  
        <th data-options="field:'JobName',width:150,sortable:true">JobName</th>
        <th data-options="field:'SourceURL',width:150,sortable:true">Source URL</th>
        <th data-options="field:'Title',width:150,sortable:true">Title</th>
         <th data-options="field:'Filename',width:150,sortable:true">Filename</th>
         <th data-options="field:'Relevancy',width:150,sortable:true">Category</th>
        <th data-options="field:'StatusString',width:150,sortable:true">Status</th>
        <th data-options="field:'Jurisdiction',width:150,align:'left',sortable:true">Jurisdiction</th>
        <th data-options="field:'DateRegistered',width:150,align:'left',sortable:true">Date Registered</th>
 
    </tr>  	
 
    </thead>  
    </table>



    <a href="ExportToexcel2.php" onclick="return theFunction();" target="_blank">Export To Excel</a>
   <script>
    function formatPrice(val,row){
        return '<a style="color: <?= $color;?>"  target="_blank" href="E_ContentDetails.php?DiscrepancyID='+val+'&txtKeyword=<?= $_GET[txtKeyword];?>&dateRange=<?= $dateRange;?>&Status=<?= $Status;?>">'+val+'</a>';
    }
	</script>
	
	  
</body>
</html>