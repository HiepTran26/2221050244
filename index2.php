<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buổi 2</title>
</head>
<body>
    
    <form action="login.php" method="post">
        <h1>Đăng nhập</h1>
       <div>
        <input type="text" name="username" placeholder="Tên đăng nhập">
       </div>
       <div>
        <input type="text" name="password" placeholder="Mật khẩu">
       </div>
       <div>
        <input type="submit" value="Đăng nhập">
       </div>
    </form>
    <?php
    if(isset($_POST['username']) && isset($_POST['password'])){
    $tenDangNhap = $_POST['username'];
    $matKhau = $_POST['password'];
    echo $matKhau;
    }


    //Nếu tên đăng nhập =admin
    //Mật khẩu 123 thì cho phép người dùng truy cập


    ?>
</body>
</html>