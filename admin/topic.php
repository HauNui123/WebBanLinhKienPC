<?php
if (!isset($_GET["id"])) {
    die("Cần cung cấp id sản phẩm !!!");
}

$id = $_GET["id"];

$title = 'Chi tiết sản phẩm';
require '../inc/init.php';
require '../class/Database.php';
require '../class/topic.php';

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$pdo = $db->getConn();

$topic = Topic::getOneByID($pdo, $id);

if (!$topic) {
    die("id không hợp lệ");
}
?>

<?php require 'inc/header.php'; ?>

<div class="content">
    <h2>CHI TIẾT CHỦ ĐỀ</h2>

    <a href="edit-topic.php?id=<?= $topic->id ?>" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit"><i class="fas fa-edit"></i></a>
    <a href="delete-topic.php?id=<?= $topic->id ?>" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete"><i class="fas fa-trash"></i></a>

    <div>
        <table class="table">
            <tr>
                <th>Id</th>
                <td><?= $topic->id ?></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><?= $topic->name ?></td>
            </tr>
        </table>
    </div>
</div>

<?php require 'inc/footer.php'; ?>