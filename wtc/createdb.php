<!DOCTYPE html>
<html>

<body>
    <button>
    <a href="newDb.php?db_value=true" style="text-decoration:none;">
        create WestBrigde Database
    </a>
    </button>

    <?php
    if (isset($_GET['db_value'])){
        
        $db_connect = mysqli_connect("localhost", "root", "");

        if (mysqli_query($db_connect, "CREATE DATABASE wbsgh")){
               
            //creates login table
            $cmd ="CREATE TABLE wbsgh.students ( studentid INT(216) NOT NULL AUTO_INCREMENT , fname VARCHAR(256) NOT NULL , lname VARCHAR(256) NOT NULL , stdcontact VARCHAR(20) NOT NULL , stdemail VARCHAR(20) NOT NULL, dob VARCHAR(20) NOT NULL, gender VARCHAR(20) NOT NULL, city VARCHAR(20) NOT NULL, hometown VARCHAR(20) NOT NULL, edulevel VARCHAR(20) NOT NULL, nok VARCHAR(20) NOT NULL, relation VARCHAR(20) NOT NULL, nokcontact VARCHAR(20) NOT NULL, course VARCHAR(20) NOT NULL, photo VARCHAR(20) NOT NULL, PRIMARY KEY (studentid)) ENGINE = InnoDB";
            mysqli_query($db_connect, $cmd);
            header("location:index.php");
        }else{
            echo'Database creation failed, please contact customer support';
        }
    }
    ?>
</body>

</html>