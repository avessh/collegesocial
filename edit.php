<?php



session_start();
if (!isset($_SESSION) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../avesh/style/edit.css">
    <title>Document</title>
</head>


<body>
    



    <?php

    session_start();



    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $updatedname = $_POST['updatedusername'];
        $updatedpassword = $_POST['updatedpassword'];
        $updateconfirmdpassword = $_POST['updatedconfirmpassword'];
        // $updatedfullname = $_POST['updatedfullname'];
        // $updatedcourse = $_POST['updatedcourse'];
        // $updatedbranch = $_POST['updatedbranch'];
        // $updatedrollno = $_POST['updatedrollno'];

        include "dbconnect.php";

        $name = $_SESSION['username'];


        echo $id;


        if ($conn) {
           
        } else {
            echo "failed to connect to database";
        }

        $sql = "SELECT * FROM `user2002` WHERE `username`='$name'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);

        if ($num > 0) {
            $row = mysqli_fetch_assoc($result);
           
            $id = $row['srno'];
        }

        if(($updatedpassword == $updateconfirmdpassword) && ($updatedname != "") && $updateconfirmdpassword != "" ){
            $sql = "UPDATE `user2002` SET `username` = '$updatedname', `password` = '$updatedpassword', `cpassword` = '$updateconfirmdpassword' WHERE `user2002`.`srno` = $id";
            $result = mysqli_query($conn, $sql);
            if(($result) ){
                echo "updation is successful";
                echo "<br>";
                echo "please login again with your new username";
    
               include 'logout.php';
            }else {
                echo  '<div id="alert">
                <b>alert!! faild to update your info </b>
                </div>';
            }
        }else if ($updatedname == "") {
            echo "please enter username";

        }else if($updatedpassword == ""){
            echo "please enter your password";
        }else {
            echo "your password and confirm password is not same";
        }
        
    }


    ?>



    <?php include "nav.php" ?>

    <div id="message">
        After you update your username and password you have to login again with your new username and password.
    </div>
    <section id="edit-form">



        <div id="form-container">
            <h1 style="margin-bottom: 5%; font-size: 25px; ">Update your info here!!</h1>
            <form id="editform" action="/avesh/edit.php" method="POST">

                <label for="updatedusername"> Username </label>
                <input type="text" name="updatedusername" id="username">

                <label for="updatedpassword">Password</label>
                <input type="password" name="updatedpassword" id="password">

                <label for="updatedconfirmpassword">Confirm Password</label>
                <input type="password" name="updatedconfirmpassword" id="password">
                <!-- 
                



                <label for="fullname"> Full Name </label>
                <input type="text" name="updatedfullname" id="firstname">

                <label for="course"> Course </label>
                <input type="text" name="updatedcourse" id="course">

                <label for="branch"> Branch </label>
                <input type="text" name="updatedbranch" id="branch">

                <label for="rollno"> Roll Number </label>
                <input type="number" name="updatedrollno" id="roll.no"> -->

                <button id="submitbtn" type="submit">Update</button>

            </form>
        </div>


    </section>




    <footer><?php include 'footer.php' ?></footer>


</body>

</html>