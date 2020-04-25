<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<head>
    <title>
        Login
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="style.css" rel="stylesheet" type="text/css" media="all" />
<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
</head>
<body>
<div class="main-w3layouts wrapper">
		<h1>LOGIN</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
                <form action="./login.php" method="post">
                    <input class="text email" type="email" name="email" placeholder="Email" required><br>
                    <input class="password" type="password" name="pass" placeholder="Password" required><br>
                    <input type="submit" value="LOGIN">
                </form>
				<p>Don't have an Account? <a href="signup.html"> Sign Up!</a></p>
			</div>
		</div>
		<ul class="cb">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
</body>
</html>