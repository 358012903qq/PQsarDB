<?php
$host = '127.0.0.1';
$root="root";
$pwd="";
$dbname='qsar';

$db = new mysqli($host,$root,$pwd,$dbname);
if($db->connect_errno <> 0){
	echo "链接失败";
	echo $db->connect_error;
	exit;
}

$db->query("SET NAME UTF8");
?>
