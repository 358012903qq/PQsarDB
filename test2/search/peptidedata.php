

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

         <?php
require_once 'connect.php';

$name = $_GET['id'];
$tabname = $_GET['name'];
?>
<div class="title_one"><?php echo $tabname;?> Peptides table</div>
<?php
$sql="SELECT * FROM $name ";

$result=$db->query($sql);
#var_dump($result);
if ($result==false) {
	 die ('<div style="text-align:center"> no result </div>');
	// exit;
}

if ($result->num_rows==0) {
	die("没有找到数据");
}

$rows=[];

while ($row=$result->fetch_assoc()) {
	$rows[]=$row;
}
?>
      
   


	 <table id="tab_1" style="width: 60%;margin-left: 190px;text-align: center;">
	
		<tr>
			<?php
				#得到表的字段名字并作为网页表格的标题
				$hand=$result->fetch_fields();
				foreach ($hand as $val) {
				echo '<th>'.$val->name.'</th>';
			}
			?>
		</tr>

		<?php
		#用双foreach遍历数据表并在网页上显示出来
		foreach ($rows as $key => $value) {
		 	
			echo "<tr>";
			foreach ($value as $a) {
				echo "<td>{$a}</td>";
			}

			
			echo "</tr>";
		}


		?>
		
	</table>

	<div class="downloadbutton" style="margin-left:200px;">
	<a href="downloadtxt.php?id=<?php echo $name;?> &name=<?php  echo $name?>">Download.txt</a>

	<a style=" display: none;margin-left: 40px;" href="downloadxls.php?id=<?php echo $name;?> &name=<?php  echo $name?>">Download.excle</a>
	</div>

<!--================================================================= 页脚部分=======================================================================-->
<div id="footerpage" style="margin-top:10px"></div>
<script type="text/javascript">
    $("#footerpage").load('../footer.html');
</script>

</div>
</body>
</html>