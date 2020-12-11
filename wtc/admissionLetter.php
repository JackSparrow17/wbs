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
			
			//if($result['stdname']==""){
				//header('location:index.php');
			//}
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
		<link rel="stylesheet" href="CSS/admission.css" type="text/css">
		
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

<body  class="background-image" style="background-image: url('IMG/std.jpg');">
	<div class="container" id="GFG">
		<!--
		==========
		Wrapper-
		==========
		-->
		<div class="wrapper" style="width: 800px; padding: 20px; background-color: white; border-radius: 10px; min-height: 90vh; font-family: arial;">
			<!--Banner-->
			<div class="banner">
				<img style="width: 100%;" height="230" src="IMG/lh.jpg">
			</div>
			
			<div class="letter" style="margin: 0px 20px; font-size: 1.1rem;">
				<?php 
					if($result['gender']=="MALE"){
						$title = "MR.";
					}else{
						$title = "MS.";
					}
					
					$coursename = $result['course'];
					$coursesql = "SELECT * FROM courses WHERE title = '$coursename'";
					$course = mysqli_fetch_assoc(mysqli_query($conn, $coursesql));
				?>
				<div style="margin: 30px 0px; line-height: 1.2; color: gray; font-size: 0.9rem;">
					<p style="text-align: right;"><img src="<?php echo $result['photo'];?>" width="110" height="150" style="margin: 10px 0px;"/>
					<p><?php echo date(D).', '.date(M).' '.date(Y);?>
					<p>To <?php echo $title.' '.$result['fname'].' '.$result['lname'];?>
					<p> <?php echo $result['city'].', '."Ghana.";?>
				</div>
				
				<p style="font-size: 1.1rem; font-weight: bold;">Dear <?php echo $result['fname']; ?>,
				
				<p style="line-height: 1.6; margin: 10px 0px; font-size: 1rem;">
				We are pleased to inform you that you have been admitted to WESTBRIDGE TECHNOLOGY CENTER
				to offer <?php echo $course['title'];?>.
				
				<p style="line-height: 1.6; margin: 10px 0px; font-size: 1rem;">
				As part of the acceptance of this offer, you are required to make an initial deposit of 
				<?php echo 'GHC'.round($course['amount']/2).'.00';?> at our main office at Stadium Residential Area, Tumu.
				
				<p style="line-height: 1.6; margin: 10px 0px; font-size: 1rem;">
				The duration for the selected course is <?php echo strtolower($course['duration']);?>. Please note that no changes 
				will be accepted during the period of your study. However, you can enroll in additional courses.
				
				<p style="line-height: 1.6; margin: 10px 0px; font-size: 1rem;">
				Please respond as soon as possible, your class will commence on _____________________
				<br />
				Once again, <font color="orange">congratulations!</font> We hope to hear from you soon!

				<p style="line-height: 1.6; margin: 35px 0px; width: 100%; text-align: right; font-weight: bold; color: #005682;">
				Head of Training
				<br />WestBridge Technology Center

			</div>

		</div>
		<!--End of wrapper-->
	</div>
	<div style="margin: 30px auto; width: 300px; text-align: center;">
		<button onclick="printDiv()" style="cursor: pointer; background-color: white; color: blue; padding: 10px 25px; border-radius: 8px; border: 3px solid white; margin: 0;">Print </button>
		<a class="exit" href="index.php?exit=true" style="text-decoration: none; color: white; padding: 10px 25px; border-radius: 8px; border: 2px solid white;;"> Exit </a>
		<?php
			if(isset($_GET['exit'])){
				header('location:index.php');
			}
		?>
	</div>
</body>
</html>