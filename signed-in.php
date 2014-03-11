<?php
ob_start();
session_start();
?>

<html>
<head>
	<title>
		wait work for sign-in is in progress 
	</title>
</head>
<body>
<?php
	include'connect.php';
	if(!isset($_POST['id']))
	{header("location:signin.php");}
	if(!$con)
	{
		$_SESSION['login']="Sorry! error in database";
		header("location:signin.php");
	}
	else
	{$count=0;
		$result=mysqli_query($con,'select password from users where id="'.$_POST['id'].'"');
		while($row=mysqli_fetch_array($result))
		{$count=$count+1;
			if($row[0]==$_POST['password'])
			{
				$_SESSION['login']="";
				$_SESSION['loggedin']=1;
				$_SESSION['user']=$_POST['id'];
				header("location:index1.php");
			}
			else
			{
				$_SESSION['login']="wrong email or password";
				header("location:signin.php");
			}
		}
		if($count==0)
		{
			$_SESSION['login']="wrong email or password";
			header("location:signin.php");
		}
	}
?>
</body>
</html>