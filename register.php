<?php
$title = 'Đăng ký';
require 'class/Database.php';
require 'class/Product.php';
require 'class/Category.php';
require 'class/Topic.php';
require 'inc/init.php';
require 'class/Auth.php';

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$pdo = $db->getConn();

$topics = Topic::getAll($pdo);
$categories = Category::getAll($pdo);

$check = false;

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $role = "customer";
    $user =  new Auth();
    $check = $user->register($pdo, $username, $password, $role, $email);

    if ($check) {
        header("Location: index.php");
        exit;
    }
}

require 'inc/header.php';
?>

<div class="container-fluid" style="padding-bottom: 30px; padding-top: 30px;">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <form method="post" class="p-4 p-md-5 border rounded bg-light">
                <h2 class="text-center mb-4">ĐĂNG KÝ</h2>
                <div class="mb-3">
                    <label for="username" class="form-label">Tên đăng nhập:</label> <span class='text-danger fw-bold'>*</span>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên đăng nhập của bạn" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu:</label> <span class='text-danger fw-bold'>*</span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu của bạn" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label> <span class='text-danger fw-bold'>*</span>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email của bạn" required>
                </div>
                <div class="text-start mt-4">
                    <label class="form-check-label" for="showPasswordCheckbox">Hiện mật khẩu</label>
                    <input type="checkbox" id="showPasswordCheckbox">
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">Đăng ký</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php require 'inc/footer.php' ?>