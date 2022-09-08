<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uname = $_POST['username'];
    $pword = $_POST['password'];
    $cpword = $_POST['cpassword'];
    $fullname = $_POST['fullname'];
    $course = $_POST['course'];
    $branch = $_POST['branch'];
    $rollno = $_POST['rollno'];
    $address = $_POST['address'];
    $passingyear = $_POST['passingyear'];

    // connecting to database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "user_register";

    // creating a connection 
    $conn = mysqli_connect($servername, $username, $password, $database);

    //checking only one unque username should be present on the database
    $existsql = "SELECT `username` FROM `user2002` WHERE username = '{$uname}'";
    $result = mysqli_query($conn , $existsql);
    $numExistRows = mysqli_num_rows($result);
 
    if(($numExistRows > 0)  ){

        echo ' <div id="alert" style="  background-color:  rgb(244,216,218); color:rgb(122,40,44); height:6vh; 
        padding: 4px;">
        <p> <b>Alert!!</b>Entered username or rollno already exist. Please try with different username or rollno or blacked filed</p>
        </div>';
        
    }else{
        if (($conn ) && ($pword == $cpword) && $uname!= "" &&($pword!=""))  {
     
           
            echo ' <div id="alert" style="  background-color:  lightgreen; color:white; height:6vh; 
            padding: 4px;">
            <p> <b>Alert!!</b>connention is successful</p>
            </div>';
        
     
             $sql = "INSERT INTO `user2002` (`srno`, `username`, `password`, `cpassword`, `fullname`, `course`, `branch`, `rollno`,`passingyear`, `address`, `date`) VALUES (NULL, '{$uname}', '{$pword}', '{$cpword}', '{$fullname}', '{$course}', '{$branch}', '{$rollno}' , '{$passingyear}', '{$address}' , current_timestamp())";
     
             $result = mysqli_query($conn , $sql);
     
             if($result){
                echo ' <div id="alert" style="  background-color:  green; color:rgb(122,40,44); height:6vh; 
            padding: 4px;">
            <p> <b>Alert!!</b>insertion is successful</p>
            </div>';

                 header("location:login.php");
             }else{
                
                 echo ' <div id="alert" style="  background-color:  rgb(244,216,218); color:rgb(122,40,44); height:6vh; 
                 padding: 4px;">
                 <p> <b>Alert!!</b>something wrong happen at the backend we are trying to fix the error</p>
                 </div>';
             }
         }else{
             
             echo ' <div id="alert" style="  background-color:  rgb(244,216,218); color:rgb(122,40,44); height:6vh; 
                 padding: 4px;">
                 <p> <b>Alert!!</b>password and conform password must be exact same and should not be empty</p>
                 </div>';
         }
    }
   
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- link css  -->
    <link rel="stylesheet" href="../avesh/style/_register.css">
    <!-- ../style/_register.css?v=1 -->
    <title>project_register</title>

</head>

<body>
   

    <section id="mainsection">
        <div id="container">
            <h1 id="containerhead"> Sign Up </h1>
            <div id="formcontain">
                <form action="/avesh/_register.php" method="POST">

                    <label for="username"> Username </label>
                    <input type="text" name="username" id="username">

                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">

                    <label for="cpassword">Confirm password</label>
                    <input type="password" name="cpassword" id="cpassword">

                    <label for="fullname"> Full Name </label>
                    <input type="text" name="fullname" id="firstname">

                    <label for="address"> Address </label>
                    <input type="text" name="address" id="address">

                    <label for="course"> Course </label>
                    <input type="text" name="course" id="course">

                    <label for="branch"> Branch </label>
                    <input type="text" name="branch" id="branch">

                    <label for="rollno"> Roll Number </label>
                    <input type="number" name="rollno" id="roll.no">


                    <label for="-passingyear"> Passing Year </label>
                    <input type="number" name="passingyear" id="passingyear">

                    <button id="submitbtn" type="submit">Sign Up</button>

                </form>
            </div>
        </div>
    </section>
<?php

if($showalert){
  
}

?>

</body>

</html>