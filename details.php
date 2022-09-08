<?php 

 session_start();
 $_SESSION['userprofilename'] = $_POST['profile_name'];

 echo $_SESSION['userprofilename'];

 header('location:user_profile.php');
?>