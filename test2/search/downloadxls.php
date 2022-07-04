<?php
#连接数据库
require_once 'connect.php';

#导入spreasheet库
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

#创建一个新的excel数据表
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

#id=filename（数据库中的文件名、描述子表格的名字） , $name=氨基酸描述子名称
$id=$_GET['id'];
$name=$_GET['name'];

#得到数据库的描述子表格数据，把它放入数组$rows中
$sql="SELECT * FROM $id";
$result=$db->query($sql);

$rows=[];

while ($row=$result->fetch_assoc()) {
	$rows[]=$row;
}

#运用fromarray函数给数据表写入数据，把数组直接写入数据表

$sheet->fromArray($rows);

# Xlsx类 将电子表格保存到文件
$writer = new Xlsx($spreadsheet);
$writer->save("downloadxlsfile/$name.xlsx");

#原来使用的方法：
	#把数据写入xls文件，放入downlfile目录下（原生代码的方法，下载后文件打开会报错：“文件的格式和扩展名不匹配”）
	#创建文件
	/*
	$handle=fopen("downloadxlsfile/$id.xls", 'w');
	#遍历数组数据把他们写入文件
	foreach ($rows as $key => $value) {
		foreach ($value as $a) {
			file_put_contents("downloadxlsfile/$id.xls", $a."\t",FILE_APPEND);
		}
		file_put_contents("downloadxlsfile/$id.xls", "\n",FILE_APPEND);

	}
	fclose($handle);
	*/



// 客户端文件下载
	header('Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition:attachment;filename=$name.xlsx");
    header('Cache-Control:max-age=0');
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
