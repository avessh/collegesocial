<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../avesh/style/search.css">
    <title>Home</title>
</head>

<body>

    <?php include 'nav.php' ?>

    <div class="container">


        <div class="contain">
            <h1>Here is your search results for <u> <em>"<?php echo  $_GET['search-profile'] ?>"</em></u></h1>
        </div>
    </div>

    <ul id="search-list">

        <?php

        include 'dbconnect.php';


        $query = $_GET['search-profile'];



        $sql = "select * from user2002 where match(username,fullname) against('$query') ";

        $result = mysqli_query($conn, $sql);

        $num = mysqli_num_rows($result);

        if ($num > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
                $fname1 = $row['fullname'];
                $profile_name = $row['username'];

              

                if ($profile_name != $_SESSION['username']) {

                    echo   " <form method='POST' action='../avesh/details.php'>
                    <input type='hidden' name='profile_name' value='$profile_name'>
                    <button type='submit' id='profileSubmitbtn'> 
                    <table id='seach-profile-table'> 
                    <tr>
                        <td id='th-left'><img id='prifile-photo-search' src='../avesh/img/male-profile.jpg'></td>
                        <td id='th-right'> <li id='list-items'> <p  style='margin:10% 0% 0% 0%; float:left;''>$profile_name</p> </li><br> <br><li style='width:15vh;' ><p style = 'float:left;' id='user-profile-fullname-id'> $fname1</p></li></td>
                    </tr>
                  
                </table> <hr>
                </button>
     
      </form> ";
                }
            }
        } else {
            echo "<h3>No record found</h3>";
        }


        // session_start();
        // $_SESSION['fullname1'] = $fname1;
        // $_SESSION['username1'] = $profile_name;

        ?>
    </ul>


    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>

</html>