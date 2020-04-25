<?php
include "./db.php";
$con=open();
$name=$_POST['name'];
$email=$_POST['email'];
$pass=$_POST['pass'];
$num=$_POST['num'];

$sql= "select * from hassy where name='$name'";
$run= mysqli_query($con,$sql);

if(mysqli_num_rows($run)>0){
    echo '<script>window.alert("Username already exists");
    window.location="./signup.html";</script>';

}else{
    $query="insert into hassy(name,email,pass,num) value('$name','$email','$pass','$num')";

    $result=mysqli_query($con,$query);
    if(!$result){
        echo '<script>window.alert("Not Inserted")</script>';
    }
    else{
        echo '<script>window.alert("Data inserted");
        window.location="./index.php";</script>';
    }
}
?>