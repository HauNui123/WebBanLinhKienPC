<?php
if (!isset($_GET["id"])) {
    die("Cần cung cấp id sản phẩm !!!");
}

$id = $_GET["id"];

$title = 'Chi tiết sản phẩm';
require '../inc/init.php';
require '../class/Database.php';
require '../class/User.php';

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$pdo = $db->getConn();

$user = User::getOneByID($pdo, $id);

if (!$user) {
    die("id không hợp lệ");
}
?>

<?php require 'inc/header.php'; ?>

<div class="content">
    <h2>CHI TIẾT TÀI KHOẢN</h2>

    <a href="edit-user.php?id=<?= $user->id ?>" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit"><i class="fas fa-edit"></i></a>
    <a href="delete-user.php?id=<?= $user->id ?>" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete"><i class="fas fa-trash"></i></a>

    <div>
        <table class="table">
            <tr>
                <th>Id</th>
                <td><?= $user->id ?></td>
            </tr>
            <tr>
                <th>Username</th>
                <td><?= $user->username ?></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><?= $user->password ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= $user->email ?></td>
            </tr>
            <tr>
                <th>Role</th>
                <td><?= $user->role ?></td>
            </tr>
        </table>
    </div>
</div>

<?php require 'inc/footer.php'; ?>