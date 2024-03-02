<?php
include '../db/db.php';
if(isset($_POST['capnhatdonhang'])){
  $xuly = $_POST['xuly'];
  $mahang = $_POST['mahang_xuly'];
  $sql_update_donhang = mysqli_query($connect,"UPDATE tbl_donhang SET tinhtrang = '$xuly' where mahang = '$mahang'");
  $sql_update_giaodich = mysqli_query($connect,"UPDATE tbl_giaodich SET tinhtrang = '$xuly' where magiaodich = '$mahang'");
}
// if(isset($_POST['themdanhmuc'])){
//     $tendanhmuc = $_POST['danhmuc'];
//     $sql_themdanhmuc = mysqli_query($connect,"INSERT INTO tbl_category (category_name) values ('$tendanhmuc')");
// }elseif(isset($_POST['capnhatdanhmuc'])){
//     $id_post = $_POST['id_danhmuc'];
//     $tendanhmuc = $_POST['danhmuc'];
//     $sql_capnhatdanhmuc = mysqli_query($connect,"UPDATE tbl_category SET category_name = '$tendanhmuc' where category_id = '$id_post'");
//     header('location:xulydanhmuc.php');
// }
 ?>
 <?php 
 if(isset($_GET['xoadonhang'])){
    $id = $_GET['xoadonhang']; 
    $sql_delete_donhang = mysqli_query($connect,"DELETE FROM tbl_donhang where mahang = '$id'");
    header('location:xulydonhang.php');
 }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
    
    <title>Đơn hàng</title>
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
        <a class="nav-link" href="xulysanpham.php">Sản phẩm</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="xulykhachhang.php">Khách hàng</a>
      </li>
    </ul>
  </div>
</nav><br><br>
<div class="container-fluid">
    <div class="row">
        <?php if(isset($_GET['quanly']) == 'xemdonhang') {
          $mahang = $_GET['mahang'];
          $sql_detail = mysqli_query($connect,"SELECT * FROM tbl_donhang,tbl_sanpham where tbl_donhang.sanpham_id = tbl_sanpham.sanpham_id
          and tbl_donhang.mahang = '$mahang'");
          ?>
          <div class="col-md-7">
          <p>Xem chi tiết đơn hàng</p>
          <form action="" method="post">
          <table class="table">
                <tr>
                  <th>Thứ tự</th>
                  <th>Mã hàng</th>
                  <th>Tên sản phẩm</th>
                  <th>Số lượng</th>
                  <th>Tổng tiền</th>
                  <th>Ngày đặt</th>
                  <th>Action</th>
                </tr>
                <tbody>
                  <?php 
                  $i = 0;
                  while($row_detail = mysqli_fetch_array($sql_detail) ){
                    $i++;?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php  echo $row_detail['mahang'] ?></td>
                      <td><?php  echo $row_detail['sanpham_name'] ?></td>
                      <td><?php  echo $row_detail['soluong'] ?></td>
                      <td><?php  echo  number_format(($row_detail['soluong'] * $row_detail['sanpham_giakhuyenmai'])).' vnđ' ?></td>
                      <td><?php  echo $row_detail['date'] ?></td>
                      <input type="hidden" name="mahang_xuly" value="<?php echo $row_detail['mahang'] ?>">
                    </tr>
                    <?php }?>
                </tbody>
              </table>
              <select class="form-control" name="xuly">
                <option value="1">Đã xử lý |Đang giao hàng</option>
                <option value="0">Chưa xử lý</option>
              </select><br>
              <input type="submit" value="Cập nhật đơn hàng" name="capnhatdonhang" class="btn btn-success">
              </form>
          </div>
          <?php 
          } else {
            
            ?>
            
            
            <?php }?>
     <div class="col-md-5">
        <h4>Liệt kê đơn hàng</h4>
        <table class="table">
            <tr>
                <th>Thứ tự</th>
                <th>Mã hàng</th>
                <th>Tình trạng đơn hàng</th>
                <th>Tên khách hàng</th>
                <th>Ngày đặt</th>
                <th>Action</th>
            </tr>
            <tbody>
                <?php
                $sql_select_donhang = mysqli_query($connect,"SELECT * FROM tbl_sanpham,tbl_donhang,tbl_khachhang 
                where tbl_donhang.khachhang_id = tbl_khachhang.khachhang_id and tbl_donhang.sanpham_id = tbl_sanpham.sanpham_id
                group by mahang DESC");
                $i = 0;
                 while($row_donhang = mysqli_fetch_array($sql_select_donhang)){ 
                    $i++;
                    ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row_donhang['mahang'] ?></td>
                    <td><?php 
                    if($row_donhang['tinhtrang'] == 0){
                      echo 'Chưa xử lý';
                    }else {
                      echo 'Đã xử lý';
                    }
                    ?></td>
                    <td><?php echo $row_donhang['name'] ?></td>
                    <td><?php echo $row_donhang['date'] ?></td>
                    <td><a href="?xoadonhang=<?php echo $row_donhang['mahang'] ?>">Xóa</a> ||
                    <a href="?quanly=xemdonhang&&mahang=<?php echo $row_donhang['mahang'] ?>">Xem đơn hàng</a></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
     </div>
    </div>
</div>
</body>
</html>