<?php
	error_reporting(0); //Turn of error reporting
	include('Includes/conn.php');
	session_start();
	
	if(!$conn){
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
		<link href="../fontawesome/css/all.css" rel="stylesheet"> <!--load all styles -->
		<script defer src="fontawesome/js/all.js"></script>
		<link href="../fontawesome/css/fontawesome.css" rel="stylesheet">
  		<link href="../fontawesome/css/brands.css" rel="stylesheet">
		<link href="../fontawesome/css/solid.css" rel="stylesheet"> 
		<script defer src="../fontawesome/js/brands.js"></script>
  		<script defer src="../fontawesome/js/solid.js"></script>
  		<script defer src="../fontawesome/js/fontawesome.js"></script>

		<!-- External CSS files -->
		<link rel="stylesheet" href="CSS/main.css" type="text/css">
		<link rel="stylesheet" href="CSS/home.css" type="text/css">

		
	</head>
	
	<body>
		<div class="container full-width flex flex-center">
		<!-- 
		==========
		Wrapper
		==========
		-->
		<div class="wrapper grid" style="">
			<!-- 
			==========
			Left Sidebar
			==========
			-->
			<div class="left-sidebar">
				<!-- Menu -->
				<div class="menu full-width" style="display: 
				<?php 
					if(isset($_SESSION['username']) && isset($_SESSION['password'])){ 
						echo 'block'; 
					}else{ 
						echo 'none';
					}?>;"> 
				
					<!-- Header -->
					<div class="header full-width">
						<div class="title full-width">
							WestBridge Technology Center
						</div>

						<div class="sub-text full-width">
							Dashboard
						</div>
					</div>

					<!-- Menu Tabs -->
					<ul>
						<li class="active"><i class="fas fa-user"></i> <span class="label">Student Registration</span> </li>
						<li class=""><i class="fas fa-user"></i> <span class="label">Notifications</span> </li>
						<li class=""><i class="fas fa-user"></i> <span class="label">Courses</span> </li>
						<li class=""><i class="fas fa-user"></i> <span class="label">Records</span> </li>
					</ul>
					
					<div class="line full-width"></div>
					<ul>
						<li class=""><i class="fas fa-user"></i> <span class="label">Admin</span> </li>
						<li class=""><i class="fas fa-user"></i> <span class="label">Staff</span> </li>
						<li class=""><i class="fas fa-user"></i> <span class="label">Courses</span> </li>
					</ul>
					
					<!-- Logout -->
					<div class="line full-width"></div>
					<ul>
						<a href="index.php?logout=true" style="color: white; text-decoration: none;">
						<li class="logout-btn">
							<i class="fas  fa-power-off"></i> 
							<span class="label">Logout</span>
							<?php
								if (isset($_GET['logout'])){
									session_destroy();
									header('Location:index.php');
								}
							?>
						</li>
						</a> 
					</ul>
				</div>
			</div><!-- End of sidebar -->

			<!-- 
			==========
			Content Area
			==========
			-->
			<div class="content-area flex flex-center">
				<!-- 
				==========
				Login Area
				==========
				-->
				<div class="login" style="display: 
				<?php
					if(isset($psvalue) && isset($unvalue) || isset($_SESSION['username']) && isset($_SESSION['password'])){
						echo 'none';
					}else{
						echo 'block';
					}?>;">

					<div class="header-text full-width align-center" style="color: var(--darkblue);"> WestBridge Techology Center </div>
					
					<!-- Login form -->
					<form class="form-items" method="POST" action="index.php" style="color: red;">
						<p><input type="text" placeholder="User Name" name="username" required/></p>
						<p><input type="password" placeholder="Password" name="password" required/></p>
						<p><input type="submit" value="Login" name="login"/></p>

						<?php
							//Login validation message
							if(isset($_POST['login'])){
								$unvalue = $_POST['username'];
								$psvalue = $_POST['password'];
								$sql = "SELECT * FROM userlogin WHERE username='$unvalue' AND pin='$psvalue'";
								$query = mysqli_query($conn, $sql);
								$result = mysqli_fetch_assoc($query);
								$_SESSION['username'] = $result['username'];
								$_SESSION['password'] = $result['pin'];

								if(mysqli_num_rows($query) < 1){
									echo 'Invalid Login!';
								}

								header('Location:index.php');
							}
						?>
					</form>
				</div><!-- End of login -->

				<!-- 
				==========
				Content
				==========
				-->
				<!--Student Registration-->
				<div class="content full-width" id="studentReg" style="display: 
				<?php 
					if(isset($unvalue) && isset($psvalue) || isset($_SESSION['username']) && isset($_SESSION['password'])){
						echo 'grid';
					}else{
						echo 'none';}
				?>;">
					<!-- Form -->
					<div class="form">
						<div class="header">
							<div class="text">
								Student Registration
								<img src="IMG/logo.png" class="logo" />
							</div>

							<div class="sub-text">
								Fill the form below 
							</div>
						</div>
						
						<!--
						==============
						Registration Form
						==============
						-->
						<form action="register.php" method="POST" enctype="multipart/form-data">
							<ul>
								<li>
									<!-- Preview image -->
									<div style="width: 150px; margin: auto;"><img id="output" style="max-width: 100%; max-height: 100%; border-radius: 4px; border: 3px solid rgba(188, 188, 188, 0.7);"/></div>
									<div style="position: relative;top: 30px;">
										<div class="label" style="margin: 10px 0px;"> Upload photo </div>
										<input type="file" id="stdPhoto" name="stdphoto" onchange="loadFile(event)" required>
									</div>
								</li>
							
								<!-- Personal Info-->
								<li style="border-bottom: 1px solid gray; margin: 50px 0px 25px 0px;"></li>
								
								<li>
									<div class="label"> First Name </div>
									<div class="input"><input type="text" placeholder="Enter first name" name="fname" required/></div>
								</li>

								<li>
									<div class="label"> Last Name </div> 
									<div class="input"><input type="text" placeholder="Enter surname"name="lname" required/></div>
								</li>
								
								<li>
									<div class="label"> Student Contact </div> 
									<div class="input"><input type="text" placeholder="Eg; Phone number" name="stdcontact" required/></div>
								</li>
								
								<li>
									<div class="label"> Student Email </div> 
									<div class="input"><input type="email" placeholder="example@gmail.com" name="stdemail" required/></div>
								</li>
								
								<li>
									<div class="label"> Date of birth </div> 
									<div class="input"><input type="date" placeholder="May 25, 1977" name="dob" required/></div>
								</li>
								
								<li>
									<div class="label"> Gender </div> 
									<div class="input">
										<input type="radio" value="Male" name="gender"/><span class="label gender-label" checked="checked" required>Male</span>
										<input type="radio" value="Female" name="gender"/><span class="label gender-label" required>Female</span>
									
									</div>
								</li>

								<li>
									<div class="label"> City</div> 
									<div class="input"><input type="text" placeholder="Accra" name="city" required/></div>
								</li>
								
								<li>
									<div class="label"> Hometown</div> 
									<div class="input"><input type="text" placeholder="Accra" name="home" required/></div>
								</li>
								
								<li>
									<div class="label"> Highest Educational Level </div> 
									<div class="input"><input type="text" placeholder="Eg; SHS"name="edulevel" required/></div>
								</li>
								
								<li style="border-bottom: 1px solid gray; margin: 50px 0px 25px 0px;" required/></li>

								<!-- Next of kin -->
								<li>
									<div class="label"> Next of kin </div> 
									<div class="input"><input type="text" placeholder="Enter full name" name="nok" required/></div>
								</li>
								
								<li>
									<div class="label"> Relationship to Student </div> 
									<div class="input"><input type="text" placeholder="Eg; Brother" name="relation" required/></div>
								</li>
								
								<li>
									<div class="label"> Contact </div> 
									<div class="input"><input type="text" placeholder="Eg; Phone number" name="nokcontact" required/></div>
								</li>
								
								<li style="border-bottom: 1px solid gray; margin: 50px 0px 25px 0px;" required/></li>
								
								<!-- Course -->
								<li>
									<div class="label"> Course to Offer </div> 
									<div class="input">
										<select name="course" required /> 
											<option selected> Select Course </option>
											<?php
						
												$coursesql = "SELECT * FROM courses";
											
												$numrows = mysqli_num_rows(mysqli_query($conn, $coursesql));
												//;
												
												while($course = mysqli_fetch_assoc(mysqli_query($conn, $coursesql))){
													$title = $course['title'];
													
													echo '<option>'.$title.'</option>';
												}
											?>
										</select> 
									</div>															
								</li>
							</ul>
							<div class="buttons">
								<input type="reset" value="CANCEL" />
								<input type="submit" value="CONFIRM" name="register" />
							</div>
						</form>					
					</div><!-- End of form -->
					
					<div class="image background-image background-cover">

					</div>
				</div>
				<!-- End of Student Registration-->


			</div><!-- End of Content Area -->
		</div><!-- End of wrapper -->
		</div>
		
		
		<script>
		  var loadFile = function(event) {
			var output = document.getElementById('output');
			output.src = URL.createObjectURL(event.target.files[0]);
			output.onload = function() {
			  URL.revokeObjectURL(output.src) // free memory
			}
		  };
		</script>
	</body>
</html>
