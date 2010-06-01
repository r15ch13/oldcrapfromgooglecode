<?php
//echo "/dev/null";
require_once('config.php');
//require_once('class.Type.php');

echo "<pre>";
$str = "500+12-4+2";

$n1 = '';
$n2 = '';

$asd = explode('+', $str);
foreach($asd as $k => $v) {
	$n1 += trim($v);
}
print_a($asd);


for($i=0;$i<strlen($str);$i++) {
	if(is_numeric($str{$i})) {
		//$n1.=$str{$i};
	} else if($str{$i} == '+') {
		//$n1
	}
}
echo $n1;
?>