<?php
require 'connect.php';
session_start();

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    $_SESSION['msg'] = "ID không hợp lệ.";
    header("Location: index.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$user = $res->fetch_assoc();
if (!$user) {
    $_SESSION['msg'] = "Người dùng không tồn tại.";
    header("Location: index.php");
    exit;
}

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
    if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email không hợp lệ.";

    if (empty($errors)) {
        if ($password !== '') {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET username=?, password=?, fullname=?, email=?, phone=?, birthday=?, role=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssi", $username, $hash, $fullname, $email, $phone, $birthday, $role, $id);
        } else {
            $sql = "UPDATE users SET username=?, fullname=?, email=?, phone=?, birthday=?, role=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssi", $username, $fullname, $email, $phone, $birthday, $role, $id);
        }
        if ($stmt->execute()) {
            $_SESSION['msg'] = "Cập nhật thành công.";
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
  <title>Chỉnh sửa người dùng</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
  <h1>Chỉnh sửa người dùng</h1>

  <?php if($errors): ?>
    <div class="message" style="background:#fdecea; border-color:#f5c6cb;">
      <?php foreach($errors as $e) echo htmlspecialchars($e)."<br>"; ?>
    </div>
  <?php endif; ?>

  <div class="form-box">
    <form method="post">
      <label>Tên đăng nhập</label>
      <input type="text" name="username" value="<?= htmlspecialchars($_POST['username'] ?? $user['username']) ?>">

      <label>Mật khẩu (để trống nếu không đổi)</label>
      <input type="password" name="password">

      <label>Họ tên</label>
      <input type="text" name="fullname" value="<?= htmlspecialchars($_POST['fullname'] ?? $user['fullname']) ?>">

      <label>Email</label>
      <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? $user['email']) ?>">

      <label>Số điện thoại</label>
      <input type="text" name="phone" value="<?= htmlspecialchars($_POST['phone'] ?? $user['phone']) ?>">

      <label>Ngày sinh</label>
      <input type="date" name="birthday" value="<?= htmlspecialchars($_POST['birthday'] ?? $user['birthday']) ?>">

      <label>Vai trò</label>
      <select name="role">
        <option value="user" <?= (($_POST['role'] ?? $user['role']) === 'user') ? 'selected' : '' ?>>user</option>
        <option value="admin" <?= (($_POST['role'] ?? $user['role']) === 'admin') ? 'selected' : '' ?>>admin</option>
      </select>

      <br><br>
      <button class="btn btn-primary" type="submit">Cập nhật</button>
      <a href="index.php" class="btn">Hủy</a>
    </form>
  </div>
</div>
</body>
</html>