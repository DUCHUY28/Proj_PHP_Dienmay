<?php
include '../db/db.php';
if(isset($_POST['thembaiviet'])){
    $tenbaiviet = $_POST['tenbaiviet'];
    $hinhanh = $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $tomtat = $_POST['tomtat'];
    $noidung = $_POST['noidung'];
    $danhmuctin = $_POST['danhmuc'];
    $path = "../uploads/";

    $sql_insert_baiviet = mysqli_query($connect,"INSERT INTO tbl_baiviet (tenbaiviet,baiviet_image,tomtat,noidung,danhmuctin_id) 
    values ('$tenbaiviet','$hinhanh','$tomtat','$noidung','$danhmuctin')");
    move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
}

 ?>
 <?php 
 if(isset($_GET['xoa'])){
    $id = $_GET['xoa']; 
    $sql_delete_baiviet = mysqli_query($connect,"DELETE FROM tbl_baiviet where baiviet_id = '$id'");
 }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
    
    <title>Bài viết</title>
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
        <a class="nav-link" href="xulybaiviet.php">Sản phẩm</a>
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
            $sql_capnhat = mysqli_query($connect,"SELECT * FROM tbl_baiviet where baiviet_id = '$id_capnhat'");
            $row_capnhat = mysqli_fetch_array($sql_capnhat);     
            $id_danhmuc = $row_capnhat['danhmuctin_id'];
            if(isset($_POST['capnhatbaiviet'])){ 
              $id_update = $_POST['id_update'];
              $tenbaiviet = $_POST['tenbaiviet'];
            
              $hinhanh = $_FILES['hinhanh']['name'];
              $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
              
              $tomtat = $_POST['tomtat'];
              $noidung = $_POST['noidung'];
              $danhmuctin = $_POST['danhmuc'];
              $path = "../uploads/";
              if($hinhanh == ''){
                $query_update = mysqli_query($connect,"UPDATE tbl_baiviet SET tenbaiviet  = '$tenbaiviet',tomtat = '$tomtat',
              noidung = '$noidung',danhmuctin_id = '$danhmuctin' where baiviet_id = '$id_update' ");
              }else {
              $query_update = mysqli_query($connect,"UPDATE tbl_baiviet SET tenbaiviet  = '$tenbaiviet',tomtat = '$tomtat',
              noidung = '$noidung',baiviet_image = '$hinhanh',danhmuctin_id = '$danhmuctin' where baiviet_id = '$id_update' ");
              move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
              }
            }
            ?>
     <div class="col-md-4">
        <h4>Cập nhật bài viết</h4>
        <form action="" method="post" enctype="multipart/form-data">
          <?php  ?>
          <div class="form-group">
            <label for="">Tên bài viết</label><br>
            <input type="text" name="tenbaiviet" class="form-control" value="<?php echo $row_capnhat['tenbaiviet'] ?>">
            <input type="hidden" name="id_update" class="form-control" value="<?php echo $row_capnhat['baiviet_id'] ?>">
          </div>
          <div class="form-group">
            <label for="">Ảnh bài viết</label><br>
            <input type="file" class="form-control" name="hinhanh" value="<?php echo $row_capnhat['baiviet_image'] ?>">
            <img style="width:100px" src="../uploads/<?php echo $row_capnhat['baiviet_image'] ?>" alt="">
          </div>
          <div class="form-group">
            <label for="">Tóm tắt</label><br>
            <textarea  type="text" name="tomtat" class="form-control" value="<?php echo $row_capnhat['tomtat'] ?>"></textarea>
          </div>
          <div class="form-group">
            <label for="">Nội dung</label><br>
            <textarea type="text" name="noidung" class="form-control" value="<?php echo $row_capnhat['noidung'] ?>"></textarea>
          </div>
          <div class="form-group">
            <label for="">Danh mục</label><br>
            <?php 
            $sql_danhmuc = mysqli_query($connect,"SELECT * FROM tbl_danhmuc_tin order by danhmuctin_id DESC");
            ?>
            <select name="danhmuc" id="" class="form-control">
              <option value="0">Chọn danh mục</option>
              <?php 
              while($row = mysqli_fetch_array($sql_danhmuc)){
                if($id_category == $row['danhmuctin_id']){
                  ?>
                <option selected value="<?php echo $row['danhmuctin_id'] ?>"><?php echo $row['danhmuctin_name'] ?> </option>
                <?php } 
                else { ?>
                  <option  value="<?php echo $row['danhmuctin_id'] ?>"><?php echo $row['danhmuctin_name'] ?> </option>
               <?php }}?>
            </select>
          </div>
          <input type="submit" class="btn btn-success" name="capnhatbaiviet" value="Cập nhật sản phẩm">
        </form>
     </div>
     <?php } 
     else {?>
     <div class="col-md-3">
        <h4>Thông tin bài viết</h4>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="">Tên bài viết</label><br>
            <input type="text" name="tenbaiviet" class="form-control" value="<?php  ?>">
          </div>
          <div class="form-group">
            <label for="">Ảnh bài viết</label><br>
            <input type="file" name="hinhanh" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Tóm tắt</label><br>
            <textarea  type="text" name="tomtat" class="form-control" placeholder="Tóm tắt"></textarea>
          </div>
          <div class="form-group">
            <label for="">Nội dung</label><br>
            <textarea type="text" name="noidung" class="form-control" placeholder="Nội dung"></textarea>
          </div>
          <div class="form-group">
            <label for="">Danh mục</label><br>
            <?php 
            $sql_danhmuc = mysqli_query($connect,"SELECT * FROM tbl_danhmuc_tin order by danhmuctin_id DESC");
            ?>
            <select name="danhmuc" id="" class="form-control">
              <option value="0">Chọn danh mục</option>
              <?php 
              while($row = mysqli_fetch_array($sql_danhmuc)){
                if($id_category == $row['danhmuctin_id']){
                  ?>
                <option selected value="<?php echo $row['danhmuctin_id'] ?>"><?php echo $row['danhmuctin_name'] ?> </option>
                <?php } 
                else { ?>
                  <option  value="<?php echo $row['danhmuctin_id'] ?>"><?php echo $row['danhmuctin_name'] ?> </option>
               <?php }}?>
            </select>
          </div>
          <input type="submit" class="btn btn-success" name="thembaiviet" value="Thêm bài viết">
        </form>
     </div>
     <?php }?>
     <div class="col-md-8">
        <h4>Danh sách bài viết</h4>
        <table class="table">
          <thead class="table-dark">
          <tr>
                <th>Thứ tự</th>
                <th>Tên bài viết</th>
                <th>Ảnh bài viết</th>
                <th>Nội dung</th>
                <th>Danh mục</th>
                <th>Quản lý</th>
            </tr>
          </thead>
            <tbody>
                <?php
                $sql_select_baiviet = mysqli_query($connect,'SELECT * FROM tbl_baiviet,tbl_danhmuc_tin
                where tbl_baiviet.danhmuctin_id = tbl_danhmuc_tin.danhmuctin_id order by tbl_baiviet.baiviet_id ASC');
                $i = 0;
                 while($row_baiviet = mysqli_fetch_assoc($sql_select_baiviet)){ 
                    $i++;
                    ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row_baiviet['tenbaiviet']  ?></td>
                    <td><img style="width:100px" src="../uploads/<?php echo $row_baiviet['baiviet_image'] ?>" alt=""></td>
                    <td><?php echo $row_baiviet['noidung'] ?></td>
                    <td><?php echo $row_baiviet['danhmuctin_name'] ?></td>
                    <td><a href="?xoa=<?php echo $row_baiviet['baiviet_id'] ?>">Xóa</a> ||
                    <a href="?quanly=capnhat&&id=<?php echo $row_baiviet['baiviet_id'] ?>">Sửa</a></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
     </div>
    </div>
</div>
</body>
</html>