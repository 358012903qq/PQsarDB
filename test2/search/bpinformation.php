

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

$name = $_GET['id'];
$sql="SELECT * FROM peptides WHERE 常用肽 = '$name'";
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
?>
       <table id="tab_1">

		<?php
		foreach ($rows as $row) {
		?>

		<tr>
		<th colspan='2'>
                 <span class='title_float_left'>Basic
                Information</span>
                <span class='help'><a class="one" href='#helppart' >? help</a></span>
                
            </tr>


       	<tr>
			<td>Active peptide</td>
			<td><?php echo $row['常用肽']  ?></td>
		</tr>

		<tr>
			<td>Abbreviation</td>
			<td><?php echo $row['简称']  ?></td>
		</tr>
		<tr>
			<td>Number</td>
			<td><?php echo $row['数量']  ?></td>
		</tr>
		<tr>
			<td>Brief introduction</td>
			<td><?php echo $row['简介']  ?></td>
		</tr>

        <tr>
            <td>Activity data of peptides </td>
            <td><?php echo $row['活性'] ?></td>
        </tr>

		<tr>
			<td>Peptide dataset</td>
			<td><a href="peptidedata.php?id=<?php echo $row['简称']; ?>&name=<?php echo $row['常用肽'] ?> ">View</a></td>
		</tr>

		<tr>
			<td>Descriptors using this set of peptides</td>
			<td><?php echo $row['描述子']  ?></td>
		</tr>

		<tr>
			<td>Qsar Result</td>
			<td><a href="bpqsar.php?id=<?php echo $row['简称'].'qsar'; ?> &name=<?php echo $row['常用肽'];?>">View</a></td>
		</tr>

		<tr>
			<td>Original references </td>
			<td><a target="_blank" href="<?php echo $row['文献链接'] ?>"><?php echo $row['来源文献题目'] ?></a></td>
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
			-->
    <!--================================================================= 页脚部分=======================================================================-->
<div id="footerpage"></div>
<script type="text/javascript">
    $("#footerpage").load('../footer.html');
</script>

</div>
</body>
</html>