<?php

session_start();
if(isset($_SESSION['current_user'])){
    $user = $_SESSION['current_user'];
    echo "<center><h1>Hello " . $user . "</h1>";
    echo "<button class='btn btn-success'><a style='color: blue;' href='./index.php'>Logout</a></button></center>";
}else{
    echo "<script>
    window.location = './index.php';
    </script>";
}

$msg = "";

//if upload button is pressed
if(isset($_POST['upload'])){

    //the path to store the uploaded image or file
    $targeti = "images/".basename($_FILES['image']['name']);
    $targetf = "files/".basename($_FILES['file']['name']);
    //connect to database
    include './db.php';
    $con = open();

    //get all the submitted data from the form
    $image= $_FILES['image']['name'];
    $file= $_FILES['file']['name'];
    $text=$_POST['text'];

    /*$extensioni = strtolower(substr($image, strpos($image, '.')+1));
    $extensionf = strtolower(substr($file, strpos($file, '.')+1));*/

    $user=$_SESSION['current_user'];
    $sql="select * from hassy where name='$user'";
    $result=mysqli_query($con,$sql);
    $row= mysqli_fetch_array($result);
    $id = $row['id'];

    /*if($extensioni=='jpg' || $extensioni=='jpeg' || $extensioni=='png' && $extensionf=='pdf' || $extensionf=='docx' || $extensionf=='doc'){*/
        $query= "insert into images(image, file, text, user_id) values('$image', '$file', '$text', '$id')";
        mysqli_query($con, $query);//stores the submitted data into the database table: upload

        //Now let move the uploaded image or file into the folder:images or files
        if(move_uploaded_file($_FILES['image']['tmp_name'], $targeti) || move_uploaded_file($_FILES['file']['tmp_name'], $targetf)){
            $msg= "uploaded successfully";
        }else{
            $msg= "Problem uploading 😓";
        }
    }else{
        $msg= "Unsupported Format ⚠";
    }/*
}*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Uploder</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
    <div id="content">
        <form action="test.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="size" value="1000000">
            <div> 
                <label>Image </label><input type="file" name="image" accept=".png,.jpg,.jpeg">
            </div>
            <div> 
                <label>File </label><input type="file" name="file" accept=".doc,.docx,.pfd">
            </div>
            <div>
                <textarea name="text" cols="20" rows="4" placeholder="Add Describe...."></textarea>
            </div>
            <div>
                <input type="submit" name="upload" value="Upload">
            </div>
            <div>
                <a href="search.php"><input type="button" name="search" value="Search"></a>
            </div>
        </form>
    </div>
    <?php
    $db =mysqli_connect('localhost','root','','phpprac');
    $query="select * from images";
    $result= mysqli_query($db,$query);

    while($row=mysqli_fetch_array($result)){
        echo "<div id='img_div'>";
            echo "<img width=100 height=100 src='images/".$row['image']."'>";
            echo "<p>".$row['text']."</p>";
        echo "</div>";
    }
    ?>
</body>
</html>