<?php
if (!isset($_GET["userid"])) {
    die("Cần cung cấp id của người dùng !!!");
}

$id = $_GET["userid"];

$title = 'Hồ sơ người dùng';
require '../inc/init.php';
require '../class/Database.php';
require '../class/User.php';
require '../class/Auth.php';

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$pdo = $db->getConn();

Auth::requireLogin();

$user = User::getOneByID($pdo, $id);

if (!$user) {
    die("id không hợp lệ");
}

?>

<?php require 'inc/header.php'; ?>

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card mt-5">
                    <div class="card-header">
                        <h3 class="text-center">Profile</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <p>Tên đăng nhập: <?= $user->username ?></p>
                        </div>
                        <div class="mb-3">
                            <p>Email: <?= $user->email ?></p>
                        </div>
                        <div class="mb-3">
                            <p>Quyền: <?= $user->role ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'inc/footer.php'; ?>