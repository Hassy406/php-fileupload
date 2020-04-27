<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
</head>
<body>
    <form action="search.php" method="post">
        <input type="text" name="search" placeholder="Search.....">
        <input type="submit" value=">>">
    </form>
</body>
</html>


<?php
    include './db.php';
    $con =open();
    if(isset($_POST['search'])){
        $search = $_POST['search'];
        $search = preg_replace("#[^0-9a-z]#i","",$search);

        $query = "select * from images where text like '%$search%'";
        $result = mysqli_query($con,$query);
        $count = mysqli_num_rows($result);
        if($count==0){
            echo "There is no such images!";
        }else{
            while($row=mysqli_fetch_array($result)){
                echo "<div id='img_div'>";
                echo "<img width=100 height=100 src='images/".$row['image']."'>";
                echo "<a href ='images/".$row['image']."'><h3>Click to Download Image</h3></a>";
                echo "<p>".$row['text']."</p>";
                echo "</div>";
            }
        }
        
        $query = "select * from files where text like '%$search%'";
        $result = mysqli_query($con,$query);
        $count = mysqli_num_rows($result);
        if($count==0){
            echo "There is no such Files!";
        }else{
            while($row=mysqli_fetch_array($result)){
                echo "<a href ='files/".$row['file']."'><h3>".$row['name']."</h3></a>";
                echo "<p>".$row['text']."</p>";
            }
        }
    }
?>