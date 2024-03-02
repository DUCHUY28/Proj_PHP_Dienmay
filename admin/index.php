<?php 
session_start();
include '../db/db.php';
?>
<?php
if(isset($_POST['login'])){
    $taikhoan = $_POST['taikhoan'];
    $password = $_POST['password'];
    if($taikhoan ==''|| $password ==''){
        $thongbao = '<p>Xin nhập đủ thông tin</p>';
    }else {
        $sql_select_admin = mysqli_query($connect,"SELECT * FROM tbl_admin where taikhoan = '$taikhoan' && matkhau = '$password' LIMIT 1");
        $count = mysqli_num_rows($sql_select_admin);
        $row_dangnhap = mysqli_fetch_assoc($sql_select_admin);

        if($count > 0){
            $_SESSION['dangnhap'] = $row_dangnhap['admin_name'];
            $_SESSION['admin_id'] = $row_dangnhap['admin_id'];
            header('location: dashboard.php');
        }else {
            echo '<p>Tài khoản hoặc mật khẩu không chính xác</p>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <title>Login</title>
</head>
<body>
<!-- Section: Design Block -->
<section class=" text-center text-lg-start">
  <style>
    .rounded-t-5 {
      border-top-left-radius: 0.5rem;
      border-top-right-radius: 0.5rem;
    }

    @media (min-width: 992px) {
      .rounded-tr-lg-0 {
        border-top-right-radius: 0;
      }

      .rounded-bl-lg-5 {
        border-bottom-left-radius: 0.5rem;
      }
    }
  </style>
  <div class="card mb-3">
    <div class="row g-0 d-flex align-items-center">
      <div class="col-lg-4 d-none d-lg-flex">
        <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" alt="Trendy Pants and Shoes"
          class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
      </div>
      <div class="col-lg-8">
        <div class="card-body py-5 px-md-5">
            <h1>Đăng nhập Admin</h1>
          <form action="" method="post">
            <!-- Email input -->
            <div class="form-outline mb-4">
              <?php $sql_password = mysqli_query($connect,"SELECT taikhoan,matkhau From tbl_admin");
              $account = mysqli_fetch_assoc($sql_password); ?>
              <input type="text" name="taikhoan" class="form-control" value="<?php echo $account['taikhoan']  ?>"/>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <input type="password" name="password" class="form-control" value="<?php echo $account['matkhau'] ?>" />
            </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
              <div class="col d-flex justify-content-center">
                <!-- Checkbox -->
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                  <label class="form-check-label" for="form2Example31"> Nhớ thông tin </label>
                </div>
              </div>

              <div class="col">
                <!-- Simple link -->
                <a href="#!">Quên mật khẩu?</a>
              </div>
            </div>

            <!-- Submit button -->
            <button type="submit" name="login" class="btn btn-primary btn-block mb-5">Đăng nhập</button>

          </form>

        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section: Design Block -->
</body>
</html>