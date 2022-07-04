

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
     
	<title>PQSAR</title>
		
		
		<!-- Custom CSS -->
		<link rel="stylesheet" href="../css/mycss.css">
		
	
		
		<!-- jQuery and Modernizr-->
		<script src="../js/jquery-2.1.1.js"></script>
		
		
		<!-- Core JavaScript Files -->  	 
		<script src="../js/bootstrap.min.js"></script>

	
</head>

<body id='body_one'>

<div id=main_body>

    <!--============================================================  Top部分  ============================================================-->
    <div id="toppage"> </div>
<script type="text/javascript">
    $("#toppage").load('./top1.html');
</script>
<!-- =================================================================  搜索框部分   ===================================-->
<div id="search" class="search-box">

                   <span id="tab">
                       <button type="button" id="tab1" class="search_button">search by name</button> 
                   </span>

                   <div id="searchcontainer">
                       <div id="searchbyname">
                            <form action="./peptides.php" method="get" autocomplete="off" style="width:100%;">
                            <input type="text" 
                            name="pname" class ="autosearch" autocomplete="on"  placeholder="Peptides name" >
                            <input class="submitcss" type="submit" value="Search"  >
                            </form>           
                        </div>
                    </div>
</div>
 <!-- =============================================================== 搜索结果表格部分=================================================================-->
       <hr>

       <div class="title_one">Search Result</div>

<?php
require_once 'connect.php';

$name = $_GET['pname'];
$sql="SELECT * FROM peptides WHERE 常用肽 like '%$name%'";
$result=$db->query($sql);

if ($result==false) {
	echo "sql语句错误";
	exit;
}

if ($result->num_rows==0) {
	die('<div style="text-align:center"> no result </div>');
}
#var_dump($result);
$rows=[];

while ( $row=$result->fetch_assoc()) {
	$rows[]=$row;
}

#var_dump($rows);
?>

	<table id="tab_1">
		

		<tr>
			<th>Active peptide</th>
			<th>No.</th>
			<th>Brief introduction</th>
			
		</tr>
	<tbody id="idData">
		<?php
		foreach ($rows as $row) {
		?>
		<tr>
			<td><a style="text-decoration: none;" href="bpinformation.php?id=<?php echo $row['常用肽']; ?> "><?php echo $row['常用肽']  ?></a></td>
			<td style="min-width: 30px;"><?php echo $row['数量']  ?></td>
			<td><?php echo $row['简介']  ?></td>
			</tr>
		<?php
			}
		?>
		</tbody>
	</table>
<!-- 分页区域按钮 -->
    <div  align="center" >
    <div id="barcon" name="barcon" style="color: #000;font-size: large;font-weight: bold;"></div>
    </div>

    <script type="text/javascript">
        // console.log($('#idData tr').size());
        
            window.onload = function() {  //页面加载完之后执行
                goPage(1, 20);  //1为当前页数，10为每页显示行数
            };
      

    </script>
 <!--================================================================= 页脚部分=======================================================================-->
<div id="footerpage"></div>
<script type="text/javascript">
    $("#footerpage").load('../footer.html');
</script>


</div>
<script src="../js/table.js"></script>
</body>
</html>