<?php
if (!isset($_GET["search_query"])) {
    die("Cần cung cấp thông tin tìm kiếm !!!");
}

$title = 'Sản phẩm theo tên';
require '../inc/init.php';
require '../class/Database.php';
require '../class/Product.php';
require '../class/Auth.php';

Auth::requireLogin();

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$pdo = $db->getConn();

$searchQuery = $_GET['search_query'];

$product_per_page = 10;
$page = $_GET['page'] ?? 1;
$totalProducts = count(Product::getAllSearch($pdo, $searchQuery));
$max = ceil($totalProducts / $product_per_page);

if ($page >= 1 && $page <= $max) {
    $limit = $product_per_page;
    $offset = ($page - 1) * $product_per_page;
} else {
    if ($page < 1) {
        header('Location: product-manager.php?page=1');
    } else {
        header('Location: product-manager.php?page=' . $max);
    }
}

$data = Product::getPageAdminSearch($pdo, $searchQuery, $limit, $offset);

?>

<?php require 'inc/header.php'; ?>

<!-- Page content -->
<div class="content">
    <div class="d-flex mt-4">
        <a class="btn btn-primary" href="new-product.php">Thêm sản phẩm mới</a>
    </div>

    <table class="table mt-4">
        <thead class="table-light">
            <tr>
                <?php foreach ($data[0] as $key => $value) : ?>
                    <?php if ($key !== 'topic_id' && $key !== 'category_id') : ?>
                        <th><?= $key ?></th>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $product) : ?>
                <tr>
                    <td><?= $product->id ?></td>
                    <td><a href="product.php?id=<?= $product->id ?>"><?= $product->name ?></a></td>
                    <td><?= $product->description ?></td>
                    <td><?= number_format($product->price, 0, ',', '.') ?> VNĐ</td>
                    <td><?= $product->image ?></td>
                    <td><?= $product->trending ? 'yes' : 'no' ?></td>
                    <td><?= $product->topic_name ?></td>
                    <td><?= $product->category_name ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php
    $max_display = 5;
    $start_page = max($page - floor($max_display / 2), 1);
    $end_page = min($start_page + $max_display, $max);
    ?>

    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item <?= ($page == 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="search.php?page=1&search_query=<?= $searchQuery ?>" aria-label="First">
                        <span aria-hidden="true">Trang đầu</span>
                        <span class="sr-only">First</span>
                    </a>
                </li>
                <li class="page-item <?= ($page == 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="search.php?page=<?= $page - 1 ?>&search_query=<?= $searchQuery ?>" aria-label="Previous">
                        <span aria-hidden="true">&lt;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <?php for ($i = $start_page; $i <= $end_page; $i++) : ?>
                    <?php if ($i == $page) : ?>
                        <li class="page-item active"><a class="btn btn-danger" href="search.php?page=<?= $i ?>&search_query=<?= $searchQuery ?>"><?= $i ?></a></li>
                    <?php else : ?>
                        <li class="page-item"><a class="page-link" href="search.php?page=<?= $i ?>&search_query=<?= $searchQuery ?>"><?= $i ?></a></li>
                    <?php endif ?>
                <?php endfor ?>

                <li class="page-item <?= ($page == $max) ? 'disabled' : '' ?>">
                    <a class="page-link" href="search.php?page=<?= $page + 1 ?>&search_query=<?= $searchQuery ?>" aria-label="Next">
                        <span aria-hidden="true">&gt;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
                <li class="page-item <?= ($page == $max) ? 'disabled' : '' ?>">
                    <a class="page-link" href="search.php?page=<?= $max ?>&search_query=<?= $searchQuery ?>" aria-label="Last">
                        <span aria-hidden="true">Trang cuối</span>
                        <span class="sr-only">Last</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

</div>

<?php require 'inc/footer.php'; ?>