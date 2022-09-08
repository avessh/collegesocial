<?php



include 'dbconnect.php';

session_start();
$user = $_SESSION['username'];

$sql = "SELECT `srno` FROM `user2002` where `username` = '$user'";
$result = mysqli_query($conn,$sql);

$num = mysqli_num_rows($result);

while($row = mysqli_fetch_assoc($result)){
   $user_id = $row['srno'];
   echo "person who like " . $user_id;
   echo "<br>";
}

$profile_id = $_POST['profile_id'];
echo $profile_id;

$sql = "Select distinct id,  user_id , liked_user_id , like_count , dislike_count ,status from user_profile where user_id = '$user_id' Group by liked_user_id ,user_id Order by user_id";
$result = mysqli_query($conn,$sql);
if($result){
  echo "selection is successful";
  while($row = mysqli_fetch_assoc($result)){
    $id = $row['id'];
    echo $id;
    $like_count = $row['like_count'];
    echo $like_count;
  
   $status =  $row['status'];
   echo $status;
  

    // if($status = 'liked'){
    //   $sql = "DELETE FROM `user_profile` WHERE `user_profile`.`id` = '$id'; ";
    //   $result = mysqli_query($conn,$sql);
    //   if($result){
    //     echo "updation is successful";
    //   }
    //   header("location:user_profile.php");
    // }
  }
}



  $sql = "INSERT INTO  `user_profile`  (`id`, `user_id`, `liked_user_id`, `like_count`, `dislike_count`, `status` ) VALUES (NULL, '$user_id', '$profile_id', '1', '0', 'liked')";
  $result = mysqli_query($conn,$sql);

 


  header("location:user_profile.php");
?>

