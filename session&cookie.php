<?php
//cookie
# lưu ở phía người dùng
# dùng cho những thông tin ít quan trọng
$cookieName = "user";
$cookieValue = "HiepTran";
86400 = 30 ngay

setcookie($cookieName, $cookieValue, time()+(86400), "/");
if{(isset($_COOKIE)[$cookieName])
    echo "cookie đã tồn tại"
}
else{
    echo"cookie chưa tồn tại";
}


//session
# thông tin đăng nhập
#thông tin quan trọng
session_start();
$_SESSION["name"] = "Hiep 123";

echo $_SESSION["name"];


?>