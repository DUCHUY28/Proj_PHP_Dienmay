<?php
include '../db/db.php';
if(isset($_POST['themdanhmuc'])){
    $tendanhmuc = $_POST['danhmuc'];
    $sql_themdanhmuc = mysqli_query($connect,"INSERT INTO tbl_category (category_name) values ('$tendanhmuc')");
}elseif(isset($_POST['capnhatdanhmuc'])){
    $id_post = $_POST['id_danhmuc'];
    $tendanhmuc = $_POST['danhmuc'];
    $sql_capnhatdanhmuc = mysqli_query($connect,"UPDATE tbl_category SET category_name = '$tendanhmuc' where category_id = '$id_post'");
    header('location:xulydanhmuc.php');
}
 ?>
 <?php 
 if(isset($_GET['xoa'])){
    $id = $_GET['xoa']; 
    $sql_delete_danhmuc = mysqli_query($connect,"DELETE FROM tbl_category where category_id = '$id'");
 }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
    
    <title>Danh mục </title>
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
        <?php 
        if(isset($_GET['quanly']) == 'capnhat'){     
            $id_capnhat = $_GET['id'];
            $sql_capnhat = mysqli_query($connect,"SELECT * FROM tbl_category where category_id = '$id_capnhat'");
            $row_capnhat = mysqli_fetch_array($sql_capnhat);     
            ?>
     <div class="col-md-4">
        <h4>Cập nhật danh mục</h4>
        <label for="">Tên danh mục</label>
        <form action="" method="post">
        <input type="text" name="danhmuc" class="form-control" value="<?php echo $row_capnhat['category_name'] ?>"><br>
        <input type="hidden" class="form-control" name="id_danhmuc" value="<?php echo $row_capnhat['category_id'] ?>">
        <input type="submit" name="capnhatdanhmuc" id="" value="Cập nhật danh mục" class="btn btn-success">
        </form>
     </div>
     <?php } 
     else {?>
     <div class="col-md-4">
        <h4>Thêm danh mục</h4>
        <label for="">Tên danh mục</label>
        <form action="" method="post">
        <input type="text" name="danhmuc" class="form-control" placeholder="Tên danh mục"><br>
        <input type="submit" name="themdanhmuc" id="" value="Thêm danh mục" class="btn btn-success">
        </form>
     </div>
     <?php }?>
     <div class="col-md-8">
        <h4>Liệt kê đơn hàng</h4>
        <table class="table">
            <tr>
                <td>Thứ tự</td>
                <td>ID danh mục</td>
                <td>Danh mục</td>
                <td>Quản lý</td>
            </tr>
            <tbody>
                <?php
                $sql_select_danhmuc = mysqli_query($connect,'SELECT * FROM tbl_category order by category_id ASC');
                $i = 0;
                 while($row_danhmuc = mysqli_fetch_assoc($sql_select_danhmuc)){ 
                    $i++;
                    ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row_danhmuc['category_id'] ?></td>
                    <td><?php echo $row_danhmuc['category_name'] ?></td>
                    <td><a href="?xoa=<?php echo $row_danhmuc['category_id'] ?>">Xóa</a> ||
                    <a href="?quanly=capnhat&&id=<?php echo $row_danhmuc['category_id'] ?>">Cập nhật</a></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
     </div>
    </div>
</div>
</body>
</html>