<?php
	//DB connection parameters
	$host = 'localhost';
	$user = 'root';
	$pswd = '';
	$dbName = 'wbsgh';
	
	//Connection to DB
	$conn = mysqli_connect("$host", "$user", "$pswd", "$dbName");


	if(!$conn){
		$db_connect = mysqli_connect("localhost", "root", "");

        if (mysqli_query($db_connect, "CREATE DATABASE wbsgh")){
               
            //creates login table
            $cmd ="CREATE TABLE wbsgh.students (studentid INT(216) NOT NULL AUTO_INCREMENT , fname VARCHAR(256) NOT NULL , lname VARCHAR(256) NOT NULL , stdcontact VARCHAR(256) NOT NULL , stdemail VARCHAR(200) NOT NULL, dob VARCHAR(200) NOT NULL, gender VARCHAR(200) NOT NULL, city VARCHAR(200) NOT NULL, hometown VARCHAR(200) NOT NULL, edulevel VARCHAR(200) NOT NULL, nok VARCHAR(200) NOT NULL, relation VARCHAR(200) NOT NULL, nokcontact VARCHAR(200) NOT NULL, course VARCHAR(200) NOT NULL, photo VARCHAR(200) NOT NULL, PRIMARY KEY (studentid)) ENGINE = InnoDB;";
			mysqli_query($db_connect, $cmd);
			$create_userlogin_table = "CREATE TABLE wbsgh.userlogin (userid INT(216) NOT NULL AUTO_INCREMENT, username VARCHAR(256), pin VARCHAR(256), PRIMARY KEY (userid)) ENGINE = InnoDB;";
			
			//Create User login table
			mysqli_query($db_connect, $create_userlogin_table);
			mysqli_query($db_connect, "INSERT INTO wbsgh.userlogin (username, pin) VALUES ('admin', '1234');");

            header("location:index.php");
        }else{
            echo'Database creation failed, please contact customer support';
        }
	}
?>