<?php
ob_start();
session_start();
?>


<html>
<head>
	<style>
		.b1
		{
			height:400px; width:300px; border:1px solid #0072c5;float:right;
		}
		.b2
		{
			height:auto; width:298px; background-color:#0072c5;
			padding-top:10px; padding-bottom:10px;
			font-family:arial; font-size:14px; font-weight:bold; color:white;padding-left:5px;
			line-height:15px;
		}
		.b3
		{
			height:305px; width:298px; background-color:lightyellow;
			font-family:arial; font-size:12px; font-weight:normal; color:black;
			overflow:scroll;
		}
		.to
		{
			height:auto;padding:5px;width:200px;
			margin:2.5px; border-radius:5px;
			background-color:lightgreen;float:right;
			display:block; text-align:right;
			min-width:0px; min-height:0px;
		}
		.from
		{
			height:auto;padding:5px;width:200px;
			margin:2.5px; border-radius:5px;
			background-color:lightblue;float:left;
			display:block;
			text-align:left;
		}
		[title=text1]
		{
			width:298px;height:58px;resize:none;
			border:1px solid lightyellow;background-color:white;
		}
	</style>
</head>
<body>
<div class="b1">
<?php
	include 'connect.php';
	
	$result=mysqli_query($con,'select name from users where no='.$_GET['userto'].'');
	$row=mysqli_fetch_array($result);
	$user2chat=$row[0]; $user2=$_GET['userto'];
	
	$result1=mysqli_query($con,'select no from users where id="'.$_SESSION['user'].'"');
	$row1=mysqli_fetch_array($result1);
	$userf=$row1[0];
	$_SESSION['auser']=$userf;
	
	echo'<div class="b2">'.$user2chat.'</div>';
	echo'<div id="msgcontainer" class="b3">';
			
	//$table1="c".$user2."c".$userf;  $table2="c".$userf."c".$user2;
	if($user2>$userf)
	{
		$table1="t".$user2.$userf;
		$tn1="u".$user2; $tn2="u".$userf;
		$sts1="sts".$user2;  $sts2="sts".$userf;
		$x=1;
	}
	else
	{
		$table1="t".$userf.$user2;
		$tn1="u".$userf; $tn2="u".$user2;
		$sts1="sts".$userf;  $sts2="sts".$user2;
		$x=2;
	}
	//echo $table1;
	$result2=mysqli_query($con,'show tables');
	$count=0;
	while($row2=mysqli_fetch_array($result2))
	{
		if($row2[0]==$table1)
		{$count=$count+1;  break;}
	}
	//$tn1="u".$user2; $tn2="u".$userf;
	$_SESSION['auserc']="u".$userf;
	$_SESSION['unauserc']="u".$user2;
	$_SESSION['unausersc']="sts".$user2;
	$_SESSION['table']=$table1;
	$_SESSION['uf']=$userf;
	$_SESSION['ut']=$user2;
	$_SESSION['cn1']=$tn1;
	$_SESSION['cn2']=$tn2;
	if($count==0)
	{
		$result2=mysqli_query($con,'create table '.$table1.'('.$tn1.' varchar(200),'.$sts1.' int NOT NULL, '.$tn2.' varchar(200),'.$sts2.' int NOT NULL)');
		//echo'create table '.$table1.'('.$tn1.' varchar(200),'.$sts1.' int NOT NULL, '.$tn2.' varchar(200),'.$sts2.' int NOT NULL)';
	}
	else
	{
		$result2=mysqli_query($con,'select *from '.$table1.'');
		while($rowx=mysqli_fetch_array($result2))
		{
			if($x==1)
			{
				if($rowx[2]!="")
				{
					echo'<div class="to">'.$rowx[2].'</div>';
				}
				if($rowx[0]!="")
				{
					echo'<div class="from">'.$rowx[0].'</div>';
				}
			}
			else
			{
				if($rowx[0]!="")
				{
					echo'<div class="to">'.$rowx[0].'</div>';
				}
				if($rowx[2]!="")
				{
					echo'<div class="from">'.$rowx[2].'</div>';
				}
			}
		}
		
	}
	//echo $_SESSION['user'];
	echo'</div>';
?>
		<textarea id="msg" title="text1" onkeypress="jmsg(event)" autofocus></textarea>
</div>
</body>
</html>