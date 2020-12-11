<?php
	session_start();
	error_reporting(0); //Turn of error reporting
	include('Includes/conn.php');
	
	
	if($conn){
		$stdemail = $_SESSION['email'];
		if(!isset($_SESSION['username']) && !isset($_SESSION['password'])){
			header('location:index.php');
		}else{
			$unvalue = $_POST['username'];
			$psvalue = $_POST['password'];
			$sql = "SELECT * FROM students WHERE stdemail = '$stdemail'";
			$query = mysqli_query($conn, $sql);
			$result = (mysqli_fetch_assoc($query));
		}

	}else{
		echo 'Connection Error!';
	}
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title> WBS </title>
		
		<!-- Meta Data -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="">
		<meta name="author" content="">
		<meta name="description" content="">
		<meta http-equiv="refresh" content="">

		<!-- Font Awesome Icons -->
		<link href="fontawesome/css/all.css" rel="stylesheet"> <!--load all styles -->
		<script defer src="fontawesome/js/all.js"></script>
		<link href="fontawesome/css/fontawesome.css" rel="stylesheet">
  		<link href="fontawesome/css/brands.css" rel="stylesheet">
		<link href="fontawesome/css/solid.css" rel="stylesheet"> 
		<script defer src="fontawesome/js/brands.js"></script>
  		<script defer src="fontawesome/js/solid.js"></script>
  		<script defer src="fontawesome/js/fontawesome.js"></script>

		<!-- External CSS files -->
		<link rel="stylesheet" href="CSS/main.css" type="text/css">
		<link rel="stylesheet" href="CSS/preview.css" type="text/css">

		<!-- Script to print the content of a div -->
		<script> 
			function printDiv() { 
				var divContents = document.getElementById("GFG").innerHTML; 
				var headContents = "<link rel='stylesheet' href='CSS/main.css' type='text/css'> <link rel='stylesheet' href='CSS/preview.css' type='text/css'>";
				var a = window.open('', '', 'height=4000, width=4000'); 
				a.document.write('<html><head>'); 
				a.document.write(headContents); 
				a.document.write('</head>'); 
				a.document.write("<body>"); 
				a.document.write(divContents); 
				a.document.write("</body></html>"); 
				a.document.close(); 
				a.print(); 
			} 
		</script> 
	</head>
	
	<body>				
			<div id="GFG">
				<div class="header" style="text-decoration: underline;font-weight: bold; font-size: 1.7rem; margin: 30px auto; text-align: center; background-color:background-color: rbga(216, 216, 216, 1);;"> WESTBRIDGE TECHNOLOGY CENTER </div>
				<div class="header" style="font-size: 1.1rem; margin: 30px auto; text-align: center;"> SUMMARY OF APPLICATION </div>
				<div style="margin: 10px auto; width: 200px; text-align: center;">
					<img src="<?php echo $result['photo']?>"style="width: 100px; height: 150px; border-radius: 4px; border: 2px solid gray;"/>
					<p style="margin: 10px;">Student ID: <?php echo $result['studentid'];?>
				</div>
				<table style="width: 70%; text-align: left; margin: 20px auto;" border="1">
					
					<tr>
						<th style="padding: 5px;"> Full Name </th>
						<td style="padding: 5px;"> <?php echo $result['fname'].' '.$result['lname'];?> </td>
					</tr>
					
					<tr>
						<th style="padding: 5px;"> Student Contact </th>
						<td style="padding: 5px;"> <?php echo $result['stdcontact'];?> </td>
					</tr>
					
					<tr>
						<th style="padding: 5px;"> Student Email </th>
						<td style="padding: 5px;"> <?php echo $result['stdemail'];?> </td>
					</tr>
					
					<tr>
						<th style="padding: 5px;"> Date Of Birth </th>
						<td style="padding: 5px;"> <?php echo $result['dob'];?> </td>
					</tr>
					
					<tr>
						<th style="padding: 5px;"> Gender </th>
						<td style="padding: 5px;"> <?php echo $result['gender'];?> </td>
					</tr>
					
					<tr>
						<th style="padding: 5px;"> City </th>
						<td style="padding: 5px;"> <?php echo $result['city'];?> </td>
					</tr>
					
					<tr>
						<th style="padding: 5px;"> Hometown </th>
						<td style="padding: 5px;"> <?php echo $result['hometown'];?> </td>
					</tr>
					
					<tr>
						<th style="padding: 5px;"> Highest Educational Level </th>
						<td style="padding: 5px;"> <?php echo $result['edulevel'];?> </td>
					</tr>
					
					<tr>
						<th style="padding: 5px;"> Next Of Kin </th>
						<td style="padding: 5px;"> <?php echo $result['nok'];?> </td>
					</tr>
					
					<tr>
						<th style="padding: 5px;"> Relationship to Student </th>
						<td style="padding: 5px;"> <?php echo $result['relation'];?> </td>
					</tr>
					
					<tr>
						<th style="padding: 5px;"> Next of Kin's Contact</th>
						<td style="padding: 5px;"> <?php echo $result['nokcontact'];?> </td>
					</tr>
					
					<tr>
						<th style="padding: 5px;"> Programme Selected </th>
						<td style="padding: 5px;"> <?php echo $result['course'];?> </td>
					</tr>
				</table>
				
				<div style="margin: 35px auto; width: 200px; font-weight: bold; font-size: 1.2rem; text-align: center;"> OFFICIAL USE </div>
				<div style="margin-left: 120px; margin-top: 30px;">
					<!--Line-->
					<hr style="margin: 30px 0px 10px 0px; width: 150px; background-color: black; height: 1px;"></hr>
					<div style="margin: 10px 0px 5px 0px; font-size: 0.9rem;"> HEAD OF TRAINING, <P style="margin: 7px 0px;">WESTBRIDGE SYSTEMS </div>
				</div>
			</div>
			
			<div style="margin: 100px auto; width: 300px; text-align: center;">
				<button onclick="printDiv()" style="cursor: pointer; background-color: blue; color: white; padding: 10px 25px; border-radius: 8px; border: 3px solid blue; margin: 0;">Print </button>
				<a class="exit" href="index.php?exit=true" style="text-decoration: none; color: blue; padding: 10px 25px; border-radius: 8px; border: 2px solid blue;;"> Exit </a>
				<?php
						if(isset($_GET['exit'])){
							header('location:index.php');
						}
				?>
			</div>
	</body>
</html>
