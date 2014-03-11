<?php
ob_start();
session_start();
?>


<html>
<head>
	<style>
		.from
		{
			height:auto;padding:5px;width:200px;
			margin:2.5px; border-radius:5px;
			background-color:lightblue;
			display:block;
			text-align:left;
		}
	</style>
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
		$zero=0; $one=1; 
		$x=0;
		$result=mysqli_query($con,'select '.$_SESSION['unauserc'].' from '.$_SESSION['table'].' where '.$_SESSION['unausersc'].'='.$zero.'');
		//echo'select '.$_SESSION['unauserc'].' from '.$_SESSION['table'].' where '.$_SESSION['unausersc'].'='.$zero.'';
		//echo'hi';
		while($row=mysqli_fetch_array($result))
		{
			$x=1;
			if($row[0]!="")
			{
				echo'<div class="from">'.$row[0].'</div>';
			}
		}
		if($x==0)
		{echo $x;}
		mysqli_query($con,'update '.$_SESSION['table'].' set '.$_SESSION['unausersc'].'='.$one.' where '.$_SESSION['unausersc'].'='.$zero.'');
	}
?>
</body>
</html>