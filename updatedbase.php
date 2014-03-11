<?php
ob_start();
session_start();
?>


<html>
<head>
</head>
<body>
<?php
	include'connect.php';
	if(!$con)
	{
		echo'sorry problem in database';
	}
	else
	{
		$result=mysqli_query($con,'insert into '.$_SESSION['table'].'('.$_SESSION['auserc'].') values("'.$_GET['usermsg'].'")');
		$row1=mysqli_fetch_array($result1);
		$usert=$row1[0];
	}
?>
</body>
</html>