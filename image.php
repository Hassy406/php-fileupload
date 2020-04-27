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
    //connect to database
    include './db.php';
    $con = open();

    //get all the submitted data from the form
    $image= $_FILES['image']['name'];
    $name= $_POST['name'];
    $text=$_POST['text'];

    /*$extensioni = strtolower(substr($image, strpos($image, '.')+1));
    $extensionf = strtolower(substr($file, strpos($file, '.')+1));*/

    $user=$_SESSION['current_user'];
    $sql="select * from hassy where name='$user'";
    $result=mysqli_query($con,$sql);
    $row= mysqli_fetch_array($result);
    $id = $row['id'];

    /*if($extensioni=='jpg' || $extensioni=='jpeg' || $extensioni=='png' && $extensionf=='pdf' || $extensionf=='docx' || $extensionf=='doc'){*/
        $query= "insert into images(image, name, text, user_id) values('$image', '$name', '$text', '$id')";
        mysqli_query($con, $query);//stores the submitted data into the database table: upload

        //Now let move the uploaded image or file into the folder:images or files
        if(move_uploaded_file($_FILES['image']['tmp_name'], $targeti)){
            $msg= "uploaded successfully";
            header("refresh:2; url= test.php");
        }else{
            $msg= "Problem uploading 😓";
            header("refresh:2; url= test.php");
        }
    }else{
        $msg= "Unsupported Format ⚠";
        header("refresh:2; url= test.php");
    }/*
}*/
?>
