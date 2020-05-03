<?php
session_start();
if(isset($_SESSION['current_user'])){
    $user = $_SESSION['current_user'];
    echo "<center style='margin-top: 20px;'><h1>Hello " . $user . "</h1>";
    echo "<button class='button'><a style='text-decoration: none; color: white;' href='./index.php'>Logout</a></button></center>";
}else{
    echo "<script>
    window.location = './index.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community</title>
    <link rel="shortcut icon" type="image/x-icon" href="./assets/img/community/logo_transparent.png">

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
        .button {
            display: inline-block;
            padding: 7px 20px;
            font-size: 24px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #ff5c97;
            border: none;
            border-radius: 15px;
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

        #content {
            border-radius: 5px;
            background-color: #b2ebf9;
            padding: 20px;
            width: 60%;
            margin: 20px auto;
            border: 2px solid #ff5c97;
        }

        form {
            width: 70%;
            margin: 10px auto;
        }

        form div {
            margin-top: 7px;
        }

        input[type=text],
        select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ff5c97;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea,
        select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ff5c97;
            border-radius: 4px;
            box-sizing: border-box;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Poppins", sans-serif;
            color: #2b4b80;
            margin-top: 0px;
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

        table {
            color: #333;
            /* Lighten up font color */
            font-family: Helvetica, Arial, sans-serif;
            /* Nicer font */
            width: 400px;
            border-collapse:
                collapse;
            border-spacing: 0;
        }

        td,
        th {
            border: 2px solid #ff5c97;
            height: 30px;
        }

        /* Make cells a bit taller */

        th {
            background: #F3F3F3;
            /* Light grey background */
            font-weight: bold;
            /* Make sure they're bold */
            text-align: center;
            /* Center our text */
        }

        td {
            background: #FAFAFA;
            /* Lighter grey background */
            text-align: center;
            /* Center our text */
        }

        body {
            background-color: #aea1ea;
            /*background-image: url('assets/img/hero/h1_hero.png');*/
        }
    </style>
</head>

<body>
    <?php
    include './db.php';
    $con =open();
    $query1 = "select * from hassy where name='$user'";
    $result1 = mysqli_query($con,$query1);
    $row1 = mysqli_fetch_array($result1);
    $id = $row1["id"];

    $query = "select name, text, user_id, time from images where user_id=$id";
    $result = mysqli_query($con,$query);
    $rowcount = mysqli_num_rows($result);
    
    $query2 = "select name, text, user_id, time from files where user_id=$id";
    $result2 = mysqli_query($con,$query2);
    $rowcount2 = mysqli_num_rows($result2);
    
    ?>
    <div class="row">
        <div class="col-md-5">
            <div id="content">
                <form action="image.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="size" value="1000000">
                    <div>
                        <center>
                            <h3><label>IMAGE</label></h3>
                        </center>
                        <input type="file" name="image" accept=".png,.jpg,.jpeg" required="">
                    </div>
                    <div>
                        <input type="text" name="name" placeholder="Image Name" required="">
                    </div>
                    <div>
                        <textarea name="text" cols="23" rows="4" placeholder="Add Describe...."></textarea>
                    </div>
                    <div>
                        <center><input class="button" type="submit" name="upload" value="Upload"></center>
                    </div>
                </form>
            </div>
            <center>
                <h4>Images uploaded</h4>
            </center>
            <center>
                <table border="1">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Text</th>
                        <th>Date & TIme</th>
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
                        <td><?php echo $row["time"] ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </table><br>
            </center>
        </div>
        <div class="col-md-2">
            <center>
                <a href="search.php"><input style="margin-top: 160px" class="button" type="button" name="search"
                        value="Search"></a>
            </center>
        </div>
        <div class="col-md-5">
            <div id="content">
                <form action="file.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="size" value="1000000">
                    <div>
                        <center>
                            <h3><label>FILE</label></h3>
                        </center>
                        <input type="file" name="file" accept=".doc,.docx,.pfd" required="">
                    </div>
                    <div>
                        <input type="text" name="name" placeholder="File Name" required="">
                    </div>
                    <div>
                        <textarea name="text" cols="23" rows="4" placeholder="Add Describe...."></textarea>
                    </div>
                    <div>
                        <center><input class="button" type="submit" name="upload" value="Upload"></center>
                    </div>
                </form>
            </div>
            <center>
                <h4>Files uploaded</h4>
            </center>
            <center>
                <table border="1">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Text</th>
                        <th>Date & TIme</th>
                    </tr>
                    <?php
                    for($i=1;$i<=$rowcount2;$i++)
                    {
                        $row = mysqli_fetch_array($result2);
                    ?>
                    <tr>
                        <td><?php echo $row["user_id"] ?></td>
                        <td><?php echo $row["name"] ?></td>
                        <td><?php echo $row["text"] ?></td>
                        <td><?php echo $row["time"] ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </table><br>
            </center>
        </div>
    </div>
</body>

</html>