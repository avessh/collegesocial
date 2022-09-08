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
    <link rel="stylesheet" href="../avesh/style/user_profile.css">
    <title>user_profile</title>
</head>

<body>


    <!-- //php code for private post  ---------------------------------------------------------->

    <?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $private_post = $_GET['private_post'];

        include 'dbconnect.php';
        if (($conn) && ($private_post != "")) {
            $userprofile = $_SESSION['userprofilename'];

            $sql = "INSERT INTO `private_post` (`post_id`, `private_post`, `to_user`) VALUES (NULL, '{$private_post}', '{$userprofile}')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("location:user_profile.php");
            } else {
                echo "sadfsdaf";
            }
        }
    }

    ?>

    <!-- ----- ---------------------------------------------------------------------------- -->



    <?php include 'nav.php'; ?>
    <!-- //!code for navbar -->


    <!-- //! php code to fetch searched uerprofile  -->

    <?php

    include 'dbconnect.php';

    session_start();

    $profile  = $_SESSION['userprofilename'];


    $sql = "select * from user2002 where username = '$profile'";
    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);

    if ($num > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $profile_username = $row['username'];
            $profile_name = $row['fullname'];
            $profile_course = $row['course'];
            $profile_branch = $row['branch'];
            $profile_rollno = $row['rollno'];
            $profile_address = $row['address'];
            $profile_passingyear = $row['passingyear'];
            $profile_id = $row['srno'];
        }
    }
    // header('location:user_profile.php');
    ?>

    <!-- ----------------------------------------------------------------------------------------- -->

    <section id="cover-section">
        <div id="posting">
            <div id="userProfileImg">
                <img id="profile-img" src="../avesh/img/male-profile.jpg" alt="">
            </div>
            <div id="postText">
                <h3 id="textareaheading">Do you wanna tell me something !!</h3>
                <p style="font-size: 12px; margin-top:1%; margin-bottom:1%; color:red;"><b> * Whoever you send this post will neve gonna that it was send by you. </b></p>
                <p style="font-size: 12px; margin-top:1%; margin-bottom:1%; color:red;"><b> * Type the message carefully because once you post it you will not be able to edit or delete it</b></p>
                <form action="../avesh/user_profile.php" method="GET">
                    <textarea placeholder="Type here..." name="private_post" id="posttextarea" cols="30" rows="10"></textarea>
                    <button type="submit" id="postbtn">POST</button>
                </form>



            </div>
        </div>


        <!-- php code to insert the liked profile details and like dislike statud -->
        <?php

        $sql = "select us.* , sum(up.like_count) as likes, sum(up.dislike_count) as dislike , status from user2002 us left join (Select distinct user_id , liked_user_id , like_count ,dislike_count , status from user_profile Group by liked_user_id ,user_id Order by user_id) as up on up.liked_user_id = us.srno where liked_user_id = '$profile_id' group by us.srno order by likes desc";
        $result = mysqli_query($conn, $sql);

        $num = mysqli_num_rows($result);


        while ($row = mysqli_fetch_assoc($result)) {

            $total_like = $row['likes'];

            $status = $row['status'];
        }



        ?>



        <div id="postlike">
            <div id="totallike">
                <p class="totallikeclass"> <b> Total people like <?php echo $profile_username  ?> in college :</b> <b> <?php echo $total_like ?> </b> </p>

            </div>
            <h3>Do you?</h3>
            <form action="../avesh/user_profile_like.php" method="POST">
                <input type="hidden" name="profile_id" value="<?php echo $profile_id; ?>">
                <input type="hidden" name="to_user" value="<?php echo $people_get_liked; ?>">
                <input type="hidden" name="profile_like" value="<?php echo $profile_like_count; ?>">
                <input type="hidden" name="profile_dislike" value="<?php echo $profile_dislike_count; ?>">
                <p style="font-size: 12px; margin-top:1%; color:red;"><b>*** once you like this profile you not be able to undo like ***</b></p>
                <button style="background-color : #1C3879; color: white ;" type="submit" id="likebtn">LIKE<?php echo $statement ?> </button>

            </form>



        </div>

    </section>

    <section id="content">
        <div id="content-detail">
            <h1 id="profileName"><?php echo $profile_name;
                                    echo "   ";
                                    echo "|<em style=' color:#1C3879; font-size:22px;'> (" . $profile . ")</em> " ?> </h1>
            <p class="para"><?php echo $profile_rollno ?></p>
            <p class="para"><?php echo $profile_branch ?></p>
            <p class="para"><?php echo $profile_course;
                            echo " ' ";
                            echo $profile_passingyear; ?></p>
            <p class="para"><?php echo $profile_address ?></p>


        </div>

    </section>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        let btn = document.getElementById('likebtn').onclick = function() {
            let btnn = document.getElementById('likebtn').style.backgroundColor = 'red';
            // event.preventDefault();/
        }
    </script>




