<?php
if (!isset($_GET["id"])) {
    die("Cần cung cấp id sản phẩm !!!");
}

$id = $_GET["id"];

$title = 'Chi tiết sản phẩm';
require 'class/Database.php';
require 'class/Product.php';
require 'class/Category.php';
require 'class/Topic.php';
require 'class/Cart.php';
require 'inc/init.php';

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$pdo = $db->getConn();

$topics = Topic::getAll($pdo);
$categories = Category::getAll($pdo);

$product = Product::getOneByID($pdo, $id);

if (isset($_SESSION['userid'])) {
    $userId = $_SESSION['userid'];
    $cartItems = Cart::getCartItems($pdo, $userId);
    $totalQty = count($cartItems);
}

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $quantity = $_POST['quantity'];
    if (isset($_GET['action']) && $_GET['action'] == 'addcart') {
        if (!isset($_SESSION['userid'])) {
            header('Location: login.php');
            exit;
        }
        $cart = new Cart();
        $cart->pro_id = $_GET['proid'];
        $cart->user_id = $_SESSION['userid'];
        $cart->addToCart($pdo, $quantity);
        header("Location: product.php?id={$product->id}");
        exit;
    }
}
if (!$product) {
    die("id không hợp lệ");
}
?>

<?php require 'inc/header.php'; ?>

<div class="d-flex justify-content-center mt-4">
    <h2>CHI TIẾT SẢN PHẨM</h2>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <img src="admin/uploads/<?= $product->image ?>" alt="Product Image" class="img-fluid">
        </div>
        <div class="col-md-8">
            <h2>Tên sản phẩm: <?= $product->name ?></h2>
            <p>Giá: <?= number_format($product->price, 0, ',', '.') ?> VNĐ</p>
            <hr>
            <h4>Mô tả:</h4>
            <p><?= $product->description ?></p>
            <form method="post" action="product.php?id=<?= $product->id ?>&action=addcart&proid=<?= $product->id ?>">
                <input type="number" value="1" name="quantity" min="1" style="width: 50px" />
                <button class="btn btn-danger" type="submit">
                    Thêm vào giỏ hàng
                </button>
            </form>
        </div>
    </div>
</div>


<?php require 'inc/footer.php'; ?>