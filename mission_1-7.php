﻿<html>

<head>
<meta charset="utf-8">
</head>

<body>
<form action="mission_1-7.php" method="post">
 <input type="text" name="comment" value="コメント">
 <input type="submit" value="送信" >
</form>
<?php
if(isset($_POST['comment'])&& $_POST['comment']!="")
{
$comment=$_POST['comment'];

$filename='mission_1-6_Shinoda.txt';
$fp=fopen($filename,'a');
fwrite($fp,$comment."\n");
fclose($fp);

}

$filename="mission_1-6_Shinoda.txt";
$lines=file($filename);
foreach($lines as $value)
{
echo $value."<br />\n";
}
?>
</body>
</html>