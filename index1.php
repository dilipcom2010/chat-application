<?php
ob_start();
session_start();
?>

<html>
<head>
	<title>
		Online Chat Application
	</title>
	<link href="bootstrap.css" rel="stylesheet">
	<link href="allheader.css" rel="stylesheet">
	
	<style>
		.icon1
		{height:35px; width:35px;}
		.icon2
		{
			width:40px;padding-left:5px;
		}
		.name1{width:180px; overflow:hidden;cursor:pointer;}
		.status1{width:20px;}
		.table1
		{
			width:250px; border:1px solid #8899c5;
			border-top-left-radius:15px;
			border-top-right-radius:15px;
			font-family:arial; font-size:14px;
		}
		.table1 th
		{background-color:#8872c5;color:white;padding-top:7px;padding-bottom:7px;padding-left:5px;}
		.table1 tr
		{border-left:0px;border-right:0px; border-top:0px; border-bottom:0px;}
		.usericon
		{
			float:right;
			margin-top:10px;
			cursor:pointer;
		}
		#uop
		{
			height:200px; width:200px; border:1px solid #d8d8d8;
			background-color:pink;
			position:absolute;z-index:5;
			display:none;
			margin-left:1122px; margin-top:-12px;
		}
		
	</style>
	
	<script>
	var logoutc=0;
	function logout()
	{
		//document.write("hii");
		if(logoutc==0){document.getElementById("uop").style.display="block"; logoutc=1;}
		else{document.getElementById("uop").style.display="none"; logoutc=0;}
	}
		function chaton(n)
		{
			//document.write('header("location:chatbox.php");');
			document.getElementById("table1").style.webkitTransform="translate(1000px,0px)";
			
			var xmlhttp;
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
				document.getElementById("content1").innerHTML=xmlhttp.responseText;
				}
			}

			var queryString = "?userto="+n;
			xmlhttp.open("GET", "chatbox.php" + queryString, true);

			xmlhttp.send();
			continuechat();
		}
		
		function continuechat()
		{
			var xmlhttp;
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
				//document.getElementById("content1").innerHTML=xmlhttp.responseText;
					var v1=xmlhttp.responseText;
					//document.write(v1.length);
					if(v1.length==244)
					{}
					else
					{
					//document.write(xmlhttp.responseText);
						var gh = document.createElement('div');
						gh.innerHTML=xmlhttp.responseText;
						gh.style.backgroundColor="lightyellow";
						gh.style.padding="5px";
						gh.style.float="left";
						gh.style.maxWidth="210px";
						gh.style.margin="2.5px";
						gh.style.display="block";
						gh.style.borderRadius="5px";
						document.getElementById("msgcontainer").appendChild(gh);
						//document.getElementById("msgcontainer").innerHTML="DILIP";
					}
				}
			}

			//var queryString = "?userto="+n;
			xmlhttp.open("GET", "continuechat.php", true);

			xmlhttp.send();
			setTimeout("continuechat()",500);
		}
	</script>
	
	<script>
		function jmsg(e)
		{
			//document.write("hello dear");
			if(e.which==13)
			{
				var node1=document.getElementById("msgcontainer");
				var node2=document.getElementById("msg").value;
				var node3=document.getElementById("msg")
				//node1.innerHTML=node1.innerHTML+node2;
				//node2.value="";
				
				var f = document.createElement('div');
				f.style.marginRight="20px";
				f.style.width="280px";
				f.style.height="auto";
				f.style.float="left";
				//f.style.backgroundColor="red";
				
				var g = document.createElement('div');
				//g.innerHTML=node2;
				g.style.backgroundColor="pink";
				g.style.padding="5px";
				g.style.float="right";
				g.style.maxWidth="200px";
				g.style.margin="2.5px";
				//g.style.display="block";
				g.style.borderRadius="5px";
				g.innerHTML=node2;
				f.appendChild(g);
				node1.appendChild(f);
				
				node3.innerHTML="";
				updatedbase(node2);
				//node2.setValue="";
				//g.id = 'someId';
			}
		}
		
		function updatedbase(n1)
		{	
			var xmlhttp;
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
			//if (xmlhttp.readyState==4 && xmlhttp.status==200)
				//{
				//document.getElementById("content1").innerHTML=xmlhttp.responseText;
				//}
			}

			var queryString = "?usermsg="+n1;
			xmlhttp.open("GET", "updatedbase.php" + queryString, true);

			xmlhttp.send();
			
		}
	</script>
</head>
<body>

<?php
	function pmsg()
	{
		echo "hrlo";
	}
?>




<?php
if(!isset($_SESSION['loggedin']))
{header("location:signin.php");}
else
{
	include 'connect.php';
	if(!$con)
	{echo'Sorry! unable to connect database';}
	else
		{
			$result1=mysqli_query($con,'select *from users where id="'.$_SESSION['user'].'"');
			$row1=mysqli_fetch_array($result1);
			echo'<div class="col-md-12 header1">Online Chat Application<img onclick="logout()" id="usericon" class="icon1 usericon" src="'.$row1[3].'">';
			echo'<div id="uop"><a href="logout.php">logout</a></div></div>';
?>

<div class="col-md-12 content1" id="content1">
	<table class="table1" id="table1">
		<thead>
			<th colspan="3">Chat</th>
		</thead>
		<tbody>
		<?php
				$result=mysqli_query($con,'select *from users where id !="'.$_SESSION['user'].'"');
				if($result)
				{
					while($row=mysqli_fetch_array($result))
					{
						echo'<tr onclick="chaton('.$row[0].')"><td class="icon2"><img class="icon1" src="'.$row[3].'"></td><td class="name1">'.$row[1].'</td><td class="status1">'.$row[5].'</td></tr>';
					}
				}
				//echo'<tr><td></td><td></td><td></td></tr>';
			}
		?>
		</tbody>
	</table>
</div>
<div class="col-md-12 footer1">
	<p class="col-md-3">&copy; copyright <br>All rights reserved <br>don't copy any content of this page</p>
	<p class="col-md-3">Contact <br>+918609254757</p>
	<p class="col-md-3">E-mail <br>d4dilip7@gmail.com<br>d4dilip7@live.com</p>
	<p class="col-md-3">Dilip Kumar <br>Proudly Created a Demo Project</p>
</div>

<?php
}
?>


<script>
</script>
</body>
</html>