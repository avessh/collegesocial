<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="../avesh/style/nav.css">
    <title>nav</title>
</head>

<body>
    <section id="mainsection">
        <nav id="topnav">

            <div id="nav-left">
                <ul id="left-ul" class="active">

                    <li class="left-li"><img id="logo" src="../avesh/img/logoWithoutBackground.png" alt=""></li>
                    <li class="left-li"> <a href="index.php">Home</a></li>
                    <li class="left-li"><a href="leader_board.php">Leader Board</a> </li>
                    <li class="left-li"> <a href="about.php">About us</a></li>

                </ul>

                <div id="nav-right">

                    <form action="../avesh/search.php" method="GET">
                        <ul id="right-ul">
                            <li class="right-li"> <input type="checkbox" id="click">
                                <label for="click" class="menu-btn">
                                    <i id="burger-menu" class="fas fa-bars"></i>
                                </label>
                            </li>
                            <li class="right-li">
                                <input formaction="../avesh/user_profile.php" type="search" name="search-profile" id="search-profile" placeholder="search">
                            <li class="right-li"><Button type="submit" id="search-btn">Go</Button></li>
                            <?php
                            if ($_SERVER['REQUEST_METHID'] == 'POST') {

                                $profile = $_GET['search-profile'];
                            }

                            ?>



                            <li class="right-li"> <a href="profile.php"><?php echo "Welcome" . "&nbsp" . "&nbsp" . $_SESSION['username'] ?> </a></li>

                            <a href="logout.php">
                                <li class="right-li">
                                    <div id="logoutbtn">Logout</div>
                                </li>
                            </a>





                        </ul>

                    </form>

                    </li>



                </div>
            </div>



        </nav>

    </section>
    <script>

    </script>
</body>

</html>