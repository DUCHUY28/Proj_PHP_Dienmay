<?php 
if(isset($_GET['id_tin'])){
	$id_baiviet = $_GET['id_tin'];
}else {
	$id_baiviet = '';
}
?>
<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="index.html">Trang chủ</a>
						<i>|</i>
					</li>
					<?php
					$sql_baiviet_baiviet = mysqli_query($connect,"SELECT * FROM  tbl_baiviet where baiviet_id = '$id_baiviet'");
					$row_show_baiviet = mysqli_fetch_array($sql_baiviet_baiviet); 	
					 ?>
					<li><?php
					if(isset($row_show_name['tenbaiviet'])){ 
					echo $row_show_name['tenbaiviet'] ;
					}else {
						echo 'Tin tức';
					}?></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->

	<!-- about -->
	<div class="welcome py-sm-5 py-4">
        
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3"><?php echo $row_show_baiviet['tenbaiviet'] ?></h3>
			<!-- //tittle heading -->
			<div class="row">
				<div class="col-lg-12 welcome-left">
					<h5><a href=""><?php echo $row_show_baiviet['tomtat'] ?></a></h5>
					<h4 class="my-sm-3 my-2"><?php echo $row_show_baiviet['noidung'] ?></h4>
					
				</div>
			</div><br>
			<?php ?>
		</div>
	</div>