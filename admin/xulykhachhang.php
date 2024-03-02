<?php
include '../db/db.php';

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
    
    <title>Khách hàng</title>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-light navbar-light">
  <div class="container-fluid">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link active" href="xulydonhang.php">Đơn hàng</a>
      </li>
     <li class="nav-item">
        <a class="nav-link" href="xulydanhmuc.php">Danh mục</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="xulydanhmuc_baiviet.php">Danh mục bài viết</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="xulysanpham.php">Sản phẩm</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="xulykhachhang.php">Khách hàng</a>
      </li>
    </ul>
  </div>
</nav><br><br>
<div class="container">
    <div class="row">
     <div class="col-md-12">
        <h4>Khách hàng</h4>
        <table class="table">
            <tr>
                <th>Thứ tự</th>
                <th>Tên khách hàng</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Ngày mua</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <tbody>
                <?php
                $sql_select_khachhang = mysqli_query($connect,"SELECT * FROM tbl_khachhang,tbl_giaodich
                 where tbl_khachhang.khachhang_id = tbl_giaodich.khachhang_id group by tbl_giaodich.magiaodich order by  tbl_khachhang.khachhang_id DESC");
                $i = 0;
                 while($row_donhang = mysqli_fetch_array($sql_select_khachhang)){ 
                    $i++;
                    ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row_donhang['name'] ?></td>
                    <td><?php echo $row_donhang['phone'] ?></td>
                    <td><?php echo $row_donhang['address'] ?></td>
                    <td><?php echo $row_donhang['date'] ?></td>
                    <td><?php echo $row_donhang['email'] ?></td>
                    <td><a href="?quanly=xemgiaodich&khachhang=<?php echo $row_donhang['magiaodich'] ?>">Xem giao dịch</a></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
     </div>

     <div class="col-md-12">
        <h4>Liệt kê lịch sử đơn hàng</h4>
        <?php
                if(isset($_GET['khachhang'])){
                    $magiaodich = $_GET['khachhang'];
                }else {
                    $magiaodich ='';
                }
                $sql_select = mysqli_query($connect,"SELECT * FROM tbl_khachhang,tbl_giaodich,tbl_sanpham
                 where tbl_khachhang.khachhang_id = tbl_giaodich.khachhang_id and tbl_giaodich.sanpham_id = tbl_sanpham.sanpham_id
                 and tbl_giaodich.magiaodich = '$magiaodich' order by  tbl_giaodich.giaodich_id DESC");
                    ?>
        <table class="table">
            <tr>
                <th>Thứ tự</th>
                <th>Mã giao dịch</th>
                <th>Tên sản phẩm</th>
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
                    <td><?php echo $row_donhang['date'] ?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
     </div>
    </div>
</div>
</body>
</html>