<?php
ob_start();
session_start();
?>

<html>
<head>
	<title>
		Chat Application Sign-in Page
	</title>
	<link href="signin.css" rel="stylesheet">
	<link href="bootstrap.css" rel="stylesheet">
	<link href="allheader.css" rel="stylesheet">
</head>
<body>
<?php
	$problem="";
	if(isset($_SESSION['login']))
	{
		$problem=$_SESSION['login'];
	}
	if(isset($_SESSION['user']))
	{
		header("location:index1.php");
	}
?>
<div class="col-md-12 header1">Online Chat Application</div>
<div class="col-md-12 content1">
	<div class="container">

      <form class="form-signin" style="margin-top:50px;margin-bottom:0px;" action="signed-in.php" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
		<h6 id="wrongpass" style="color:red;"><?php echo $problem ?></h6>
        <input type="email" name="id" class="form-control" placeholder="Email address" autofocus required>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div>
</div>
<div class="col-md-12 footer1">
	<p class="col-md-3">&copy; copyright <br>All rights reserved <br>don't copy any content of this page</p>
	<p class="col-md-3">Contact <br>+918609254757</p>
	<p class="col-md-3">E-mail <br>d4dilip7@gmail.com<br>d4dilip7@live.com</p>
	<p class="col-md-3">Dilip Kumar <br>Proudly Created a Demo Project</p>
</div>	
</body>
</html>