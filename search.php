<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/community/logo_transparent.png">

    <style>
        input[type=text] {
            width: 150px;
            box-sizing: border-box;
            border: 2px solid #ccc;
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
            width: 20%;
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
        }

        #content {
            border-radius: 5px;
            background-color: #b2ebf9;
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
    <form action="search.php" method="post">
        <center><input type="text" name="search" placeholder="Search....." required="">
            <input class="button" type="submit" value="🔎"><br></center>
    </form>
</body>

</html>

<?php
    session_start();
    if(isset($_SESSION['current_user'])){
        $user = $_SESSION['current_user'];
    }else{
        echo "<script>
        window.location = './index.php';
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
                echo "<br><div id=content>";
                echo "<div id='img_div'>";
                /*echo "<img width=100 height=100 src='images/".$row['image']."'>";*/
                echo "<a href ='images/".$row['image']."'><h2>".$row['name']."</h2></a>
                <h3>Image uploaded by ".$row['uname']." on ".$row['time']."</h3>";
                echo "<p>".$row['text']."</p>";
                echo "</div>";
                echo "</div>";
            }
        }
        
        $query = "select * from files where text like '%$search%' or name like '%$search%'";
        $result = mysqli_query($con,$query);
        $count = mysqli_num_rows($result);
        if($count==0){
            echo "<br><h3>There is no such Files!</h3>";
        }else{
            while($row=mysqli_fetch_array($result)){
                echo "<br><div id=content>";
                echo "<a href ='files/".$row['file']."'><h2>".$row['name']."</h2></a>";
                echo "<h3>FIle uploaded by ".$row['uname']." on ".$row['time']."</h3>";
                echo "<p>".$row['text']."</p>";
                echo "</div>";
            }
        }
    }
?>