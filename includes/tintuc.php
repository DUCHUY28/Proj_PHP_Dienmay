<?php 
if(isset($_GET['id_tin'])){
	$id_danhmuc_tin = $_GET['id_tin'];
}else {
	$id_danhmuc_tin = '';
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
					$sql_danhmuc_name = mysqli_query($connect,"SELECT * FROM  tbl_danhmuc_tin where danhmuctin_id = '$id_danhmuc_tin'");
					$row_show_name = mysqli_fetch_array($sql_danhmuc_name); 	
					 ?>
					<li><?php
					if(isset($row_show_name['danhmuctin_name'])){ 
					echo $row_show_name['danhmuctin_name'] ;
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
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>D</span>anh
				<span>M</span>ục
                <span>T</span>in
				<span>T</span>ức</h3>
			<!-- //tittle heading -->
			<?php $select_tintuc = mysqli_query($connect,"SELECT * FROM tbl_danhmuc_tin,tbl_baiviet where 
			tbl_danhmuc_tin.danhmuctin_id = tbl_baiviet.danhmuctin_id AND tbl_danhmuc_tin.danhmuctin_id = '$id_danhmuc_tin'");
			while($row_baiviet = mysqli_fetch_array($select_tintuc)){ ?>
			<div class="row">
            <div class="col-lg-4 welcome-right-top mt-lg-0 mt-sm-5 mt-4">
					<img src="images/<?php echo $row_baiviet['baiviet_image'] ?>" class="img-fluid" alt=" ">
				</div>
				<div class="col-lg-8 welcome-left">
					<h3><a href="index.php?quanly=chitiettin&id_tin=<?php echo $row_baiviet['baiviet_id'] ?>"><?php echo $row_baiviet['tenbaiviet'] ?></a></h3>
					<h4 class="my-sm-3 my-2"><?php echo $row_baiviet['tomtat'] ?></h4>
					
				</div>
			</div><br>
			<?php } ?>
		</div>
	</div>