<?php 
if(isset($_POST['themgiohang'])){
	$tensanpham = $_POST['tensanpham'];
	$sanpham_id = $_POST['sanpham_id'];
	$giasanpham = $_POST['giasanpham'];
	$hinhanh = $_POST['hinhanh'];
	$soluong = $_POST['soluong'];
	$sql_select_giohang = mysqli_query($connect,"SELECT * FROM tbl_giohang where sanpham_id ='$sanpham_id'");
	$count = mysqli_num_rows($sql_select_giohang);
	if($count > 0){
		$row_sanpham = mysqli_fetch_array($sql_select_giohang);
		$soluong = $row_sanpham['soluong'] + 1;
		$sql_giohang = "UPDATE tbl_giohang SET soluong = '$soluong' where sanpham_id = '$sanpham_id' " ;
	}else {
		$soluong = $soluong;
		$sql_giohang = "INSERT INTO tbl_giohang (tensanpham,giasanpham,hinhanh,soluong,sanpham_id) 
	values ('$tensanpham','$giasanpham','$hinhanh',$soluong,$sanpham_id)";
	}
	$insert_row = mysqli_query($connect,$sql_giohang);
	if($insert_row == 0){
		header('location:index.php?quanly=giohang&id='.$sanpham_id);
	}
}elseif(isset($_POST['capnhatgiohang'])){
	if(isset($_POST['product_id'])){
	for($i = 0; $i < count($_POST['product_id']);$i++){
		$sanpham_id = $_POST['product_id'][$i];
		$soluong = $_POST['soluong'][$i];
		if($soluong <= 0){
			$sql_delete  = mysqli_query($connect,"DELETE FROM tbl_giohang where sanpham_id = '$sanpham_id'");
		}else {
			$sql_update = mysqli_query($connect,"UPDATE tbl_giohang SET soluong = '$soluong' where sanpham_id = '$sanpham_id'");
		}
	}
}else {
	$cart_empty = "Giỏ hàng rỗng";
} 
}
elseif(isset($_GET['xoa'])){
	$id = $_GET['xoa'];
	$sql_delete_product = mysqli_query($connect,"DELETE FROM tbl_giohang where giohang_id = '$id' ");
}
elseif(isset($_GET['dangxuat'])){
	$id = $_GET['dangxuat'];
	if($id == 1){
	unset($_SESSION['dangnhap_home']);
	}
}
?>

