<?php
session_start();
if(isset($_SESSION['current_user'])){
    $user = $_SESSION['current_user'];
}else{
    echo "<script>
    window.location = './index.php';
    </script>";
}

//if upload button is pressed
if(isset($_POST['upload'])){

    //the path to store the uploaded image or file
    $targetf = "files/".basename($_FILES['file']['name']);
    //connect to database
    include './db.php';
    $con = open();

    //get all the submitted data from the form
    $file= $_FILES['file']['name'];
    $name= $_POST['name'];
    $text=$_POST['text'];

    /*$extensioni = strtolower(substr($image, strpos($image, '.')+1));
    $extensionf = strtolower(substr($file, strpos($file, '.')+1));*/

    $user=$_SESSION['current_user'];
    $sql="select * from hassy where name='$user'";
    $result=mysqli_query($con,$sql);
    $row= mysqli_fetch_array($result);
    $id = $row['id'];
    $uname=$row['name'];

    /*if($extensioni=='jpg' || $extensioni=='jpeg' || $extensioni=='png' && $extensionf=='pdf' || $extensionf=='docx' || $extensionf=='doc'){*/
        $query= "insert into files(file, name, text, user_id, uname) values('$file', '$name', '$text', '$id', '$uname')";
        mysqli_query($con, $query);//stores the submitted data into the database table: upload

        //Now let move the uploaded image or file into the folder:images or files
        if(move_uploaded_file($_FILES['file']['tmp_name'], $targetf)){
            echo '<script>window.alert("File uploaded successfully")</script>';
            header("refresh:2; url= test.php");
        }else{
            echo '<script>window.alert("Problem uploading File 😓")</script>';
            header("refresh:2; url= test.php");
        }
    }else{
        echo '<script>window.alert("Unsupported Format ⚠")</script>';
        header("refresh:2; url= test.php");
    }/*
}*/
?>