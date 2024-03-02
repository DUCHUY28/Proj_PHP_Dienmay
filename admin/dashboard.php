<?php 
session_start();
if(!isset($_SESSION['dangnhap'])){
    header('location: index.php');
}
if(isset($_GET['login'])){
    $dangxuat = $_GET['login'];
}else {
    $dangxuat = '';
}
if($dangxuat =='dangxuat'){
    session_destroy();
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome admin</title>
</head>
<body>
    <p>Xin chào : <?php echo $_SESSION['dangnhap'] ?><a href="?login=dangxuat">Đăng xuất</a></p>
</body>
</html>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="xulydonhang.php">Đơn hàng <span class="sr-only">(current)</span></a>
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
        <a class="nav-link disabled" href="">Khách hàng</a>
      </li>
    </ul>
  </div>
</nav>
