<?php
if (!isset($_GET["id"])) {
    die("Cần cung cấp id sản phẩm !!!");
}

$id = $_GET["id"];

require '../inc/init.php';
require '../class/Database.php';
require '../class/Product.php';

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$pdo = $db->getConn();

$product = Product::getOneByID($pdo, $id);

if (!$product) {
    die("id không hợp lệ");
}

$imagePath = "uploads/{$product->image}";

if (file_exists($imagePath)) {
    unlink($imagePath);
}

$product->image = null;
$product->update($pdo);

header("Location: product.php?id={$product->id}");
