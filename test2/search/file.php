<?php
require_once 'connect.php';

$id=$_GET['id'];
$name=$_GET['name'];
#echo $id;
$sql="SELECT * FROM $id ";
$result=$db->query($sql);
#var_dump($result);

#得到表的字段名字
/*$hand=$result->fetch_fields();
foreach ($hand as $val) {
	echo $val->name;
}*/

#数据的列：5
#$cols=$result->field_count;
#数据的行：20
#$ro=$result->num_rows;
#echo $cols.$ro;
#echo "<hr>";
if ($result==false) {
	echo "没有找到此文件";
	exit;
}

#得到表的所有数据并放入一个数组当中
$rows=[];

while ($row=$result->fetch_assoc()) {
	$rows[]=$row;
}
#var_dump($rows);
?>

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

<!-- =================================================================  搜索框部分   ============================================================= -->

<div id="search" class="search-box">

                   <span id="tab">
                       <button type="button" id="tab1" class="search_button">search by name</button>
                       <button type="button" id="tab2" class="search_button">search by type</button>
                       <button type="button" id="tab3" class="search_button">search by literature</button>
                   </span>
                   <div id="searchcontainer" class="searchcontainer">
                       <div id="searchbyname">
                            <form action="./savename.php" method="get" autocomplete="off" style="width:100%;">
                            <input type="text" name="name" class ="autosearch" autocomplete="on"  placeholder="e.g.,z-scale" style="color: #999999;">
                            <input class="submitcss" type="submit" value="Search"  >
                            </form>           
                        </div>
                   <div id="searchbytype" class="searchcontainer" style="display: none;">
                    <form action="./savetype.php" method="get">
                        <input list="types" class ="autosearch" name="type" placeholder="Please choose one type" >
                        <datalist id="types" >
                            <option value="Physiochemical" >
                            <option value="3D-structural">
                            <option value="Topological">
                            <option value="Quantum">
                            <option value="mixed">
                            <option value="others">
                        </datalist>
                        <input class="submitcss" type="submit" value="Search" >
                    </form>
                    </div>
                    <div id="searchbyliterature" class="searchcontainer" style="display: none;">
                            <form action="./saveliterature.php" method="get" autocomplete="off" style="width:100%;">
                            <input type="text" name="literature" class ="autosearch" autocomplete="on"  placeholder="Please enter literature title" style="color: #999999;">
                            <input class="submitcss" type="submit" value="Search" >
                        </form>
                        </div>
                </div>
               
            <script type="text/javascript">
                    var $search = $('#searchcontainer>div')
                    var $bu = $('#tab>button')
                    var currIndex = 0//当前显示的内容div的下标
                       //给3个li加监听
                       $('#tab>button').click(function(){
                           //alert('---')
                           //隐藏当前已经显示的内容div
                           $search[currIndex].style.display = 'none'
                           //显示对应内容的div
                           //得到当前点击的li在兄弟中下标
                           var index = $(this).index()
                           //找到对应的内容div
                           $search[index].style.display = 'block'
                           for (var i = 0; i < 3; i++) {
                               $bu[i].style.cssText="background-image: linear-gradient(to bottom,#29bdd9 0%,#276ace 100%);"
                           }
                           $bu[index].style.cssText="background-color:#5599ff;background-image:none;";
                           // $($search[index]).css('display','block')
                        //更新下标
                        currIndex = index
                       })
                   </script> 
                   
        </div>
 <!-- =============================================================== 搜索结果表格部分=================================================================-->
       <hr>
     <div class="title_one"><?php echo $name;?> Descriptor table</div>
     <div style="overflow-x: auto;">
	<table id="tab_1" >
		<tr>
			<?php
				#得到表的字段名字并作为网页表格的标题
				$hand=$result->fetch_fields();
				foreach ($hand as $val) {
				echo '<th style="text-align:left">'.$val->name.'</th>';
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
</div>


	<div class="downloadbutton" style="margin-left:200px;">
		<a  href="downloadtxt.php?id=<?php echo $id; ?>&name= <?php echo $name;?>">Download.txt</a>

		<a  style="display: none;margin-left: 40px;" href="downloadxls.php?id=<?php echo $id; ?>&name= <?php echo $name;?>">Download.excle</a>
	</div>

<!--================================================================= 页脚部分=======================================================================-->
<div id="footerpage" margin-top:10px></div>
<script type="text/javascript">
    $("#footerpage").load('../footer.html');
</script>



</div>
</body>
</html>


