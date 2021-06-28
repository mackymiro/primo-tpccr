<?php
	$sql="SELECT * FROM tblUserAccess Where UserID=' $_SESSION[UserID]'";
 
if ($result=mysqli_query($con,$sql))
{
// Fetch one and one row
	while ($row=mysqli_fetch_row($result))
	{
		$ACQUIRE=$row[1];
		$ENRICH=$row[2];
		$DELIVER=$row[3];
		$USER_MAINTENANCE=$row[4];
		$EDITOR_SETTINGS=$row[5];
		$ML_SETTINGS=$row[6];
		$TRANSFORMATION=$row[7];
		$TRANSMISSION=$row[8];
		$AQUISITIONREPORT=$row[9];
		$CONFIDENCELEVELREPORT=$row[10];
		$TASKSETTING=$row[11];
	}
}
?>
 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['EName'];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
    
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">STAGE</li>
		<?php 
		if ($ACQUIRE==1){
			
		?>
		
		<li class="active treeview menu-open">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>ACQUIRE</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
		  <?php
		  $sqlInfo = "SELECT  COUNT(DISTINCT ConfigName)  AS LinkCount FROM  SN_Executions";
		
	$rsInfo = odbc_exec($conSearchnet,$sqlInfo);	
	$LinkCount = odbc_result($rsInfo,"LinkCount");
	
	
	  $sqlInfo1 = "SELECT TOP (1) ExecutionId, InstanceName, ConfigPath, ConfigName, MainURL, UserName, MachineName, StartDate, EndDate, LinkCount, NewCount, ErrorMessage FROM SN_Executions ORDER BY ExecutionId DESC";
		
	$rsInfo = odbc_exec($conSearchnet,$sqlInfo1);	
	$ExecutionID=odbc_result($rsInfo,"ExecutionId");
	$LastRun = odbc_result($rsInfo,"LinkCount");
	$ConfigName= odbc_result($rsInfo,"ConfigName");
	$sqlInfo1 = "SELECT Count(RefID) as TotalCount From  PRIMO_Integration WHERE ExecutionID='$ExecutionID'";
		
	$rsInfo = odbc_exec($conWMS,$sqlInfo1);	
	
	
	$NewCount = odbc_result($rsInfo,"TotalCount");
	
		  ?>
          <ul class="treeview-menu">
            <li class="active"><a href="SitesMonitored.php"><i class="fa fa-circle-o"></i> Sites monitored <small class="label pull-right bg-blue"><?php echo $LinkCount;?></small></a></li>
            <li class="active"><a href="LastRun.php"><i class="fa fa-circle-o"></i> Last run <small class="label pull-right bg-red"><?php echo $LastRun;?></small></a> </li>
			 <li class="active"><a href="NewContent.php"><i class="fa fa-circle-o"></i>New content <small class="label pull-right bg-green"><?php echo $NewCount;?></small></a></li>
          </ul>
        </li>
		<?php
		}
		?>
		<?php 
		if ($ENRICH==1){
			
		?>
		<li class="treeview">
          <a href="#" <?php echo $ENRICH;?>>
            <i class="fa fa-spinner"></i> <span>ENRICH</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <?php
				if ($_SESSION['UserType']=='Admin'){
					$sql="SELECT * FROM primo_view_Jobs Where ProcessCode='STYLING'";	
				}
				else{
					$sql="SELECT * FROM primo_view_Jobs Where ProcessCode='STYLING' AND statusstring in('Allocated','Pending','Ongoing')  AND AssignedTo='$_SESSION[login_user]'";	
				}
			 
				$rs=odbc_exec($conWMS,$sql);
				$ctr = odbc_num_rows($rs);
			 ?>
            <li class="treeview">
              <a href="#"><i class="fa fa-book"></i> Styling
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
				  <span class="label label-primary pull-right"><?php echo $ctr;?></span>
                </span>
              </a>
              <ul class="treeview-menu">
				
				  <?php
					if ($_SESSION['UserType']=='Admin'){
						echo "<li><a href=ListofDocument.php?Task=STYLING>".'<i class="fa fa-list-alt"></i>View List of Document</a></li>';
					}
					else{

						
						if ($ctr==0){
							echo "<li><a href=GetNextBatch.php?Task=STYLING>".'<i class="fa  fa-hand-grab-o"></i>Get Next Batch</a></li>';
						}
						
						
						while(odbc_fetch_row($rs))
						{
							$filename="uploadFiles/".odbc_result($rs,"Filename");;
						 
							echo "<li><a href=index.php?file=".$filename."&BatchID=".odbc_result($rs,"BatchID")."&Task=Styling>".'<i class="fa fa-file-pdf-o"></i>'.odbc_result($rs,"JObname")."</a></li>";
						}
					}
					?>
              </ul>
            </li>
			 <?php
				if ($_SESSION['UserType']=='Admin'){
					$sql="SELECT * FROM primo_view_Jobs Where ProcessCode='TEXTCAT'";	
				}
				else{
					$sql="SELECT * FROM primo_view_Jobs Where ProcessCode='TEXTCAT' AND statusstring in('Allocated','Pending','Ongoing')  AND AssignedTo='$_SESSION[login_user]'";	
				}
			 
				$rs=odbc_exec($conWMS,$sql);
				$ctr = odbc_num_rows($rs);
			 ?>
            <li class="treeview">
              <a href="#"><i class="fa fa-book"></i> Text Categorization
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
				  <span class="label label-primary pull-right"><?php echo $ctr;?></span>
                </span>
              </a>
              <ul class="treeview-menu">
				
				  <?php
					if ($_SESSION['UserType']=='Admin'){
						echo "<li><a href=ListofDocument.php?Task=TEXTCAT>".'<i class="fa fa-list-alt"></i>View List of Document</a></li>';
					}
					else{

						
						if ($ctr==0){
							echo "<li><a href=GetNextBatch.php?Task=TEXTCAT>".'<i class="fa  fa-hand-grab-o"></i>Get Next Batch</a></li>';
						}
						
						
						while(odbc_fetch_row($rs))
						{
							$filename="uploadFiles/".odbc_result($rs,"Filename");;
						 
							echo "<li><a href=index.php?file=".$filename."&BatchID=".odbc_result($rs,"BatchID")."&Task=TEXTCAT>".'<i class="fa fa-file-pdf-o"></i>'.odbc_result($rs,"JObname")."</a></li>";
						}
					}
					?>
              </ul>
            </li>
	 <?php
				if ($_SESSION['UserType']=='Admin'){
					$sql="SELECT * FROM primo_view_Jobs Where ProcessCode='ENRICHMENT' AND statusstring ='DONE' AND JOBNAME NOT IN (SELECT  JObname FROM primo_view_Jobs Where ProcessCode='TRANSMISSION' AND statusstring ='DONE' )";	
				}
				else{
					$sql="SELECT * FROM primo_view_Jobs Where ProcessCode='ENRICHMENT' AND statusstring ='DONE' AND AssignedTo='$_SESSION[login_user]' AND JOBNAME NOT IN (SELECT  JObname FROM primo_view_Jobs Where ProcessCode='TRANSMISSION' AND statusstring ='DONE' )";	
				}
			 
				 
					$rs=odbc_exec($conWMS,$sql);
					$ctr = odbc_num_rows($rs);
			 ?>	
             <li class="treeview">
              <a href="#"><i class="fa fa-book"></i> Completed
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
				  <span class="label label-primary pull-right bg-green"><?php echo $ctr;?></span>
                </span>
              </a>
              <ul class="treeview-menu">
				
				  <?php
					 
						echo "<li><a href=ListofCompleted.php>".'<i class="fa fa-list-alt"></i>View List of Completed</a></li>';
					 
					?>
              </ul>
            </li>
          </ul>
        </li>
		<?php
		}
		?>
		<?php 
		if ($DELIVER==1){
			
	 
				if ($_SESSION['UserType']=='Admin'){
					$sql="SELECT * FROM primo_view_Jobs Where ProcessCode='TRANSMISSION' AND statusstring ='DONE' ";	
				}
				else{
					$sql="SELECT * FROM primo_view_Jobs Where ProcessCode='TRANSMISSION' AND statusstring ='DONE' AND AssignedTo='$_SESSION[login_user]'";	
				}
			 
				 
				$rs=odbc_exec($conWMS,$sql);
				$ctr = odbc_num_rows($rs);
			 ?>	
		<li class="treeview">
          <a href="#">
            <i class="fa fa-envelope"></i> <span>DELIVER</span> <span class="label label-primary pull-right bg-green"><?php echo $ctr;?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
           <ul class="treeview-menu">
				
				  <?php
						echo "<li><a href=ListofDeliver.php>".'<i class="fa fa-list-alt"></i>View List</a></li>';
					?>
              </ul>
        </li>
		
		<?php
		}
		?>
		
	 <li class="header">SETTINGS</li>
	 <?php 
		if ($USER_MAINTENANCE==1){
			
		?>
		<li class="treeview">
          <a href="#">
             <i class="fa fa-user"></i>
            <span>User Maintenance</span>
            
          </a>
          <ul class="treeview-menu">
            <li><a href="UserList.php"><i class="fa fa-user-plus"></i> User List</a></li>
          </ul>
        </li>
		<?php
		}
		?>
		 <?php 
		if ($EDITOR_SETTINGS==1){
			
		?>
        <li class="treeview">
          <a href="#">
             <i class="fa fa-edit"></i>
            <span>Editor Settings</span>
            
          </a>
          <ul class="treeview-menu">
            <li><a href="Editor_Settings.php"><i class="fa fa-cog"></i> Configure</a></li>
          </ul>
        </li>
		<?php
		}
		?>
		 <?php 
		if ($ML_SETTINGS==1){
			
		?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>ML Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
		   <li><a href="MLConfig.php"><i class="fa fa-cog"></i> Configure</a></li>
             	<?php
			$sql="SELECT * FROM tblmlconfig";
				if ($result=mysqli_query($con,$sql))
  {
  // Fetch one and one row
  while ($row=mysqli_fetch_row($result))
    {
?>
            <li><a href="<?php echo $row[2];?>?FileURL=../uploadFiles/<?php echo $sFileVal[1];?>&FileName=<?php echo $sFileVal[1];?>&RedirectURL=https://10.160.0.75/primo/index.php&ID=<?php echo $row[0];?>"><i class="fa fa-gears"></i> <?php echo $row[1];?></a></li>          
             <?php
	}
}
?>	   
            
          </ul>
        </li>
		<?php
		}
		?>
		<?php 
		if ($TRANSFORMATION==1){
			
		?>
        <li class="treeview">
          <a href="#">
             <i class="fa fa-star-half-o"></i>
            <span>Transformation Settings</span>
            
          </a>
          <ul class="treeview-menu">
            <li><a href="TransformationSettings.php"><i class="fa fa-cog"></i> Configure</a></li>
          </ul>
        </li>
		<?php
		}
		?>
		<?php 
		if ($TRANSMISSION==1){
			
		?>
        <li class="treeview">
          <a href="#">
             <i class="fa f fa-rocket"></i>
            <span>Transmission Settings</span>
            
          </a>
          <ul class="treeview-menu">
            <li><a href="TransmissionSettings.php"><i class="fa fa-cog"></i> Configure</a></li>
          </ul>
        </li>
		<?php
		}
		?>
		<?php 
		if ($TASKSETTING==1){
			
		?>
        <li class="treeview">
          <a href="#">
             <i class="fa f fa-tasks"></i>
            <span>Task Settings</span>
            
          </a>
          <ul class="treeview-menu">
            <li><a href="TaskSettings.php"><i class="fa fa-cog"></i> Configure</a></li>
          </ul>
        </li>
		<?php
		}
		?>
		
		<li class="header">REPORT</li>
		<?php 
		if ($AQUISITIONREPORT==1){
			
		?>
		<li class="treeview">
          <a href="Acquisition Report">
             <i class="fa  fa-dashboard"></i>
            <span>Acquisition Report</span>
            
          </a>
          <ul class="treeview-menu">
            <li><a href="AcquisitionReport.php"><i class="fa  fa-bar-chart"></i> View</a></li>
          </ul>
        </li>
		<?php
		}
		?>
		  <?php 
		if ($CONFIDENCELEVELREPORT==1){
			
		?>
		<li class="treeview">
          <a href="ConfidenceLevelReport">
             <i class="fa  fa-dashboard"></i>
            <span>Confidence Level Report</span>
            
          </a>
          <ul class="treeview-menu">
            <li><a href="ConfidenceLevelReport.php"><i class="fa  fa-bar-chart"></i> View</a></li>
          </ul>
        </li>
		<?php
		}
		?>
		
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>