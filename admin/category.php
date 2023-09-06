<?php
if (!isset($_GET["id"])) {
    die("Cần cung cấp id sản phẩm !!!");
}

$id = $_GET["id"];

$title = 'Chi tiết sản phẩm';
require '../inc/init.php';
require '../class/Database.php';
require '../class/Category.php';

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$pdo = $db->getConn();

$category = Category::getOneByID($pdo, $id);

if (!$category) {
    die("id không hợp lệ");
}
?>

<?php require 'inc/header.php'; ?>

<div class="content">
    <h2>CHI TIẾT THỂ LOẠI</h2>

    <a href="edit-category.php?id=<?= $category->id ?>" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit"><i class="fas fa-edit"></i></a>
    <a href="delete-category.php?id=<?= $category->id ?>" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete"><i class="fas fa-trash"></i></a>

    <div>
        <table class="table">
            <tr>
                <th>Id</th>
                <td><?= $category->id ?></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><?= $category->name ?></td>
            </tr>
        </table>
    </div>
</div>

<?php require 'inc/footer.php'; ?>