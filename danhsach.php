<?php
require 'connect.php';
session_start();
$search = $_GET['q'] ?? '';

if ($search) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE username LIKE CONCAT('%',?,'%') OR fullname LIKE CONCAT('%',?,'%') ORDER BY id DESC");
    $stmt->bind_param("ss", $search, $search);
} else {
    $stmt = $conn->prepare("SELECT * FROM users ORDER BY id DESC");
}
$stmt->execute();
$res = $stmt->get_result();
$users = $res->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Danh sách người dùng</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
  <h1>Quản lý người dùng</h1>

  <?php if(!empty($_SESSION['msg'])): ?>
    <div class="message"><?= htmlspecialchars($_SESSION['msg']) ?></div>
    <?php unset($_SESSION['msg']); endif; ?>

  <div style="display:flex; justify-content:space-between; align-items:center;">
    <form method="get" style="margin:0;">
      <input type="text" name="q" placeholder="Tìm username hoặc họ tên" value="<?= htmlspecialchars($search) ?>">
      <button class="btn" type="submit">Tìm</button>
    </form>
    <a href="add_user.php" class="btn btn-primary">Thêm người dùng</a>
  </div>

  <table class="table">
    <thead>
      <tr><th>#</th><th>Username</th><th>Họ tên</th><th>Email</th><th>Phone</th><th>Ngày sinh</th><th>Role</th><th>Hành động</th></tr>
    </thead>
    <tbody>
    <?php if(count($users) === 0): ?>
      <tr><td colspan="8">Không có bản ghi.</td></tr>
    <?php else: foreach($users as $u): ?>
      <tr>
        <td><?= $u['id'] ?></td>
        <td><?= htmlspecialchars($u['username']) ?></td>
        <td><?= htmlspecialchars($u['fullname']) ?></td>
        <td><?= htmlspecialchars($u['email']) ?></td>
        <td><?= htmlspecialchars($u['phone']) ?></td>
        <td><?= $u['birthday'] ? htmlspecialchars($u['birthday']) : '-' ?></td>
        <td><?= htmlspecialchars($u['role']) ?></td>
        <td class="actions">
          <a href="edit_user.php?id=<?= $u['id'] ?>" class="btn">Sửa</a>
          <a href="delete_user.php?id=<?= $u['id'] ?>" onclick="return confirm('Xóa người dùng này?')" class="btn btn-danger">Xóa</a>
        </td>
      </tr>
    <?php endforeach; endif; ?>
    </tbody>
  </table>
</div>
</body>
</html>