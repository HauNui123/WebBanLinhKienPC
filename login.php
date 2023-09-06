<?php
$title = 'Đăng nhập';
require 'inc/init.php';
require 'class/Database.php';
require 'class/Category.php';
require 'class/Topic.php';
require 'class/Auth.php';

$failLogin = '';

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$pdo = $db->getConn();

$topics = Topic::getAll($pdo);
$categories = Category::getAll($pdo);

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $failLogin = Auth::login($pdo, $username, $password);
}
?>

<?php
require 'inc/header.php';
?>

<div class="container-fluid" style="padding-bottom: 30px; padding-top: 30px;">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <form method="post" class="p-4 p-md-5 border rounded bg-light">
                <h2 class="text-center mb-4">ĐĂNG NHẬP</h2>
                <div class="mb-3">
                    <label for="username" class="form-label">Tên đăng nhập:</label> <span class='text-danger fw-bold'>*</span>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên đăng nhập của bạn" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu:</label> <span class='text-danger fw-bold'>*</span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu của bạn" required>
                </div>
                <div class="input-group-append">
                    <label class="form-check-label float-start" for="showPasswordCheckbox">Hiện mật khẩu</label>
                    <input type="checkbox" id="showPasswordCheckbox">
                    <a href="forget_pass.php" class="float-end">Quên mật khẩu?</a>
                </div>

                <?php if ($failLogin) : ?>
                    <span class="text-danger fw-bold"><?= $failLogin ?></span>
                <?php endif; ?>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php require 'inc/footer.php' ?>