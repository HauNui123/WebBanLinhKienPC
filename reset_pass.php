<?php
if (!isset($_GET["userid"])) {
    die("Cần cung cấp userid !!!");
}
if (!isset($_GET["token"])) {
    die("Cần cung cấp token !!!");
}

$title = 'Đặt lại mật khẩu';
require 'inc/init.php';
require 'class/Database.php';
require 'class/Category.php';
require 'class/Topic.php';
require 'class/Cart.php';
require 'class/Auth.php';
require 'class/User.php';

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$pdo = $db->getConn();

$topics = Topic::getAll($pdo);
$categories = Category::getAll($pdo);

$userid = $_GET['userid'];
$token = $_GET['token'];

$user = User::getOneByID($pdo, $userid);

$error = '';

$reset_time = Auth::checkToken($pdo, $token);
date_default_timezone_set('Asia/Ho_Chi_Minh');
$current_time = date('Y-m-d H:i:s');

if (!$reset_time) {
    $error = 'token không hợp lệ!';
} else {
    $reset_time = new DateTime($reset_time);
    $current_time = new DateTime($current_time);

    $interval = $current_time->diff($reset_time);
    $hours_passed = $interval->h + ($interval->days * 24);

    if ($hours_passed > 1) {
        $error = 'Link đã hết hạn vui lòng yêu cầu gửi link mới!';
    }
}

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user->password = $password;
    $user->id = $userid;
    $user->updatePass($pdo);
    header('Location: login.php');
}

?>

<?php
require 'inc/header.php';
?>

<?php if ($error) : ?>
    <h1><?= $error ?></h1>
<?php else : ?>
    <div class="container-fluid" style="padding-bottom: 30px; padding-top: 30px;">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form method="post" class="p-4 p-md-5 border rounded bg-light">
                    <h2 class="text-center mb-4">ĐẶT MẬT KHẨU MỚI</h2>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu mới:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu mới của bạn" required>
                    </div>
                    <div class="text-start mt-4">
                        <label class="form-check-label" for="showPasswordCheckbox">Hiện mật khẩu</label>
                        <input type="checkbox" id="showPasswordCheckbox">
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php require 'inc/footer.php' ?>