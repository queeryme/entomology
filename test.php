<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
	$a='hello';
	${$a}='world';
	echo $hello;
	echo 'hellos\n';
	
	$array=array(1,2,3,4,5,'a');
	$callback='is_int';
	$array=array_filter($array,$callback);
	echo '<br>';
	print_r($array);
	echo '<br>'.$_SERVER['REQUEST_TIME'];
	echo '<br>';
	print_r(preg_split('/\{[0-9]{1,}\}/','This is {0} error {1}'));
?>

</body>
</html>