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

    <link rel="stylesheet" href="../avesh/style/index.css">
    <title>Home</title>
</head>

<body>


    <!-- php code  -->
    <?php

    include 'dbconnect.php';

    session_start();
    $user = $_SESSION['username'];


    $sql = "SELECT `srno` FROM `user2002` where `username` = '$user'";
    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);

    while ($row = mysqli_fetch_assoc($result)) {
        $user_id = $row['srno'];
        $user_ = $row['username'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $common_post = $_POST['common_post'];
        $to_user = $_POST['common_post_name'];


        session_start();
        $poster_name = $_SESSION['username'];

        // include "dbconnect.php";

        if (($common_post != "") && ($to_user != "")) {

             $sql = "INSERT INTO `public_post` (`id`, `user`, `to_user`, `post`, `liked_by`, `like_count`, `status`, `date`) VALUES (NULL, '$poster_name', '$to_user', '$common_post', 'person_who_liked', '0', 'not_liked', current_timestamp())";

            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "insertion is successful";
            }

            header('location:index.php');
        }
    }

    ?>


    <?php include 'nav.php' ?>

    <section id="mainSection">
       

      
        <?php
       

        ?>



        <div id="commonpost">
            
            <div id="posts">

                <?php
                
                include 'dbconnect.php';

                $sql = "SELECT * FROM `public_post` ORDER BY `public_post`.`date` DESC ";
                $result = mysqli_query($conn, $sql);



                while ($row = mysqli_fetch_assoc($result)) {
                    $postid = $row['id'];
                    $id = $row['id'];
                    $time = $row['date'];
                    $profile_user = $row['user'];
                    $profile_to_user = $row['to_user'];
              
                    $like_count = $row['like_count'];







                    echo '<div id="postcontainer">
                    <div id="top">
               <img style="width: 7%; border-radius:100%; margin:2% 2% 0% 5%; float:left;" src="../avesh/img/male-profile.jpg" alt="">
               <p style="margin:4% 0 0 0 ; float:left;"><b>' . $profile_user . '</b> &nbsp; --></p>

               <img style="width: 7%; border-radius:100%; margin:2% 2% 2% 2%; float:left;" src="../avesh/img/male-profile.jpg" alt="">

               <p style="margin:4% 0 0 0 ; float:left;"> <b>' . $profile_to_user . '</b> </p>
               <br>
               </div>
              
               <div id="postcontent">
              
                   <p style="padding: 0% 0%;">' . $row['post'] . '</p>
               </div>

               <div id="connectbtns">
               <form style="width:7%;"  action="../avesh/likes.php" method="GET">
               <input id="likecount" type="hidden" name="post_id" value="' . $id . '">
               
               
              
               </form>  
               
           
               </div>  
               <div style=" margin: 0% 0 1% 5% ;"> <span style="font-size:12px;"> <i>This post was made on ' . $time . '</i></span></div>
           
                   
           

             


           </div>';
                }




                //   header('location:index.php');

                ?>


            </div>
        </div>
        <div id="privatepost">
            <b>
                <p style="padding:2% 0 3% 4%">Posts that was anonymously sends to you </p>
            </b>
            <div id="privatepostcontainer">
                <?php

                include 'dbconnect.php';
                session_start();
                $username = $_SESSION['username'];
                if ($conn) {
                    $sql = "select * from private_post where to_user = '$username'";
                    $result = mysqli_query($conn, $sql);


                    $num = mysqli_num_rows($result);

                    if ($num > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo ' <div  id="posts-private">
                           
                                
                           
                            <p  style="padding: 2% 0 2% 0% ;"><b>' . $row['private_post'] . '</b> </p>
                        </div>';
                        }
                    }
                }



                ?>



            </div>





        </div>





        <div id="makecommonpost">
            <form action="../avesh/index.php" method="POST">
                <p style="margin:0 0 2% 2%;" id="special"> <b> Wanna make public post</b></p>
                <p style="font-size: 12px; margin-top:1%; color:red;"><b>***<i> once you make public post you will not be able to edit or delete it </i> ***</b></p>
                <!-- <input type="hidden" name="postid" value="$postid"> -->
                <textarea name="common_post" id="makepost" cols="30" rows="10" placeholder="Type here.."></textarea>

                <label id="to_user" for="common_post_name" style="margin: 2% 4% 2% 2% ;">for :</label>
                <input id="to_user" placeholder="target username" name="common_post_name" style="width:60%; border-left:none;border-top:none;border-right:none; border-bottom:1px solid black; outline:none; font-style:italic;" type="text">
                <button id="postbtn" type="submit" style="   display: flex; flex-direction: column; margin:4% 0 0 3%; padding: 4px 10px 4px 10px ; background-color:#1C3879 ; border:none; color:white; border-radius:3px; cursor:pointer;">Post</button>
            </form>

        </div>


        <!-- fetching like details from database  -->

        <?php
        include 'dbconnect.php';

        session_start();
        $user = $_SESSION['username'];

        $sql = "SELECT `srno` FROM `user2002` where `username` = '$user'";
        $result = mysqli_query($conn, $sql);

        $num = mysqli_num_rows($result);

        while ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row['srno'];
        }

        $sql = "select us.* , sum(up.like_count) as likes, sum(up.dislike_count) as dislike , status from user2002 us left join (Select distinct user_id , liked_user_id , like_count ,dislike_count , status from user_profile Group by liked_user_id ,user_id Order by user_id) as up on up.liked_user_id = us.srno where srno = '$user_id' group by us.srno order by likes desc";
        $result = mysqli_query($conn, $sql);



        while ($row = mysqli_fetch_assoc($result)) {

            $total_like = $row['likes'];

            $status = $row['status'];
        }



        ?>


        <div id="likesection">

            <!-- <p><b>You got</b></p> -->
            <div style="margin:0% 0 0 0 ;  " id="details">

                <p>Total people like you in college : <b><?php echo $total_like  ?></b></p>

            </div>

        </div>


    </section>



 
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        let btn = document.getElementById('postbtn').onclick = function() {


            let post = document.getElementById('makepost').value
            var to_user = document.getElementById('to_user').value

            if ((post == "") || (to_user == "")) {


                alert("<?php echo $_SESSION['username'] ?> i think you left something to fill")


            }


        }
    </script>
</body>

</html>

<!-- comment mateiral  -->

<!-- <labe style="font-size:15px; margin-left:3%;"l><em>Comment here :</em></label>
               <input style="margin: 0% 0 3% 2% ; border-left:none;border-top:none;border-right:none; border-bottom:1px solid black; outline:none; " type="text">
               <button style="padding:4px 6px ;border:none;background-color:#1C3879; color:white;  border-radius:3px;">Post</button> -->