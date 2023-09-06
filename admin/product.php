<?php
if (!isset($_GET["id"])) {
    die("Cần cung cấp id sản phẩm !!!");
}

$id = $_GET["id"];

$title = 'Chi tiết sản phẩm';
require '../inc/init.php';
require '../class/Database.php';
require '../class/Product.php';

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$pdo = $db->getConn();

$product = Product::getOneByID($pdo, $id);

if (!$product) {
    die("id không hợp lệ");
}
?>

<?php require 'inc/header.php'; ?>

<div class="content">
    <h2>CHI TIẾT SẢN PHẨM</h2>

    <a href="edit-product.php?id=<?= $product->id ?>" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit"><i class="fas fa-edit"></i></a>
    <a href="delete-product.php?id=<?= $product->id ?>" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete"><i class="fas fa-trash"></i></a>

    <div>
        <table class="table">
            <tr>
                <th>Id</th>
                <td><?= $product->id ?></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><?= $product->name ?></td>
            </tr>
            <tr>
                <th>Description</th>
                <td><?= $product->description ?></td>
            </tr>
            <tr>
                <th>Price</th>
                <td><?= number_format($product->price, 0, ',', '.') ?> VNĐ</td>
            </tr>
            <tr>
                <th>Image</th>
                <td><img src="uploads/<?= $product->image ?>" />
                    <a href="delete-image.php?id=<?= $product->id ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa ảnh?')">Xóa ảnh</a>
                </td>
            </tr>
            <tr>
                <th>Chủ đề</th>
                <td><?= $product->topic_name ?></td>
            </tr>
            <tr>
                <th>Loại hoa</th>
                <td><?= $product->category_name ?></td>
            </tr>
        </table>
    </div>
</div>

<?php require 'inc/footer.php'; ?>