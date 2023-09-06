<?php
$title = 'Giỏ hàng';
require 'class/Database.php';
require 'class/Product.php';
require 'class/Cart.php';
require 'class/Category.php';
require 'class/Topic.php';
require 'inc/init.php';

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$pdo = $db->getConn();

$topics = Topic::getAll($pdo);
$categories = Category::getAll($pdo);

if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['userid'];
$cartItems = Cart::getCartItems($pdo, $userId);
$totalQty = count($cartItems);

if (isset($_POST['update'])) {
    $cart = new Cart();
    $cart->id = $_POST['cart_id'];
    $cart->quantity = $_POST['quantity'];
    $cart->updatequantity($pdo);
    header('Location: cart.php');
    exit;
}


if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'empty') {
        $cart = new Cart();
        $cart->user_id = $userId;
        $cart->emptyCart($pdo);
    }
    if ($action == 'remove') {
        $cart = new Cart();
        $cart->id = $_GET['cart_id'];
        $cart->removeFromCart($pdo);
    }
    header('Location: cart.php');
    exit;
}


?>

<?php require 'inc/header.php'; ?>

<div class="container">
    <table class="table my-3">
        <thead>
            <tr class="text-center">
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Hình ảnh</th>
                <th>Số lượng</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $total = 0;
            foreach ($cartItems as $item) :
            ?>
                <tr class="text-center">
                    <form method="post">
                        <td><?= $i ?></td>
                        <td><?= $item->name ?></td>
                        <td><?= number_format($item->price, 0, ',', '.') ?> VNĐ</td>
                        <td><img style="max-height:50px" src="admin/uploads/<?= $item->image ?>" /></td>
                        <td>
                            <input type="number" value="<?= $item->quantity ?>" name="quantity" min="1" style="width: 50px" />
                            <input type="hidden" name="cart_id" value="<?= $item->id ?>" />
                        </td>
                        <td>
                            <input type="submit" name="update" value="Cập nhật" class="btn btn-warning" />
                            <a href="cart.php?action=remove&cart_id=<?= $item->id ?>" class="btn btn-danger">Xóa</a>
                        </td>
                    </form>
                </tr>
            <?php
                $i++;
                $total += $item->price * $item->quantity;
            endforeach; ?>
            <tr>
                <td colspan="5" class="text-center">
                    <h4>Thành tiền: <?= number_format($total, 0, ',', '.') ?> VNĐ</h4>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="my-3">
        <a href="cart.php?action=empty" class="btn btn-danger mt-2">Xóa tất cả</a>
    </div>
</div>

<?php require 'inc/footer.php'; ?>