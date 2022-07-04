

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

<div id='main_body'>

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

$name = $_GET['name'];

$sql="SELECT * FROM data1 WHERE 氨基酸描述子 = '$name'";
$result=$db->query($sql);
#var_dump($result);
if ($result==false) {
    echo "sql语句错误";
    exit;
}

if ($result->num_rows==0) {
    die("<div style='text-align:center'>no such amino acid descriptor</div>");
}

$rows=[];

while ($row=$result->fetch_assoc()) {
    $rows[]=$row;
}
?>

       <?php
            foreach ($rows as $row) 
            {
            ?>
       <table id="tab_1" >

            <tr>
                <th colspan='2'>
                 <span class='title_float_left'>Basic
                Information</span>
                <span class='help'><a href='#helppart' >? help</a></span>
                
            </tr>


                <tr>
                  <td >Descriptor</td>
                  <td ><?php echo $row['氨基酸描述子'];?></td>
                 </tr>

                 <tr>
                  <td >Style</td>
                  <td ><?php echo $row['类型'];?></td>
                 </tr>

                 <tr>
                  <td>Brief introduction</td>
                  <td><?php echo $row['简介'];?></td>
                </tr>

                 <tr>
                  <td>Number of factors</td>
                  <td><?php echo $row['参数数量'];?></td>
                </tr>

                 <tr>
                  <td>Method</td>
                  <td><?php echo $row['计算方法'];?></td>
                </tr>

                 <tr>
                  <td>Number of variables</td>
                   <td><?php echo $row['描述子数量'];?></td>
                </tr>

                <tr>
                  <td>Descriptor table</td>
                  <td><a href="file.php?id=<?php echo $row['filename']?>&name=<?php echo $row['氨基酸描述子']; ?>"> View</a></td>
                </tr>

                <tr>
                  <td>Application</td>
                  <td><?php echo $row['应用'];?></td>
                </tr>

                <tr>
                  <td>QSAR Result</td>
                  <td><a href="qsarresult.php?id=<?php echo $row['id']?>&name=<?php echo $row['氨基酸描述子'] ; ?>">view</a></td>
                </tr>

                <tr>
                  <td>References title</td>
                  <td><?php echo $row['文献题目'];?></td>
                </tr>

                <tr>
                  <td >DOI</td>
                  <td><a target="_blank" href="<?php echo $row['文献链接'] ?>"><?php echo $row['文章序列号'];?></a></td>
                </tr>

                <tr>
                  <td>Reference</td>
                  <td><?php echo $row['文献年份'];?></td>
                </tr>
            </table>

                <?php
                }
            ?>

        <!-- ==================================================================help部分================================================================= -->
        <!-- <hr>
        <div id='helppart'>
            <div class="title_one">explanation</div>
            <ul>
                <li>for example</li>
                <li>for example</li>
                <li>for example</li>
                <li>for example</li>
                <li>for example</li>
                <li>for example</li>
        </div>
            --!>
    <!--================================================================= 页脚部分=======================================================================-->
<div id="footerpage"></div>
<script type="text/javascript">
    $("#footerpage").load('../footer.html');
</script>

</div>
</body>
</html>