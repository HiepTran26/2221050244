<?php
require 'connect.php';
session_start();

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $birthday = $_POST['birthday'] ?: null;
    $role = $_POST['role'] ?? 'user';

    if ($username === '') $errors[] = "Tên đăng nhập bắt buộc.";
    if ($password === '') $errors[] = "Mật khẩu bắt buộc.";
    if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email không hợp lệ.";

    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (username, password, fullname, email, phone, birthday, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $username, $hash, $fullname, $email, $phone, $birthday, $role);
        if ($stmt->execute()) {
            $_SESSION['msg'] = "Thêm người dùng thành công.";
            header("Location: index.php");
            exit;
        } else {
            if ($conn->errno === 1062) $errors[] = "Username đã tồn tại.";
            else $errors[] = "Lỗi: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Thêm người dùng</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
  <h1>Thêm người dùng</h1>
  <?php if($errors): ?>
    <div class="message" style="background:#fdecea; border-color:#f5c6cb;">
      <?php foreach($errors as $e) echo htmlspecialchars($e) . "<br>"; ?>
    </div>
  <?php endif; ?>

  <div class="form-box">
    <form method="post">
      <label>Tên đăng nhập</label>
      <input type="text" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">

      <label>Mật khẩu</label>
      <input type="password" name="password">

      <label>Họ tên</label>
      <input type="text" name="fullname" value="<?= htmlspecialchars($_POST['fullname'] ?? '') ?>">

      <label>Email</label>
      <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">

      <label>Số điện thoại</label>
      <input type="text" name="phone" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">

      <label>Ngày sinh</label>
      <input type="date" name="birthday" value="<?= htmlspecialchars($_POST['birthday'] ?? '') ?>">

      <label>Vai trò</label>
      <select name="role">
        <option value="user" <?= (($_POST['role'] ?? '') === 'user') ? 'selected' : '' ?>>user</option>
        <option value="admin" <?= (($_POST['role'] ?? '') === 'admin') ? 'selected' : '' ?>>admin</option>
      </select>
      <br><br>
      <button class="btn btn-primary" type="submit">Thêm</button>
      <a href="index.php" class="btn">Hủy</a>
    </form>
  </div>
</div>
</body>
</html>