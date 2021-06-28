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
            	url: 'datagrid4_getEContent.php?dtFrom=<?php echo $dtFrom;?>&dtTo=<?php echo $dtTo?>&Status=<?php echo $Status;?>&State=<?php echo $State?>', 
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
     url="datagrid4_getEContent.php?dtFrom=<?php echo $dtFrom;?>&dtTo=<?php echo $dtTo?>&Status=<?php echo $Status;?>&Submit=Go&State=<?php echo $State?>"  
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
        <th data-options="field:'ExecutionId',width:150,sortable:true">ExecutionID</th>
        <th data-options="field:'ConfigName',width:150,sortable:true">ConfigName</th>
        <th data-options="field:'MainURL',width:150,sortable:true">MainURL</th>
        <th data-options="field:'UserName',width:150,sortable:true">UserName</th>
         <th data-options="field:'MachineName',width:150,sortable:true">MachineName</th>
        <th data-options="field:'StartDate',width:150,sortable:true">StartDate</th>
        <th data-options="field:'EndDate',width:150,align:'left',sortable:true">EndDate</th>
        <th data-options="field:'LinkCount',width:150,align:'left',sortable:true">LinkCount</th>
        <th data-options="field:'NewCount',width:150,align:'left',sortable:true">NewCount</th>
        <th data-options="field:'ErrorMessage',width:150,align:'left',sortable:true">ErrorMessage</th>
 
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