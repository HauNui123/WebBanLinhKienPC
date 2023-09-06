<?php
$title = 'Thêm chủ đề';
require '../inc/init.php';
require '../class/Database.php';
require '../class/User.php';
require '../class/Auth.php';

$error = Auth::requireLogin();

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$pdo = $db->getConn();

$username = '';
$password = '';
$email = '';
$role = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $role = $_POST['role'];

    $user = new User();
    $user->username = $username;
    $user->password = $password;
    $user->email = $email;
    $user->role = $role;

    if ($user->create($pdo)) {
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
        <h1 style="text-align: center; margin-top: 30vh; transform: translateY(-50%); color: red"><?= $error . "thêm user" ?></h1>
    <?php else : ?>
        <h2 style="text-align: center;">THÊM USER MỚI</h2>
        <form method="post" class="w-50 m-auto">
            <div class="mb-3">
                <label for="username">Tên đăng nhập:</label> <span class='text-danger fw-bold'>*</span>
                <input class="form-control" id="username" name="username" value="<?= $username ?>" required>
            </div>
            <div class="mb-3">
                <label for="password">Mật khẩu:</label> <span class='text-danger fw-bold'>*</span>
                <input class="form-control" id="password" name="password" value="<?= $password ?>" required>
            </div>
            <div class="mb-3">
                <label for="email">Email:</label> <span class='text-danger fw-bold'>*</span>
                <input class="form-control" id="email" name="email" value="<?= $email ?>" required>
            </div>
            <div class="mb-3">
                <label for="role">Quyền:</label>
                <select class="form-select" id="role" name="role">
                    <option value="">Chọn một quyền</option>
                    <option value="admin">Admin</option>
                    <option value="customer">Customer</option>
                </select>
            </div>
            <div class="d-flex">
                <button type="submit" name="submit" value="Submit" class="btn btn-primary">Thêm mới</button>
            </div>

        </form>
    <?php endif; ?>
</div>

<?php require 'inc/footer.php'; ?>