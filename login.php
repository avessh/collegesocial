<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css link  -->
    <link rel="stylesheet" href="../avesh/style/style.css">
    <title>Project_login</title>
</head>

<body>

    <!-- php code  -->

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $uname = $_POST['uname'];
        $pword = $_POST['pword'];
      

        // connecting to database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "user_register";

        // creating a connection 
        $conn = mysqli_connect($servername, $username, $password, $database);

        if (($conn)&& ($pword!="")&&$uname!="") {
           
            $sql = "Select * from user2002 where username ='$uname' AND password = '$pword'";
            $result = mysqli_query($conn,$sql);
           
            $num = mysqli_num_rows($result);
            if($num==1 ){
               
                echo "login successfull";
               

                session_start();

                $_SESSION['loggedin']=true;
                $_SESSION['username'] = $uname;
                $_SESSION['password'] = $pword;

              
               
                header("location: index.php");

            }else{
                echo ' <div id="alert" style="  background-color:  rgb(244,216,218); color:rgb(122,40,44); height:6vh; 
                padding: 4px;">
                <p> <b>Alert!!</b>Invalid username or password</p>
                </div>';
            }
        } else{
            echo "please fill username and password correctly";
            echo ' <div id="alert" style="  background-color:  rgb(244,216,218); color:rgb(122,40,44); height:6vh; 
            padding: 4px;">
            <p> <b>Alert!!</b>please fill username and password correctly</p>
            </div>';
        }
    }

    ?>

    <section id="mainsection">
        <div class="container">

            <h1 id="loginhead">Login to your account</h1>
            <form id="loginform" action="/avesh/login.php" method="POST">
                <label for="uname">Username</label>
                <input type="text" name="uname" id="uname" placeholder="abc@gmail.com">
                <label for="pword">Password</label>
                <input type="password" name="pword" id="pass" placeholder="****">
                <div  id="contain">
                    <div id="submit">
                        <button id="submitbtn" type="submit">Submit</button>
                    </div>
                    <div id="link">
                        <a href= "_register.php" >Don't have account</a>
                    </div>
                </div>



            </form>
        </div>
    </section>



</body>

</html>