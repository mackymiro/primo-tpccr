<?php
   include ("conn.php");
   session_start();
   error_reporting(0);
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($con,$_POST['username']);
      $mypassword = mysqli_real_escape_string($con,$_POST['password']); 
      
      $sql = "SELECT * FROM tbluser WHERE UserName = '$myusername' and Password = '$mypassword'";
	 // echo $sql;
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
     // $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
        // session_register("myusername");
         $_SESSION['login_user'] = $myusername;
		 
		  
		 if ($result1=mysqli_query($con,$sql))
		  {
		  // Fetch one and one row
		  while ($row1=mysqli_fetch_row($result1))
			{
				 $_SESSION['UserID'] = $row1[0];
				 $_SESSION['EName'] = $row1[3];
				 $_SESSION['UserType'] = $row1[4];
				 
				 
			}
		  }
		  
		  if ($_SESSION['UserType']=='Admin'){
			  header("location: AcquisitionReport.php");
		  }
		  else{
			 $sql="SELECT * FROM primo_view_Jobs Where ProcessCode='ENRICHMENT' AND statusstring in('Allocated','Pending','Ongoing')  AND AssignedTo='$_SESSION[login_user]'";						 
			 
			$rs=odbc_exec($conWMS,$sql);
			$ctr = odbc_num_rows($rs);
			if ($ctr<=0){
			$sqls="EXEC usp_PRIMO_AUTOALLOCATE  @UserName=".$myusername.", @ProcessCode=ENRICHMENT";
			ExecuteQuerySQLSERVER ($sqls,$conWMS);
			}
			
			header("location: Dashboard.php");
		  }
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>


<!DOCTYPE HTML>
<html lang="zxx">

<head>
	<title>primo: digital content transformation platform</title>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords" content=""
	/>
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- Meta tag Keywords -->
	<!-- css files -->
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<!-- Style-CSS -->
	<link rel="stylesheet" href="css/fontawesome-all.css">
	<!-- Font-Awesome-Icons-CSS -->
	<!-- //css files -->
	<!-- web-fonts -->
	 
	<!-- //web-fonts -->
	<style>
.right {
    position: absolute;
	top:15%;
    right: 0%;
    width: 30%;
    padding: 10px;
}
</style>
<style>
button {
    background:none!important;
     border:none; 
     padding:0!important;
     
    font-size: 14px;
    color: #fff;
    
     font-weight: 500;
     text-decoration:none;
     cursor:pointer;
	 margin-top: 8px;
	  
}
</style>
<link rel="icon" href="innodata.png">
</head>

<body>
	<!-- title -->
	<h1>
		<span> </span>
		</h1>
	<!-- //title -->
	<!-- content -->
 
	<div class="sub-main-w3 right">
		<form action="" method="post">
			<div class="form-style-agile">
				<label>
					username
					<i class="fas fa-user"></i>
				</label>
				<input placeholder="username" name="username"" type="text" required="">
			</div>
			<div class="form-style-agile">
				<label>
					password
					<i class="fas fa-unlock-alt"></i>
				</label>
				<input placeholder="password" name="password" type="password" required="">
			</div>
			<!-- checkbox -->
			<div class="wthree-text">
				<ul>
					<li>
						<?php echo $error;?> 
					</li>
					 <li>
						<button type="submit">start your journey</button>
					</li>
				</ul>
			</div>
			<!-- //checkbox -->
			
			<!-- social icons -->
			 
			<!-- //social icons -->
			
		</form>
		 
	</div>
	
	<!-- //content -->

	<!-- copyright -->
	<div class="footer">
		 
	</div>
	<!-- //copyright -->

</body>

</html>