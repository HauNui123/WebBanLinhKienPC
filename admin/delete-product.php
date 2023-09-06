<?php
$title = 'Xóa sản phẩm';
require '../inc/init.php';
require '../class/Database.php';
require '../class/Product.php';
require '../class/Auth.php';

$error = Auth::requireLogin();

$id = $_GET["id"];

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$pdo = $db->getConn();

$product = Product::getOneByID($pdo, $id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $product->id = $id;

    if ($product->delete($pdo, $id)) {
        if (!empty($product->image)) {
            $imagePath = 'uploads/' . $product->image;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
        header('location: product-manager.php');
    }
}

?>

<?php
require 'inc/header.php';
?>

<div class="content"><?php if ($error) : ?>
        <h1 style="text-align: center; margin-top: 30vh; transform: translateY(-50%); color: red"><?= $error . "xóa sản phẩm" ?></h1>
    <?php else : ?>
        <h2>Xác nhận xóa sản phẩm này</h2>
        <form action="" method="post">
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
                    <td><?= $product->image ?></td>
                </tr>
            </table>
            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')" style="margin-top: 30px; background-color:red">Delete</button>
            <a href="product.php?id=<?= $product->id ?>" class="btn btn-danger" style="margin-top: 30px; background-color:black">Cancel</a>
        </form>
    <?php endif; ?>
</div>

<?php require 'inc/footer.php'; ?>