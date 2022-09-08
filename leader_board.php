<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leader Board</title>

    <style>
        table {
            background-color: lightgoldenrodyellow;
            margin: 0% 0 0 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            width: 100%;
        }

        th {
            padding: 10px;
            /* border: 1px solid black; */
            background-color: lightsalmon;
        }

        td {
            padding-right: 20px;
            padding-left: 20px;
            /* border: 1px solid black; */
            font-style: italic;
            /* background-color: lightblue; */

        }

        h1 {
           
            height: 10vh;
            margin-top: 5%;

        }

        .container {
            /* background-color: lightyellow; */
            width: 70%;
            margin-top: 5vh;


        }


        /* .heading{
            background-color: lightgoldenrodyellow;
            width: ;
        } */

        #main {

            display: flex;
            justify-content: center;
            align-items: center;

        }

        @media (max-width: 540px) {

            .mobile {
                display: none;
            }

            table {
                margin: 9% 0 0 3%;
            }

            h1 {
                margin-top: 5%;
            }

        }
    </style>
</head>

<body>

    <?php include 'nav.php' ?>
    <section id="main">
        <div class="container">
            <div class="heading">
                <h1 style="font-size: 38px ; margin: 0% 0 0 0%">Leader Board</h1>
            </div>

            <table style="margin: 0% 0 0 0%  ; border:1px solid black">
                <tr>
                    <th>srno</th>
                    <th>Username</th>
                    <th class="mobile">Name</th>
                    <th class="mobile">branch</th>
                    <th class="mobile">passing year</th>
                    <th>likes</th>
                </tr>

                <?php
                include 'dbconnect.php';

                $sql = "select us.* , sum(up.like_count) as likes, sum(up.dislike_count) as dislike , status from user2002 us left join (Select distinct user_id , liked_user_id , like_count ,dislike_count , status from user_profile Group by liked_user_id ,user_id Order by user_id) as up on up.liked_user_id = us.srno group by us.srno order by likes desc";

                $result = mysqli_query($conn, $sql);
                $srno = 1;

                while ($row = mysqli_fetch_assoc($result)) {

                    echo "

   <tr>
   <td>" . $srno . "</td>
   <td>" . $row['username'] . "</td>
   <td class='mobile'>" . $row['fullname'] . "</td>
   <td class='mobile'>" . $row['branch'] . "</td>
   <td class='mobile'>" . $row['passingyear'] . "</td>
   <td>" . $row['likes'] . "</td>
   </tr>
   
   
   ";
                    $srno++;
                }



                ?>
            </table>
        </div>

    </section>

    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>

</html>