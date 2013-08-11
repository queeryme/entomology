<?php
header("Content-type: text/binary");
$jquery_extension="JQ";
$string=file_get_contents("jquery-ui.css");
$matches=array();
$pattern="/[ ]([\w|\#|\-|\,|\.|\(|\)|\/|\%|\=]+)\/\*\{(\w+)\}\*\//";
$replacement=" <?=\$".$jquery_extension."[\"$2\"] ?>";
preg_match_all($pattern,$string,$matches);
$matches2=array();
$string2=preg_replace($pattern,$replacement,$string);
foreach($matches[2] as $key=>$value){
	$matches2[$value]=$matches[1][$key];
}
ksort($matches2);

echo "<?php\n";
echo "header(\"Content-type: text/css\");\n";
foreach($matches2 as $key=>$value){
	echo "\n\$".$jquery_extension."[\"".$key."\"]=\"".$value."\";";
}
echo "?>\n";
echo $string2;