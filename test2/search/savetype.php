

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

       <div class="title_one">Search Result</div>

      <?php
require_once 'connect.php';

$type=$_GET['type'];

if ($type=='others') {
	$sql="SELECT * FROM data1 where 类型 != 'Physiochemical 'AND 类型 !='3D-structural'AND 类型 !='mixed'AND 类型!='Topological'AND 类型!='Quantum'";
}else{
$sql="SELECT * FROM data1 WHERE 类型 = '$type'";
}
$result=$db->query($sql);
#var_dump($result);
if ($result==false) {
	echo "no result";
	exit;
}
$rows=[];

while ($row=$result->fetch_assoc()) {
	$rows[]=$row;
}
#var_dump($rows);
?>


	 <table id="tab_1">
	 	
		<tr>
		  <th>Descriptor</th>
		  <th>Style</th>
		  <th>Brief introduction</th>
		</tr>
	
	<tbody id="idData">
		<?php
		foreach ($rows as $row) 
		{
		?>
		<tr>
		  <td style="text-align: center;"><a style="text-decoration: none;" href="aainformation.php?name=<?php echo $row['氨基酸描述子'];?>"><?php echo $row['氨基酸描述子'];?></a></td>
		 <td style="text-align:center;"><?php echo $row['类型'];?></td>
		  
		  <td style="text-align:left"><?php echo $row['简介'];?></td>
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

     <script type="text/javascript">
        var rows=$("#tab_1 td").size();
         console.log(rows);
        if (rows==0) {
            var noresult = '<div style="text-align:center"> no result </div>';
            $("#tab_1").hide();
            $("#tab_1").after(noresult);
        }
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
