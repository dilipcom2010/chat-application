<?php
ob_start();
session_start();
?>


<html>
<head>
</head>
<body>
<?php
ob_start();
session_start();
session_destroy();
header("location:signin.php");
?>
</body>
</html>