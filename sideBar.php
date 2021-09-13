<?php
error_reporting(0);
$sql="SELECT * FROM tblUserAccess Where UserID='$_SESSION[UserID]'";
  
if ($result=mysqli_query($con,$sql))
{
// Fetch one and one row
	while ($row=mysqli_fetch_array($result))
	{
		$ACQUIRE=$row["ACQUIRE"];
		$ENRICH=$row["ENRICH"];
		$DELIVER=$row["DELIVER"];
		$USER_MAINTENANCE=$row["USER_MAINTENANCE"];
		$EDITOR_SETTINGS=$row["EDITOR_SETTINGS"];
		$ML_SETTINGS=$row["ML_SETTINGS"];
		$TRANSFORMATION=$row["TRANSFORMATION"];
		$TRANSMISSION=$row["TRANSMISSION"];
		$AQUISITIONREPORT=$row["AQUISITIONREPORT"];
		$CONFIDENCELEVELREPORT=$row["ConfidenceLevelReport"];
		$TASKSETTING=$row["TaskSetting"];
		$DATAENTRYSETTING=$row["DataEntrySetting"];
		$REPORTMANAGEMENT=$row["REPORTMANAGEMENT"];
		$PROJECTSETUP=$row["PROJECTSETUP"];
	}
}

$page=$_GET['page'];
if ($page==''){
	$page=$_SESSION['page'];
}
$_SESSION['page']=$page;

if ($page=='Acquire'){
	$ACQUIREpage='active treeview menu-open';
	$ENRICHpage='treeview';

}
elseif($page=='Enrich'){
	$ENRICHpage='active treeview menu-open';
	$ACQUIREpage='treeview';
}
else{
	$ACQUIREpage='active treeview menu-open';
	$ENRICHpage='treeview';
}