<?php
if(isset($_POST['thanhtoan'])){
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$note = $_POST['note'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$hinhthucgiaohang = $_POST['hinhthucgiaohang'];

	$sql_khachhang = mysqli_query($connect,"INSERT INTO tbl_khachhang(name,phone,address,note,email,giaohang,password)
	                  values ('$name','$phone','$address','$note','$email','$hinhthucgiaohang','$password')");
	if($sql_khachhang){
		$sql_select_khachhang = mysqli_query($connect,"SELECT * FROM tbl_khachhang order by khachhang_id DESC LIMIT 1 ");
		$mahang = rand(0,9999);
		$row_khachhang = mysqli_fetch_array($sql_select_khachhang);
			$khachhang_id = $row_khachhang['khachhang_id'];
			$_SESSION['dangnhap_home'] = $row_khachhang['name'];
			$_SESSION['khachhang_id'] = $khachhang_id;
		for($i = 0;$i < count($_POST['thanhtoan_product_id']);$i++){
			$sanpham_id = $_POST['thanhtoan_product_id'][$i];
			$soluong = $_POST['thanhtoan_soluong'][$i];
			$sql_donhang = mysqli_query($connect,"INSERT INTO tbl_donhang (sanpham_id,khachhang_id,soluong,mahang)
			values ('$sanpham_id','$khachhang_id','$soluong','$mahang')");
			$sql_giaodich = mysqli_query($connect,"INSERT INTO tbl_giaodich(sanpham_id,soluong,magiaodich,khachhang_id)
			values ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
			
			$sql_delete_thanhtoan = mysqli_query($connect,"DELETE FROM tbl_giohang where sanpham_id = '$sanpham_id'");
		}
		
	}
}elseif(isset($_POST['thanhtoan_dangnhap'])){

	$khachhang_id = $_SESSION['khachhang_id'];
	
		$mahang = rand(0,9999);
		for($i = 0;$i < count($_POST['thanhtoan_product_id']);$i++){
			$sanpham_id = $_POST['thanhtoan_product_id'][$i];
			$soluong = $_POST['thanhtoan_soluong'][$i];
			$sql_donhang = mysqli_query($connect,"INSERT INTO tbl_donhang (sanpham_id,khachhang_id,soluong,mahang)
			values ('$sanpham_id','$khachhang_id','$soluong','$mahang')");
			$sql_giaodich = mysqli_query($connect,"INSERT INTO tbl_giaodich(sanpham_id,soluong,magiaodich,khachhang_id)
			values ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
			
			$sql_delete_thanhtoan = mysqli_query($connect,"DELETE FROM tbl_giohang where sanpham_id = '$sanpham_id'");
		}
		
	
}

  ?>
<div class="privacy py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>G</span>iỏ
				<span>H</span>àng
			</h3>
			<?php 
			if(isset($_SESSION['dangnhap_home'])){
				echo '<p style="color: #010101;00">Xin chào :' .$_SESSION['dangnhap_home'] . 
				'<a href="index.php?quanly=giohang&dangxuat=1"> Đăng xuất</a> </p>';
			}
			?>
			<!-- //tittle heading -->
			<div class="checkout-right">
				<?php 
				$sql_show = mysqli_query($connect,"SELECT * FROM tbl_giohang order by giohang_id DESC");
				$count_product = mysqli_num_rows($sql_show);
				?>
				<h4 class="mb-sm-4 mb-3">Giỏ hàng của bạn có:
					<span><?php echo $count_product ?> Sản phẩm</span>
				</h4>
				<div class="table-responsive">
					<form action="" method="post">
					<table class="timetable_sub">
						<thead>
							<tr>
								<th>Thứ tự</th>
								<th>Sản phẩm</th>
								<th>Số lượng</th>
								<th>Tên sản phẩm</th>

								<th>Giá</th>
								<th>Tổng</th>
								<th>Thực hiện</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 0;
							$total=0;
							 while($row_giohang = mysqli_fetch_array($sql_show)){ $i++;
								$total += ($row_giohang['giasanpham'] * $row_giohang['soluong']);
								 ?>
							<tr class="rem1">
								<td class="invert"><?php echo $i ?></td>
								<td class="invert-image">
									<a href="?quanly=chitietsp">
										<img style="width:100px;height:150px" src="images/<?php echo $row_giohang['hinhanh'] ?>" alt=" " class="img-responsive">
									</a>
								</td>
								<td class="invert">
									<input type="number" name="soluong[]" value="<?php echo $row_giohang['soluong'] ?>">
									<input type="hidden" name="product_id[]" value="<?php echo $row_giohang['sanpham_id'] ?>" >
								</td>
								<td class="invert"><?php echo $row_giohang['tensanpham'] ?></td>
								<td class="invert"><?php echo number_format($row_giohang['giasanpham']) .'vnđ' ?></td>
								<td class="invert"><?php echo number_format($row_giohang['giasanpham'] * $row_giohang['soluong']).' vnđ' ?></td>
								<td class="invert">
								<a class="btn btn-warning" href="?quanly=giohang&xoa=<?php echo $row_giohang['giohang_id'] ?>">Xóa</a>
								</td>
							</tr>
							<?php }?>
							<tr>						
							<td colspan="7"><p class="text-danger">Tổng tiền : <?php echo number_format($total) .' vnđ' ?></p></td>
							</tr>
							<tr>
								<td colspan="7"><input type="submit" value="Cập nhật giỏ hàng" name="capnhatgiohang" class="btn btn-warning">
							<?php
							$sql_giohang_select = mysqli_query($connect,"SELECT * FROM tbl_giohang");
								if(isset($_SESSION['dangnhap_home']) && $count_product > 0){  
									while($row_1 = mysqli_fetch_array($sql_giohang_select)){
								 ?>
								 <input type="hidden" name="thanhtoan_soluong[]" value="<?php echo $row_thanhtoan['soluong'] ?>">
								<input type="hidden" name="thanhtoan_product_id[]" value="<?php echo $row_thanhtoan['sanpham_id'] ?>" >
								<?php }?>
								<input type="submit" value="Thanh toán" name="thanhtoan_dangnhap" class="btn btn-primary">
								<?php }?>
							</td>
							</tr>
							
						</tbody>
					</table>
					</form>
				</div>
			</div>
			<?php 
			if(!isset($_SESSION['dangnhap_home'])) {?>
			<div class="checkout-left">
				<div class="address_form_agile mt-sm-5 mt-4">
					<h4 class="mb-sm-4 mb-3">Thêm địa chỉ giao hàng</h4>
					<form action="" method="post" class="creditly-card-form agileinfo_form">
						<div class="creditly-wrapper wthree, w3_agileits_wrapper">
							<div class="information-wrapper">
								<div class="first-row">
									<div class="controls form-group">
										<input class="billing-address-name form-control" type="text" name="name" placeholder="Họ và tên" required="">
									</div>
									<div class="w3_agileits_card_number_grids">
										<div class="w3_agileits_card_number_grid_left form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Số điện thoại" name="phone" required="">
											</div>
										</div>
										<div class="w3_agileits_card_number_grid_right form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Địa chỉ" name="address" required="">
											</div>
										</div>
									</div>
									<div class="controls form-group">
										<input type="text" class="form-control" placeholder="Email" name="email" required="">
									</div>
									<div class="controls form-group">
										<input type="text" class="form-control" placeholder="password" name="password" required="">
									</div>
									<div class="controls form-group">
										<textarea style="resize: none;" type="text" class="form-control" placeholder="Ghi chú" name="note" required=""></textarea>
									</div>
									<div class="controls form-group">
										<select class="option-w3ls" name="hinhthucgiaohang">
											<option>Chọn hình thức giao hàng</option>
											<option value="0">Thanh toán online</option>
											<option value="1">Thanh toán khi nhận hàng</option>
										</select>
									</div>
								</div>
								<?php
								$sql_show = mysqli_query($connect,"SELECT * FROM tbl_giohang order by giohang_id DESC");
								while($row_thanhtoan = mysqli_fetch_array($sql_show)){
								?>
								<input type="hidden" name="thanhtoan_soluong[]" value="<?php echo $row_thanhtoan['soluong'] ?>">
								<input type="hidden" name="thanhtoan_product_id[]" value="<?php echo $row_thanhtoan['sanpham_id'] ?>" >
								<?php }?>
								<input type="submit" name="thanhtoan" class="btn btn-success" style="width:20%" value="Thanh toán">
							</div>
						</div>
					</form>
					
					</div>
				</div>
			</div>
			<?php }?>
		</div>
	</div>