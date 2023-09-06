<?php
$title = 'Sửa chủ đề';
require '../inc/init.php';
require '../class/Database.php';
require '../class/User.php';
require '../class/Auth.php';

$error = Auth::requireLogin();

$id = $_GET["id"];

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$pdo = $db->getConn();

$user = User::getOneByID($pdo, $id);

$username = $user->username;
$password = '';
$email = $user->email;
$role = $user->role;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    $user->id = $id;
    $user->username = $username;

    if (!empty($password)) {
        $user->password = password_hash($password, PASSWORD_DEFAULT);
    }

    $user->email = $email;
    $user->role = $role;

    if ($user->update($pdo)) {
        header("Location: user.php?id={$user->id}");
        exit;
    }
}
?>

<?php
require 'inc/header.php';
?>

<div class="content">
    <?php if ($error) : ?>
        <h1 style="text-align: center; margin-top: 30vh; transform: translateY(-50%); color: red"><?= $error . "sửa user" ?></h1>
    <?php else : ?>
        <h2 style="text-align: center;">SỬA USER</h2>
        <form method="post" class="w-50 m-auto">
            <div class="mb-3">
                <label for="username">Tên đăng nhập:</label> <span class='text-danger fw-bold'>*</span>
                <input class="form-control" id="username" name="username" value="<?= $username ?>" required>
            </div>
            <div class="mb-3">
                <label for="password">Mật khẩu mới (nếu muốn đổi):</label>
                <input class="form-control" id="password" name="password" value="<?= $password ?>">
            </div>
            <div class="mb-3">
                <label for="email">Email:</label> <span class='text-danger fw-bold'>*</span>
                <input class="form-control" id="email" name="email" value="<?= $email ?>" required>
            </div>
            <div class="mb-3">
                <label for="role">Quyền:</label>
                <select class="form-select" id="role" name="role">
                    <option value="">Chọn một quyền</option>
                    <option value="admin" <?php if ($role == 'admin') echo 'selected'; ?>>Admin</option>
                    <option value="customer" <?php if ($role == 'customer') echo 'selected'; ?>>Customer</option>
                </select>
            </div>
            <div class="d-flex">
                <button type="submit" name="submit" value="Submit" class="btn btn-primary">Cập nhật</button>
            </div>

        </form>
    <?php endif; ?>
</div>

<?php require 'inc/footer.php'; ?>