
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
$name_table = $_GET['name'];
?>
       <div class="title_one"><?php echo $name_table;?> QSAR Result table</div>

       <?php


$sql="SELECT * FROM $name ";

$result=$db->query($sql);
#var_dump($result);
if ($result==false) {
	echo '<div style="text-align:center"> no result </div>';
	exit;
}

if ($result->num_rows==0) {
	die("没有找到数据");
}

$rows=[];

while ($row=$result->fetch_assoc()) {
	$rows[]=$row;
}
?>

	 <table id="tab_1">
	
		<tr>
			<th>Descriptor</th>
			<th>Model</th>
			<th>A</th>
			<th>R<sup>2</sup></th>
			<th>Q<sup>2</sup></th>
			<th>P<sup>2</sup></th>
			<th>RMSEE</th>
			<th>RMSCV</th>
			<th>RMSEP</th>
			<th>Reference</th>
		</tr>
		<?php
		foreach ($rows as $row ) {	
		?>
		<tr>
			<td><?php echo $row['Descriptor']; ?></td>
			<td><?php echo $row['Model']; ?></td>
			<td><?php echo $row['A']; ?></td>
			<td><?php echo $row['R2']; ?></td>
			<td><?php echo $row['Q2']; ?></td>
			<td><?php echo $row['P2']; ?></td>
			<td><?php echo $row['RMSEE']; ?></td>
			<td><?php echo $row['RMSCV']; ?></td>
			<td><?php echo $row['RMSEP']; ?></td>
			

			<td class="overflowhide" style="font-size: 0.8em;"><?php echo $row['Reference']; ?><a href="<?php  echo $row['Link'] ?>">[full text]</a></td>
		</tr>
		<?php
		}
		?>
		
	</table>

	
<!--================================================================= 页脚部分=======================================================================-->
<div id="footerpage"></div>
<script type="text/javascript">
    $("#footerpage").load('../footer.html');
</script>

</div>
</body>
</html>