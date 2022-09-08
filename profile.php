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
    <link rel="stylesheet" href="../avesh/style/profile.css">
    <title>profile</title>
</head>

<body>

<?php 
session_start();
include 'dbconnect.php';

if ($conn){
    $name = $_SESSION['username'];
    $sql = "select * from `user2002` where username = '$name' ";
    $result = mysqli_query($conn , $sql);
   

    $num = mysqli_num_rows($result);
    

    if($num > 0){

       $row = mysqli_fetch_assoc($result);
       

    }
}

?>


    <!-- section for navbar -->


    <section id="nav">
        <?php include 'nav.php' ?>
    </section>

    <section id="mainsection-profile">
       

            <img id="profile-img" src="../avesh/img/male-profile.jpg" alt="ohho image is not present today"> 
           

       

    </section>

    <section id="userContent">
    <div id="profileContent">
            <h1 id="profileName"><?php echo $row['fullname']; echo "   ";echo "<em style='font-size:22px; color:grey;'>(" . $row['username'] .")</em> " ?> </h1>
            <p class="para"><?php echo $row['rollno'] ?></p>
            <p class="para"><?php echo $row['branch'] ?></p>
            <p class="para"><?php echo $row['course'] ?></p>
            <p class="para"><?php echo $row['address'] ?></p>
            <button id="editbtn" style="padding:6px 15px 6px 15px;">edit</button>
          <a href="logout.php"  style="padding:6px 12px 6px 12px; "> <button  style="padding:6px 12px 6px 12px; color:#1C3879;  cursor:pointer;">Logout</button></a> 
    
        </div>
    </section>
    <script >
         document.getElementById('editbtn').onclick = function(){
           location.href = "edit.php";
  
        }
      


      
    </script>
<footer>
    <?php include 'footer.php' ?>
</footer>

</body>

</html>