<?php
require_once 'connect.php';
$name=$_GET['id'];
$id=$_GET['name'];
$now   = time();
$ctime = date('YmdHis', $now);

#得到数据库的描述子表格数据，把它放入数组$rows中
$sql="SELECT * FROM $name";
$result=$db->query($sql);

$rows=[];

while ($row=$result->fetch_assoc()) {
	$rows[]=$row;
}


#把数据写入txt文件，放入downlfile目录下

#创建文件
$handle=fopen("/home/hj/immunet/www/PQsarDB/search/downloadtxtfile/$id$ctime.txt", 'w');
#遍历数组数据把他们写入文件
foreach ($rows as $key => $value) {
	foreach ($value as $a) {
		file_put_contents("/home/hj/immunet/www/PQsarDB/search/downloadtxtfile/$id$ctime.txt", $a."\t",FILE_APPEND);
	}
	file_put_contents("/home/hj/immunet/www/PQsarDB/search/downloadtxtfile/$id$ctime.txt", "\n",FILE_APPEND);

}
fclose($handle);

#发送此txt文件提供下载
header("Content-Type:text/plain");
header("Content-Disposition: attachment;filename=$name.txt");

readfile("/home/hj/immunet/www/PQsarDB/search/downloadtxtfile/$id$ctime.txt"");
?>