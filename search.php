<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/community/logo_transparent.png">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <style>
         input[type=text] {
            width: 150px;
            box-sizing: border-box;
            border: 2px solid #ff5c97;
            border-radius: 20px;
            font-size: 16px;
            background-color: white;
            background-image: url('searchicon.png');
            background-position: 10px 10px;
            background-repeat: no-repeat;
            padding: 12px 20px 12px 40px;
            transition: width 0.4s ease-in-out;
        }

        input[type=text]:focus {
            width: 50%;
        }

        .button {
            display: inline-block;
            padding: 3px 15px;
            font-size: 24px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #ff5c97;
            border: none;
            border-radius: 20px;
            box-shadow: 0 7px #999;
        }

        .button:hover {
            background-color: #ec4683
        }

        .button:active {
            background-color: #ff5c97;
            box-shadow: 0 5px #666;
            transform: translateY(4px);
        }

        body {
            background-color: #aea1ea; 
            /*background-image: url('assets/img/hero/h1_hero.png');*/
        }

        #content {
            border: 1px solid #ec4683;
            border-radius: 5px;
            /*background-color: #b2ebf9;*/
            padding-top: 1px;
            padding-left: 10px;
            padding-bottom: 1px;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Poppins", sans-serif;
            color: #2b4b80;
            /*margin-top: 2px;*/
            font-style: normal;
            font-weight: 500;
            text-transform: normal
        }

        p {
            font-family: "Poppins", sans-serif;
            color: #707b8e;
            font-size: 16px;
            line-height: 30px;
            margin-bottom: 15px;
            font-weight: normal
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="col-2">
            <center><img width="100" height="100" src="assets/img/community/logo_transparent.png" alt=""></center>
        </div>
        <div class="col-8 bar">
            <center style="margin-top: 30px;">
                <form action="search.php" method="post">
                    <input class="searchbar" type="text" name="search" placeholder="Search....." required="">
                    <input class="button" type="submit" value="🔎">
                </form>
            </center>
        </div>
        <!--<div class="col-1">
            <center><input class="button" type="submit" value="🔎"></center>
        </div>-->
        <div class="col-2">
            <center style="margin-top: 30px;"><button class='button'><a style='text-decoration: none; color: white;'
                        href='./index.php'>Logout</a></button></center>
        </div>
    </div>
    <br>
</body>

</html>

<?php
    if(isset($_SESSION['current_user'])){
        $user = $_SESSION['current_user'];
    }else{
        echo "<script>
        window.location = './search.php';
        </script>";
    }
    include './db.php';
    $con =open();
    if(isset($_POST['search'])){
        $search = $_POST['search'];
        $search = preg_replace("#[^0-9a-z]#i","",$search);
        $query = "select * from images where text like '%$search%' or name like '%$search%'";
        $result = mysqli_query($con,$query);
        $count = mysqli_num_rows($result);
        if($count==0){
            echo "<br><h3>There is no such images!</h3>";
        }else{
            while($row=mysqli_fetch_array($result)){
                echo "<div class=container>";
                echo "<div id=content>";
                echo "<div id='img_div'>";
                /*echo "<img width=100 height=100 src='images/".$row['image']."'>";*/
                echo "<a href ='images/".$row['image']."'><h2>".$row['name']."</h2></a>
                <h3>Image uploaded by ".$row['uname']." on ".$row['time']."</h3>";
                echo "<p>".$row['text']."</p>";
                echo "</div>";
                echo "</div>";
                echo "</div><br>";
            }
        }
        
        $query = "select * from files where text like '%$search%' or name like '%$search%'";
        $result = mysqli_query($con,$query);
        $count = mysqli_num_rows($result);
        if($count==0){
            echo "<br><h3>There is no such Files!</h3>";
        }else{
            while($row=mysqli_fetch_array($result)){
                echo "<div class=container>";
                echo "<div id=content>";
                echo "<a href ='files/".$row['file']."'><h2>".$row['name']."</h2></a>";
                echo "<h3>FIle uploaded by ".$row['uname']." on ".$row['time']."</h3>";
                echo "<p>".$row['text']."</p>";
                echo "</div>";
                echo "</div><br>";
            }
        }
    }
?>