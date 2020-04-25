<?php
session_start();
include './db.php';
$con = open();
$email = $_POST['email'];
$pass = $_POST['pass'];
if(isset($_POST['email'])){
    $query = "select * from hassy where email = '$email' && pass = '$pass'";
    $result = mysqli_query($con, $query);
    list($id, $name, $email_check, $pass)=mysqli_fetch_row($result);
    if($email_check == $email){
        $_SESSION['current_user'] = $name;
        $_SESSION['user_id'] = $id;
        echo"<script>
        window.alert('Hola');
        window.location='./test.php';
        </script>";
    }else{
        echo"<script>
        window.alert('Username or password is wrong');
        window.location='./index.php';
        </script>";
    }
}else{
    echo"<script>
    window.alert('Login Again😥');
    window.location='./index.php';
    </script>";
}
?>