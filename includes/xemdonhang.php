<div class="ads-grid py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">Xem đơn hàng</h3>
			<!-- //tittle heading -->
			<div class="row">
				<!-- product left -->
				<div class="agileinfo-ads-display col-lg-9">
					<div class="wrapper">
						<!-- first section -->
							<div class="row">
                                <?php 
                                if(isset($_SESSION['dangnhap_home'])){
                                ?>
                                <h5>Đơn hàng : <?php echo $_SESSION['dangnhap_home'] ?></h5>
                                <?php } ?>
                                <div class="col-md-12">
        
        <?php
                if(isset($_GET['id_khachhang'])){
                    $id_khachhang = $_GET['id_khachhang'];
                }else {
                    $id_khachhang ='';
                }
                $sql_select = mysqli_query($connect,"SELECT * FROM tbl_giaodich where khachhang_id = '$id_khachhang'
                 group by  tbl_giaodich.magiaodich DESC");
                    ?>
        <table class="table">
            <tr>
                <th>Thứ tự</th>
                <th>Mã giao dịch</th>
                <th>Ngày tháng</th>
                <th>Actions</th>
                <th>Tình trạng</th>
            </tr>
            <tbody>
                <?php
                $i = 0;
                 while($row_donhang = mysqli_fetch_array($sql_select)){ 
                    $i++;
                    ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row_donhang['magiaodich'] ?></td>
                    <td><?php echo $row_donhang['date'] ?></td>
                    <td><a href="index.php?quanly=xemdonhang&id_khachhang=<?php echo $_SESSION['khachhang_id']
                    ?>&magiaodich=<?php echo $row_donhang['magiaodich'] ?>">Xem chi tiết</a></td>
                    <td>
                        <?php if($row_donhang['tinhtrang'] == 0){
                            echo 'Đang xử lý';
                          }else {
                            echo 'Đã xử lí | Đang giao hàng';
                          }?>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
     </div>
     <div class="col-md-12">
        <h4>Chi tiết đơn hàng</h4>
        <?php
                if(isset($_GET['magiaodich'])){
                    $magiaodich = $_GET['magiaodich'];
                }else {
                    $magiaodich ='';
                }
                $sql_select = mysqli_query($connect,"SELECT * FROM tbl_khachhang,tbl_giaodich,tbl_sanpham
                 where tbl_khachhang.khachhang_id = tbl_giaodich.khachhang_id and tbl_giaodich.sanpham_id = tbl_sanpham.sanpham_id
                 and tbl_giaodich.magiaodich = '$magiaodich' order by tbl_giaodich.giaodich_id DESC");
                    ?>
        <table class="table">
            <tr>
                <th>Thứ tự</th>
                <th>Mã giao dịch</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Ngày đặt</th>
            </tr>
            <tbody>
                <?php
                $i = 0;
                 while($row_donhang = mysqli_fetch_array($sql_select)){ 
                    $i++;
                    ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row_donhang['magiaodich'] ?></td>
                    <td><?php echo $row_donhang['sanpham_name'] ?></td>
                    <td><?php echo $row_donhang['soluong'] ?></td>
                    <td><?php echo $row_donhang['date'] ?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
     </div>
				</div>
					</div>
				</div>	
			</div>
		</div>
	</div>