</body>

</html>












<!-- <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo $people_who_like;
            //   getting the id 
            include 'dbconnect.php';
            $sql = "SELECT * FROM `user_profile` where to_user = '$profile_username'";
            $result = mysqli_query($conn, $sql);
            if ($row = mysqli_fetch_assoc($result)) {
                $profile_id = $row['id'];
            }

            // selecting the row from id
            session_start();
            echo $people_who_like;
            $people_who_like = $_SESSION['username'];
            $sql =  "SELECT `id` FROM `user_profile` WHERE id = '{$profile_id}'";
            $result = mysqli_query($conn, $sql);
            $id_num = mysqli_num_rows($result);
            echo $id_num;
            $sql =  "SELECT `username` FROM `user_profile` WHERE username = '{$people_who_like}'";
            $result = mysqli_query($conn, $sql);
            $people_who_like_num = mysqli_num_rows($result);
            echo  $people_who_like_num;

            if (($id_num > 0) || ($people_who_like_num > 0)) {
                echo "already liked by and disliked by this user";
            } else {



                // if the profile is already liked then minus the like count 
                if ($id_num > 0) {
                    $sql = "SELECT * FROM `user_profile` where to_user = '$profile_username'";
                    $result = mysqli_query($conn, $sql);
                    if ($row = mysqli_fetch_assoc($result)) {
                        $profile_id = $row['id'];
                        $people_who_like = $row['username'];
                        $people_get_liked = $row['to_user'];
                        echo $people_get_liked;
                        $profile_like_count = $row['profile_like'];
                        echo $profile_like_count;
                        $profile_dislike_count = $row['profile_dislike'];
                        $like_status = $row['status'];
                    }
                    if ($like_status == 'not_liked') {
                        $sql =  "UPDATE `user_profile` SET `profile_like` = '$profile_like_count'+1, `status` = 'liked' WHERE `user_profile`.`id` = '$profile_id'; ";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            echo "updation is successful";
                            echo $profile_like_count;
                        }
                    }
                    // if the profile is not liked the plus the like count
                    if ($like_status != 'not_liked') {
                        $sql =  "UPDATE `user_profile` SET `profile_like` = '$profile_like_count' -1, `status` = 'not_liked' WHERE `user_profile`.`id` = $profile_id; ";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            echo "updation is successful";
                            echo $profile_like_count;
                        }
                    }
                    echo "already liked";

                    //inserting the data in table 
                } else {
                    $sql = "INSERT INTO `user_profile` (`id`, `username`, `to_user`, `profile_like`, `profile_dislike`, `date`, `status`) VALUES (NULL, '$people_who_like', '$profile_username', '0', '0', current_timestamp(), 'not_liked') ";

                    $result = mysqli_query($conn, $sql);
                    $sql = "SELECT * FROM `user_profile` where to_user = '$profile_username'";
                    $result = mysqli_query($conn, $sql);
                    if ($row = mysqli_fetch_assoc($result)) {
                        $profile_id = $row['id'];
                        $people_who_like = $row['username'];
                        $people_get_liked = $row['to_user'];
                        echo $people_get_liked;
                        $profile_like_count = $row['profile_like'];
                        echo $profile_like_count;
                        $profile_dislike_count = $row['profile_dislike'];
                        $like_status = $row['status'];
                    }
                    echo $like_status . '<br>';
                    echo $profile_like_count;
                    echo $profile_id;

                    if ($like_status == 'not_liked') {
                        $sql =  "UPDATE `user_profile` SET `profile_like` = '$profile_like_count'+1, `status` = 'liked' WHERE `user_profile`.`id` = '$profile_id'; ";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            echo "updation is successful";
                            echo $profile_like_count;
                        }
                    }
                }
            }
        }

        ?> -->