$Task=$_GET['Task'];
	if ($Task==''){
		$Task=$_SESSION['Task'];
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
		
		<li class="<?php echo $ACQUIREpage;?>">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>ACQUIRE</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

		  <?php
				$sqlInfo1 = "SELECT Count(RefID) as TotalCount From view_Collections ";
				//WHERE Isnull(IntegrationID,'')=''
					
				$rsInfo = odbc_exec($conWMS,$sqlInfo1);	
				$ColCount = odbc_result($rsInfo,"TotalCount");


				$sqlInfo1 = "SELECT Count(JobID) as TotalCount From primo_view_Jobs WHERE StatusString='NEW' and ProcessCode='Styling'";
					
				$rsInfo = odbc_exec($conWMS,$sqlInfo1);	
				$NewCount = odbc_result($rsInfo,"TotalCount");
				

				$sqlInfo2 = "SELECT Count(BatchID) as TotalCount From primo_view_NotRelevant";
					
				$rsInfo = odbc_exec($conWMS,$sqlInfo2);	
				$NewCount1 = odbc_result($rsInfo,"TotalCount");
	
		  ?>
          <ul class="treeview-menu">
          	<!--<li class="active"><a href="AcquisitionReport.php?page=Acquire"><i class="fa fa-circle-o"></i>Collection Summary<small class="label pull-right bg-blue"></small></a></li>-->
          	 <!-- <li class="active"><a href="Collections.php?page=Acquire"><i class="fa fa-circle-o"></i>Collections <small class="label pull-right bg-blue"><?php echo $ColCount;?></small></a></li> -->
          	<!-- <li class="active"><a href="Prioritization.php"><i class="fa fa-circle-o"></i>Prioritization <small class="label pull-right bg-blue"></small></a></li>-->
             <!-- <li class="active"><a href="NewContent.php?page=Acquire"><i class="fa fa-circle-o"></i>New content <small class="label pull-right bg-green"><?php echo $NewCount;?></small></a></li>
              <li class="active"><a href="NotRelevant.php?page=Acquire"><i class="fa fa-question"></i>Not Relevant<small class="label pull-right bg-green"><?php echo $NewCount1;?></small></a></li>-->
              <li class="active"><a href="receiving.php"><i class="fa fa-file"></i>Receiving</a></li>
			  <li class="active"><a href="ftpfile.php"><i class="fa fa-file"></i>FTP file</a></li>
			  <!--<li class="active"><a href="downloading.php"><i class="fa fa-file"></i>Downloaded</a></li>-->
			  <li class="active"><a href="inventory.php"><i class="fa fa-file"></i>Inventory</a> </li>
			  <li class="active"><a href="forSegration.php"><i class="fa fa-file"></i>For Segration files </a></li>
			  <li class="active"><a href="forPostingfile.php"><i class="fa fa-file"></i>For Posting files </a></li>
			  
			   </li>
			 
			  <li class="active"><a href="Registration.php?page=Acquire"><i class="fa fa-file"></i>Registration</a></li> 
          </ul>
        </li>
		<?php
		}
		?>
		<?php 
		if ($ENRICH==1){
			
		?>

	
		<li class="<?php echo $ENRICHpage;?>">
          <a href="#" <?php echo $ENRICH;?>>
            <i class="fa fa-spinner"></i> <span>ENRICH</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
		  
		  <?php
		  $sql="SELECT ProcessCode FROM tbltaskeditorsetting INNER JOIN tblusertask on tblusertask.TaskID=tbltaskeditorsetting.TaskID Where tblusertask.UserID='$_SESSION[UserID]' AND MenuGroup='ENRICH'";
 
			if ($result=mysqli_query($con,$sql))
			{
			// Fetch one and one row
				$lCode="";
				while ($row=mysqli_fetch_row($result))
				{
					$ProcessCode=$row[0];
					
					if ($_SESSION['UserType']=='Admin'){
						if ($lCode==""){
							$sql="SELECT * FROM primo_view_Jobs Where ProcessCode='$ProcessCode' and statusstring<>'Done'";	
								
						}
						else{
							$sql="SELECT * FROM primo_view_Jobs Where ProcessCode='$ProcessCode' and Jobname IN (Select Jobname from primo_view_Jobs Where ProcessCode='$lCode' and statusstring='Done')";			
						}
						
					}
					else{
						$sql="SELECT * FROM primo_view_Jobs Where ProcessCode='$ProcessCode' AND statusstring in('Allocated','Pending','Ongoing')  AND AssignedTo='$_SESSION[login_user]'";	
					}
				 
					$rs=odbc_exec($conWMS,$sql);
					$ctr = odbc_num_rows($rs);
				

				  if ($Task==$ProcessCode){
				  	$pageActive='active treeview menu-open';
					$pagestatus='active';
				  }
				  else{
				  	$pagestatus='';
				  	$pageActive='treeview';
				   
				  }
				
				$ProcessDesc=GetWMSValue("Select Description from wms_Processes Where ProcessCode='".$ProcessCode."'","Description",$conWMS);
					
			?>

			<?php 
				$processCodeAllow = [
					'ContentStructure',
					'CropImageEdit',
					'Validation'
				];
			?>
			
			<?php if(in_array($ProcessCode, $processCodeAllow)) :  ?>
			<li class="<?=$pageActive;?>">
              <a href="#"><i class="fa fa-book"></i><?= $ProcessDesc;?>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
				  <span class="label label-primary pull-right"><?= $ctr;?></span>
                </span>
              </a>
              <ul class="treeview-menu">
				 <?php 

					if ($_SESSION['UserType']=='Admin'){
						echo "<li class='$pagestatus'><a href=ListofDocument.php?page=Enrich&Task=$ProcessCode&lTask=$lCode>".'<i class="fa fa-list-alt"></i>View List of Document</a></li>';
					}
					else{
						if ($ctr == 0){
							echo "<li class='$pagestatus'><a href='GetNextBatch.php?page=Enrich&Task=$ProcessCode'>".'<i class="fa  fa-hand-grab-o"></i>Get Next Batch</a></li>';
						}
						
						
						while(odbc_fetch_row($rs))
						{
							//$filename="uploadFiles/".odbc_result($rs,"Filename");;
							$filename="uploadfiles/".odbc_result($rs,"Filename");
							
							echo "<li  class='$pagestatus'><a href='index.php?page=Enrich&file=".$filename."&BatchID=".odbc_result($rs,"BatchId")."&Task=$ProcessCode'>".'<i class="fa fa-file-pdf-o"></i>'.odbc_result($rs,"JobName")."</a></li>";
						}
					}
					?>
              </ul>
            </li>
			<?php endif; ?>
			<?php
				  $lCode=$ProcessCode;	 
				}
				
				
			}
			?>
		  
             <?php
				 
				if ($_SESSION['UserType']=='Admin'){
						$sql="SELECT   * FROM primo_view_jobs Where ProcessCode='STYLING' AND statusstring='DONE' and status<>'Transmitted'";	
				 
			 	
				}
				else{
						$sql="SELECT   * FROM primo_view_jobs Where ProcessCode='STYLING' AND statusstring='DONE' and status<>'Transmitted' AND AssignedTo='$_SESSION[login_user]'";	
				 
			  
				}
				 
			 
				 
					$rs=odbc_exec($conWMS,$sql);
					$ctr = odbc_num_rows($rs);
					$ctr=0;
					 $Jobname='';
				while ($row = odbc_fetch_array($rs)) 
				{

					//$objResult=odbc_fetch_array($objExec,$i);   
				 
						$ctr++;
					 
					 
				}
					
					
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
					 
						echo "<li><a href=ListofCompleted.php?page=$ProcessCode>".'<i class="fa fa-list-alt"></i>View List of Completed</a></li>';
					 
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
						$sql="SELECT   * FROM primo_view_Record Where JobStatus='Submitted'";	
				 
			 	
				}
				else{
						$sql="SELECT   * FROM primo_view_Record Where JobStatus='Submitted' AND AssignedTo='$_SESSION[login_user]'";	
				 
			  
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


		if ($USER_MAINTENANCE==1 || $EDITOR_SETTINGS==1 || $ML_SETTINGS==1 || $TRANSFORMATION==1 || $TRANSMISSION==1 || $TASKSETTING==1 || $REPORTMANAGEMENT==1  || $PROJECTSETUP==1){
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
		if ($PROJECTSETUP==1){
			
		?>
        <li class="treeview">
          <a href="#">
             <i class="fa f fa-tasks"></i>
            <span>Project Setup</span>
            
          </a>
          <ul class="treeview-menu">
            <li><a href="ProjectSetup.php"><i class="fa fa-cog"></i> Configure</a></li>
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
		if($DATAENTRYSETTING==1){
			?>
 		<li class="treeview">
          <a href="#">
             <i class="fa f   fa-table"></i>
            <span>Data Entry Settings</span>
            
          </a>
          <ul class="treeview-menu">
            <li><a href="DataEntrySettings.php"><i class="fa fa-cog"></i> Configure</a></li>
          </ul>
        	</li>
			<?php
		}

		?>
 <?php 
		if ($REPORTMANAGEMENT==1){
			
		?>
        <li class="treeview">
          <a href="#">
             <i class="fa f fa-tasks"></i>
            <span>Report Management</span>
            
          </a>
          <ul class="treeview-menu">
            <li><a href="ReportManagement.php"><i class="fa fa-cog"></i> Configure</a></li>
          </ul>
        </li>
		<?php
		}

	

}

		$strSQL="SELECT * From tblreport INNER JOIN tbluserreport on tblreport.ReportID=tbluserreport.ReportID WHERE UserID='$_SESSION[UserID]'";

		if ($result=mysqli_query($con,$strSQL))
		{

		$count = mysqli_num_rows($result);

			if ($count!=0){
		?>
		
		<li class="header">REPORTS</li>
		 
		<li class="treeview">
          <a href="#">
             <i class="fa  fa-dashboard"></i>
            <span>Reports</span>
            
          </a>
          <ul class="treeview-menu">
          	<?php
					$strSQL="SELECT * From tblreport INNER JOIN tbluserreport on tblreport.ReportID=tbluserreport.ReportID WHERE UserID='$_SESSION[UserID]'";

					if ($result=mysqli_query($con,$strSQL))
					{
					// Fetch one and one row
					while ($row=mysqli_fetch_row($result))
					{
						$ReportName=$row[1];
						$ReportID=$row[0];
						 	$ReportSource=$row[3];
           
						if (strpos($ReportSource,"https://app.powerbi.com")!==0){
							?>
							<li><a href="<?php echo $ReportSource;?>"><i class="fa  fa-bar-chart"></i> <?php echo $ReportName;?></a></li>
							<?php
						}
						else{
							?>
							  <li><a href="PBIReport.php?ReportID=<?php echo $ReportID;?>"><i class="fa  fa-bar-chart"></i> <?php echo $ReportName;?></a></li>
							<?php
						}

		        }
		    }
            ?>
          </ul>
        </li>
		  <?php
	       }  
	    }
        ?>

    <!--   <li class="header">REFERENCES</li>
		 
		<li class="treeview">
          <a href="#">
             <i class="fa  fa-dashboard"></i>
            <span>LEGISLATION MONITORING</span>
            
          </a>
          <ul class="treeview-menu">
           
				<li><a href="Legislation Monitoring/Evaluating Relevance of Legislation.htm" target="_blank"><i class="fa  fa-book"></i> Relevance of Legislation</a></li>
				<li><a href="Legislation Monitoring/Jurisdiction Sources 10.03.2020_final.htm" target="_blank"><i class="fa  fa-book"></i> Jurisdiction Source</a></li>
				<li><a href="Legislation Monitoring/Copy of Legislation up to V60.htm" target="_blank"><i class="fa  fa-book"></i> Copy of Legislation up to V60</a></li>	
				<li><a href="Legislation Monitoring/List of jurisdictions - Pilot revised.htm" target="_blank"><i class="fa  fa-book"></i> List of jurisdictions</a></li>	
				<li><a href="Legislation Monitoring/Topics and Sub-Topics.htm" target="_blank"><i class="fa  fa-book"></i> Topics and Sub-Topics</a></li>		 
          </ul>
        </li>
		 
		<li class="treeview">
          <a href="#">
             <i class="fa  fa-dashboard"></i>
            <span>SUMMARY WRITING</span>
            
          </a>
          <ul class="treeview-menu">
           
				<li><a href="Summary Writing/Ideagen Summary Writing - Innodata Queries_080320203-MA response (1).pdf" target="_blank"><i class="fa  fa-bar-chart"></i> Ideagen Summary Writing Queries</a></li>
				<li><a href="Summary Writing/Innodata-Legal Summary Examples 19.06.2020 (5).htm" target="_blank"><i class="fa  fa-bar-chart"></i> Inno Legal Summary Example</a></li>
				<li><a href="Summary Writing/QPulse Law Writing Principles.htm" target="_blank"><i class="fa  fa-bar-chart"></i> QPulse Law Writing</a></li>	
				<li><a href="Summary Writing/Legal Summary Examples.pdf" target="_blank"><i class="fa  fa-bar-chart"></i> Legal Summary</a></li>	
					 
          </ul>
        </li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>