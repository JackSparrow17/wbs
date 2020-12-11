<?php
	session_start();
	error_reporting(0); //Turn of error reporting
	include('Includes/conn.php');
	
	if(!isset($_SESSION['username']) && !isset($_SESSION['password'])){
		header('location:index.php');
	}else{	
			if (isset($_POST['register'])) {
				//Student Data
				$fname = strtoupper($_POST['fname']);
				$lname = strtoupper($_POST['lname']);
				$stdcontact = $_POST['stdcontact'];
				$stdemail = $_POST['stdemail'];
				$dob = $_POST['dob'];
				$gender = strtoupper($_POST['gender']);
				$city = strtoupper($_POST['city']);
				$home = strtoupper($_POST['home']);
				$edulevel = strtoupper($_POST['edulevel']);
				$nok = strtoupper($_POST['nok']);
				$relation = strtoupper($_POST['relation']);
				$nokcontact = $_POST['nokcontact'];
				$course = strtoupper($_POST['course']);
								  
								  
				//File data
				$photo = $_FILES['stdphoto'];
				$photoName = $_FILES['stdphoto']['name'];
				$photoTempName = $_FILES['stdphoto']['tmp_name'];
				$photoSize = $_FILES['stdphoto']['size'];
				$photoError = $_FILES['stdphoto']['error'];
				$photoType = $_FILES['stdphoto']['type'];			
				$photoExt = explode('.', $photoName);
				$photoActualExt = strtolower(end($photoExt));
				$allowedExt = array('jpg', 'jpeg', 'png', 'pdf');			
				$photoNameNew = uniqid('', true).".".$photoActualExt;
				$photoDestination = 'Uploads/'.$photoNameNew;
									

				$email_sql = "SELECT stdemail FROM students WHERE stdemail = '$stdemail'";

				if(mysqli_num_rows(mysqli_query($conn, $email_sql)) < 1){
					if(in_array($photoActualExt, $allowedExt)){
						if(move_uploaded_file($photoTempName, $photoDestination)){
							$sql = "INSERT INTO students (fname, lname, stdcontact, stdemail, dob, gender, city, hometown, edulevel, nok, relation, nokcontact, course, photo) 
							VALUES ('$fname', '$lname', '$stdcontact', '$stdemail', '$dob', '$gender', '$city', '$home', '$edulevel', '$nok', '$relation', '$nokcontact', '$course', '$photoDestination')";
							mysqli_query($conn, $sql) || die("Failed to submit form");
							header('location:admissionLetter.php');
							$_SESSION['email'] = $stdemail;
						}else{
							echo '<p style=/"color: red;/">'.'There was an error uploading your file!';
						}
					}	
				}else{
					die('<p style = /"color: green;/">'.'Student already registered!');
				}
				}else{
					header('location:index.php');
				}
	}	  
?>