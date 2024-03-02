<?php
include '../db/db.php';
if(isset($_POST['themsanpham'])){
    $tensanpham = $_POST['tensanpham'];
    $hinhanh = $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $soluong = $_POST['soluong'];
    $gia = $_POST['giasanpham'];
    $giakhuyenmai = $_POST['giakhuyemai'];
    $danhmuc = $_POST['danhmuc'];
    $mota = $_POST['mota'];
    $chitiet = $_POST['chitiet'];
    $path = "../images/";

    $sql_insert_product = mysqli_query($connect,"INSERT INTO tbl_sanpham (sanpham_name,sanpham_chitiet,sanpham_mota,
    sanpham_gia,sanpham_giakhuyenmai,sanpham_soluong,sanpham_image,category_id) 
    values ('$tensanpham','$chitiet','$mota','$gia','$giakhuyenmai','$soluong','$hinhanh','$danhmuc')");
    move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
}

 ?>
 <?php 
 if(isset($_GET['xoa'])){
    $id = $_GET['xoa']; 
    $sql_delete_sanpham = mysqli_query($connect,"DELETE FROM tbl_sanpham where sanpham_id = '$id'");
 }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
    
    <title>Sản phẩm </title>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-light navbar-light">
  <div class="container">
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
        <?php 
        if(isset($_GET['quanly']) == 'capnhat'){     
            $id_capnhat = $_GET['id'];
            $sql_capnhat = mysqli_query($connect,"SELECT * FROM tbl_sanpham where sanpham_id = '$id_capnhat'");
            $row_capnhat = mysqli_fetch_array($sql_capnhat);     
            $id_category = $row_capnhat['category_id'];
            if(isset($_POST['capnhatsanpham'])){ 
              $id_update = $_POST['id_update'];
              $tensanpham = $_POST['tensanpham'];
            
              $hinhanh = $_FILES['hinhanh']['name'];
              $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
              
              $soluong = $_POST['soluong'];
              $gia = $_POST['giasanpham'];
              $giakhuyenmai = $_POST['giakhuyemai'];
              $danhmuc = $_POST['danhmuc'];
              $mota = $_POST['mota'];
              $chitiet = $_POST['chitiet'];
              $path = '../uploads/';
              if($hinhanh == ''){
                $query_update = mysqli_query($connect,"UPDATE tbl_sanpham SET sanpham_name  = '$tensanpham',sanpham_mota = '$mota',
              sanpham_chitiet = '$chitiet',sanpham_gia = '$gia',sanpham_giakhuyenmai = '$giakhuyenmai',category_id = '$danhmuc' where sanpham_id = '$id_update' ");
              }else {
              $query_update = mysqli_query($connect,"UPDATE tbl_sanpham SET sanpham_name  = '$tensanpham',sanpham_mota = '$mota',
              sanpham_chitiet = '$chitiet',sanpham_gia = '$gia',sanpham_giakhuyenmai = '$giakhuyenmai',sanpham_image = '$hinhanh',
              category_id = '$danhmuc' where sanpham_id = '$id_update' ");
              move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
              }
            }
            ?>
     <div class="col-md-4">
        <h4>Cập nhật sản phẩm</h4>
        <form action="" method="post" enctype="multipart/form-data">
          <?php  ?>
          <div class="form-group">
            <label for="">Tên sản phẩm</label><br>
            <input type="text" name="tensanpham" class="form-control" value="<?php echo $row_capnhat['sanpham_name'] ?>">
            <input type="hidden" name="id_update" class="form-control" value="<?php echo $row_capnhat['sanpham_id'] ?>">
          </div>
          <div class="form-group">
            <label for="">Ảnh sản phẩm</label><br>
            <input type="file" class="form-control" name="hinhanh" value="<?php echo $row_capnhat['sanpham_image'] ?>">
            <img style="width:100px" src="../uploads/<?php echo $row_capnhat['sanpham_image'] ?>" alt="">
          </div>
          <div class="form-group">
            <label for="">Giá sản phẩm</label><br>
            <input  type="text" name="giasanpham" class="form-control" placeholder="Gía sản phẩm" value="<?php echo $row_capnhat['sanpham_gia'] ?>">
          </div>
          <div class="form-group">
            <label for="">Giá khuyễn mãi</label><br>
            <input type="text" name="giakhuyemai" class="form-control" placeholder="Gía khuyến mãi" value="<?php echo $row_capnhat['sanpham_giakhuyenmai'] ?>">
          </div>
          <div class="form-group">
            <label for="">Số lượng</label><br>
            <input type="text" name="soluong" class="form-control"  value="<?php echo $row_capnhat['sanpham_soluong'] ?>">
          </div>
          <div class="form-group">
            <label for="">Mô tả</label><br>
            <textarea type="text" name="mota" class="form-control"  value=""><?php echo $row_capnhat['sanpham_mota'] ?></textarea>
          </div>
          <div class="form-group">
            <label for="">Chi tiết</label><br>
            <textarea type="text" name="chitiet" class="form-control" value=""><?php echo $row_capnhat['sanpham_chitiet'] ?></textarea>
          </div>
          <div class="form-group">
            <label for="">Danh mục</label><br>
            <?php 
            $sql_danhmuc = mysqli_query($connect,"SELECT * FROM tbl_category order by category_id DESC");
            ?>
            <select name="danhmuc" id="" class="form-control">
              <option value="0">Chọn danh mục</option>
              <?php 
              while($row = mysqli_fetch_array($sql_danhmuc)){
                if($id_category == $row['category_id']){
                  ?>
                <option selected value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?> </option>
                <?php } 
                else { ?>
                  <option  value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?> </option>
               <?php }}?>
            </select>
          </div>
          <input type="submit" class="btn btn-success" name="capnhatsanpham" value="Cập nhật sản phẩm">
        </form>
     </div>
     <?php } 
     else {?>
     <div class="col-md-3">
        <h4>Thông tin sản phẩm</h4>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="">Tên sản phẩm</label><br>
            <input type="text" name="tensanpham" class="form-control" value="<?php  ?>">
          </div>
          <div class="form-group">
            <label for="">Ảnh sản phẩm</label><br>
            <input type="file" name="hinhanh" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Giá sản phẩm</label><br>
            <input  type="text" name="giasanpham" class="form-control" placeholder="Gía sản phẩm">
          </div>
          <div class="form-group">
            <label for="">Giá khuyễn mãi</label><br>
            <input type="text" name="giakhuyemai" class="form-control" placeholder="Gía khuyến mãi">
          </div>
          <div class="form-group">
            <label for="">Số lượng</label><br>
            <input type="text" name="soluong" class="form-control" placeholder="Số lượng">
          </div>
          <div class="form-group">
            <label for="">Mô tả</label><br>
            <textarea type="text" name="mota" class="form-control" placeholder="Mô tả"></textarea>
          </div>
          <div class="form-group">
            <label for="">Chi tiết</label><br>
            <textarea type="text" name="chitiet" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label for="">Danh mục</label><br>
            <?php 
            $sql_danhmuc = mysqli_query($connect,"SELECT * FROM tbl_category order by category_id DESC");
            ?>
            <select name="danhmuc" id="" class="form-control">
              <option value="0">Chọn danh mục</option>
              <?php while($row = mysqli_fetch_assoc($sql_danhmuc)){ ?>
                <option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?> </option>
                <?php }?>
            </select>
            <?php ?>
          </div>
          <input type="submit" class="btn btn-success" name="themsanpham" value="Thêm sản phẩm">
        </form>
     </div>
     <?php }?>
     <div class="col-md-8">
        <h4>Danh sách sản phẩm</h4>
        <table class="table">
          <thead class="table-dark">
          <tr>
                <th>Thứ tự</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Số lượng</th>
                <th>Danh mục</th>
                <th>Giá</th>
                <th>Khuyến mãi</th>
                <th>Quản lý</th>
            </tr>
          </thead>
            <tbody>
                <?php
                $sql_select_sanpham = mysqli_query($connect,'SELECT * FROM tbl_sanpham,tbl_category
                where tbl_sanpham.category_id = tbl_category.category_id order by tbl_sanpham.sanpham_id ASC');
                $i = 0;
                 while($row_sanpham = mysqli_fetch_assoc($sql_select_sanpham)){ 
                    $i++;
                    ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row_sanpham['sanpham_name'] ?></td>
                    <td><img style="width:100px" src="../uploads/<?php echo $row_sanpham['sanpham_image'] ?>" alt=""></td>
                    <td><?php echo $row_sanpham['sanpham_soluong'] ?></td>
                    <td><?php echo $row_sanpham['category_name'] ?></td>
                    <td><?php echo number_format($row_sanpham['sanpham_gia']).' vnđ' ?></td>
                    <td><?php echo number_format($row_sanpham['sanpham_giakhuyenmai']).' vnđ' ?></td>
                    <td><a href="?xoa=<?php echo $row_sanpham['sanpham_id'] ?>">Xóa</a> ||
                    <a href="?quanly=capnhat&&id=<?php echo $row_sanpham['sanpham_id'] ?>">Sửa</a></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
     </div>
    </div>
</div>
</body>
</html>