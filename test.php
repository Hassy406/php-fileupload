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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Uploder</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
<?php
    include './db.php';
    $con =open();
    $query1 = "select * from hassy where name='$user'";
    $result1 = mysqli_query($con,$query1);
    $row1 = mysqli_fetch_array($result1);
    $id = $row1["id"];
    $query = "select name, text, user_id from images where user_id=$id";
    $result = mysqli_query($con,$query);
    $rowcount = mysqli_num_rows($result);
    
    $query1 = "select name, text, user_id from files where user_id=$id";
    $result1 = mysqli_query($con,$query1);
    $rowcount1 = mysqli_num_rows($result1);
    /*$db =mysqli_connect('localhost','root','','phpprac');
    $query="select * from images";
    $result= mysqli_query($db,$query);

    while($row=mysqli_fetch_array($result)){
        echo "<div id='img_div'>";
            echo "<img width=100 height=100 src='images/".$row['image']."'>";
            echo "<p>".$row['text']."</p>";
        echo "</div>";
    }*/
    ?>
    <div class="row">
    <div class="col-md-5">
    <div id="content">
        <form action="image.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="size" value="1000000">
            <div> 
                <label>Image </label><input type="file" name="image" accept=".png,.jpg,.jpeg" required="">
            </div>
            <div> 
                <input type="text" name="name" placeholder="Image Name" required="">
            </div>
            <div>
                <textarea name="text" cols="20" rows="4" placeholder="Add Describe...."></textarea>
            </div>
            <div>
                <input type="submit" name="upload" value="Upload">
            </div>
        </form>
    </div>
    <center><h1 style="color:white;">Ideas uploaded</h1></center>
    <center><table border="1">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Text</th>
    </tr>
    <?php
    for($i=1;$i<=$rowcount;$i++)
    {
        $row = mysqli_fetch_array($result);
    ?>
    <tr>
        <td><?php echo $row["user_id"] ?></td>
        <td><?php echo $row["name"] ?></td>
        <td><?php echo $row["text"] ?></td>
    </tr>
    <?php
    }
    ?>
    </table>
    </center>
    </div>
    <div class="col-md-2">
        <center><a href="search.php"><input type="button" name="search" value="Search"></a></center>
    </div>
    <div class="col-md-5">
    <div id="content">
        <form action="file.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="size" value="1000000">
            <div> 
                <label>File </label><input type="file" name="file" accept=".doc,.docx,.pfd" required="">
            </div>
            <div> 
                <input type="text" name="name" placeholder="File Name" required="">
            </div>
            <div>
                <textarea name="text" cols="20" rows="4" placeholder="Add Describe...."></textarea>
            </div>
            <div>
                <input type="submit" name="upload" value="Upload">
            </div>
        </form>
    </div>
    <center><h1 style="color:white;">Ideas uploaded</h1></center>
    <center><table border="1">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Text</th>
    </tr>
    <?php
    for($i=1;$i<=$rowcount1;$i++)
    {
        $row = mysqli_fetch_array($result1);
    ?>
    <tr>
        <td><?php echo $row["user_id"] ?></td>
        <td><?php echo $row["name"] ?></td>
        <td><?php echo $row["text"] ?></td>
    </tr>
    <?php
    }
    ?>
    </table>
    </center>
    </div>
    </div>

</body>
</html>