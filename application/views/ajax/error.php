<?php
header('HTTP/1.1 499 APPLICATION ERROR');//using customized header error
$json_data=array(
	'code'=>$code,
	'data'=>$data
);
echo json_encode($json_data);