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

    //the path to store the uploaded image
    $target = "images/".basename($_FILES['image']['name']);

    //connect to database
    include './db.php';
    $con = open();

    //get all the submitted data from the form
    $image= $_FILES['image']['name'];
    $text=$_POST['text'];

    $user=$_SESSION['current_user'];
    $sql="select * from hassy where name='$user'";
    $result=mysqli_query($con,$sql);
    $row= mysqli_fetch_array($result);
    $id = $row['id'];

    $query="insert into images(image, text, user_id) values('$image', '$text', '$id')";
    mysqli_query($con, $query);//stores the submitted data into the database table: upload

    //Now let move the uploaded image into the folder:images
    if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
        $msg= "Image uploaded successfully";
    }else{
        $msg= "Problem uploading image😓";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>UplodeHer</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
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
    <div id="content">
        <form action="test.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="size" value="1000000">
            <div> 
                <input type="file" name="image">
            </div>
            <div>
                <textarea name="text" cols="20" rows="4" placeholder="Describe your image...."></textarea>
            </div>
            <div>
                <input type="submit" name="upload" value="Upload Image">
            </div>
        </form>
    </div>
</body>
</html>