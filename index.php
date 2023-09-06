<?php
$title = 'Trang chủ | Sunshine';
require 'class/Database.php';
require 'class/Product.php';
require 'class/Category.php';
require 'class/Cart.php';
require 'class/Topic.php';
require 'inc/init.php';

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$pdo = $db->getConn();

$topics = Topic::getAll($pdo);
$categories = Category::getAll($pdo);

$product_per_page = 8;
$page = $_GET['page'] ?? 1;
$max = ceil(count(Product::getAll($pdo)) / $product_per_page);

if ($page >= 1 && $page <= $max) {
    $limit = $product_per_page;
    $offset = ($page - 1) * $product_per_page;
} else {
    if ($page < 1) {
        header('Location: index.php?page=1');
    } else {
        header('Location: index.php?page=' . $max);
    }
}

$data = Product::getPage($pdo, $limit, $offset);

$productTrend = Product::getTrend($pdo);

if (isset($_SESSION['userid'])) {
    $userId = $_SESSION['userid'];
    $cartItems = Cart::getCartItems($pdo, $userId);
    $totalQty = count($cartItems);
}

if (isset($_GET['action']) && $_GET['action'] == 'addcart') {
    if (!isset($_SESSION['userid'])) {
        header('Location: login.php');
        exit;
    }
    $cart = new Cart();
    $cart->pro_id = $_GET['proid'];
    $cart->user_id = $_SESSION['userid'];
    $cart->addToCart($pdo, 1);
    header('Location: index.php');
    exit;
}

?>

<?php require 'inc/header.php'; ?>

<!-- Carousel -->
<div id="demo" class="carousel slide" data-bs-ride="carousel">

    <!-- Indicators/dots -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
    </div>

    <!-- The slideshow/carousel -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="img/carosel1.png" alt="Los Angeles" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="img/carosel2.png" alt="Chicago" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="img/carosel3.png" alt="New York" class="d-block w-100">
        </div>
    </div>

    <!-- Left and right controls/icons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<div class="d-flex justify-content-center mt-4">
    <h2>SẢN PHẨM MỚI NHẤT</h2>
</div>

<div class="container mt-4">
    <div class="row">
        <?php foreach ($data as $product) : ?>
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="position-relative">
                        <a href="product.php?id=<?= $product->id ?>">
                            <img src="admin/uploads/<?= $product->image ?>" alt="Product Image" class="card-img-top">
                        </a>
                        <div class="cart-icon">
                            <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add to cart" class="btn btn-danger rounded-circle" href="index.php?action=addcart&proid=<?= $product->id ?>">
                                <i class="fas fa-cart-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title"><?= $product->name ?></h4>
                        <p class="card-text"><?= number_format($product->price, 0, ',', '.') ?> VNĐ</p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<?php
$max_display = 5;
$start_page = max($page - floor($max_display / 2), 1);
$end_page = min($start_page + $max_display - 1, $max);
?>

<!-- <div class="d-flex justify-content-center mt-4">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item <?= ($page == 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="index.php?page=1" aria-label="First">
                    <span aria-hidden="true">Trang đầu</span>
                    <span class="sr-only">First</span>
                </a>
            </li>
            <li class="page-item <?= ($page == 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="index.php?page=<?= $page - 1 ?>" aria-label="Previous">
                    <span aria-hidden="true">&lt;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <?php for ($i = $start_page; $i <= $end_page; $i++) : ?>
                <?php if ($i == $page) : ?>
                    <li class="page-item active"><a class="btn btn-danger" href="index.php?page=<?= $i ?>"><?= $i ?></a></li>
                <?php else : ?>
                    <li class="page-item"><a class="page-link" href="index.php?page=<?= $i ?>"><?= $i ?></a></li>
                <?php endif ?>
            <?php endfor ?>
            <li class="page-item <?= ($page == $max) ? 'disabled' : '' ?>">
                <a class="page-link" href="index.php?page=<?= $page + 1 ?>" aria-label="Next">
                    <span aria-hidden="true">&gt;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
            <li class="page-item <?= ($page == $max) ? 'disabled' : '' ?>">
                <a class="page-link" href="index.php?page=<?= $max ?>" aria-label="Last">
                    <span aria-hidden="true">Trang cuối</span>
                    <span class="sr-only">Last</span>
                </a>
            </li>
        </ul>
    </nav>
</div> -->

<div class="d-flex justify-content-center mt-4">
    <h2>SẢN PHẨM NỔI BẬT</h2>
</div>

<div class="container mt-4">
    <div class="row">
        <?php foreach ($productTrend as $product) : ?>
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="position-relative">
                        <a href="product.php?id=<?= $product->id ?>">
                            <img src="admin/uploads/<?= $product->image ?>" alt="Product Image" class="card-img-top">
                        </a>
                        <div class="cart-icon">
                            <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add to cart" class="btn btn-danger rounded-circle" href="index.php?action=addcart&proid=<?= $product->id ?>">
                                <i class="fas fa-cart-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title"><?= $product->name ?></h4>
                        <p class="card-text"><?= number_format($product->price, 0, ',', '.') ?> VNĐ</p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require 'inc/footer.php'; ?>