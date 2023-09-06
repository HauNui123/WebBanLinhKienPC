<?php
$title = 'Quản lý thể loại';
require '../inc/init.php';
require '../class/Database.php';
require '../class/Category.php';
require '../class/Auth.php';

Auth::requireLogin();

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$pdo = $db->getConn();

$category_per_page = 10;
$page = $_GET['page'] ?? 1;
$max = ceil(count(Category::getAll($pdo)) / $category_per_page);

if ($page >= 1 && $page <= $max) {
    $limit = $category_per_page;
    $offset = ($page - 1) * $category_per_page;
} else {
    if ($page < 1) {
        header('Location: category-manager.php?page=1');
    } else {
        header('Location: category-manager.php?page=' . $max);
    }
}

$data = category::getPage($pdo, $limit, $offset);

?>

<?php require 'inc/header.php'; ?>

<!-- Page content -->
<div class="content">
    <div class="d-flex mt-4">
        <a class="btn btn-primary" href="new-category.php">Thêm thể loại mới</a>
    </div>

    <table class="table mt-4">
        <thead class="table-light">
            <tr style="font-weight: bold;">
                <?php foreach ($data[0] as $key => $value) : ?>
                    <td><?= $key ?></td>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $category) : ?>
                <tr>
                    <td><?= $category->id ?></td>
                    <td><a href="category.php?id=<?= $category->id ?>"><?= $category->name ?></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php
    $max_display = 5;
    $start_page = max($page - floor($max_display / 2), 1);
    $end_page = min($start_page + $max_display - 1, $max);
    ?>

    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item <?= ($page == 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="category-manager.php?page=1" aria-label="First">
                        <span aria-hidden="true">Trang đầu</span>
                        <span class="sr-only">First</span>
                    </a>
                </li>
                <li class="page-item <?= ($page == 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="category-manager.php?page=<?= $page - 1 ?>" aria-label="Previous">
                        <span aria-hidden="true">&lt;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <?php for ($i = $start_page; $i <= $end_page; $i++) : ?>
                    <?php if ($i == $page) : ?>
                        <li class="page-item active"><a class="btn btn-danger" href="category-manager.php?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php else : ?>
                        <li class="page-item"><a class="page-link" href="category-manager.php?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endif ?>
                <?php endfor ?>
                <li class="page-item <?= ($page == $max) ? 'disabled' : '' ?>">
                    <a class="page-link" href="category-manager.php?page=<?= $page + 1 ?>" aria-label="Next">
                        <span aria-hidden="true">&gt;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
                <li class="page-item <?= ($page == $max) ? 'disabled' : '' ?>">
                    <a class="page-link" href="category-manager.php?page=<?= $max ?>" aria-label="Last">
                        <span aria-hidden="true">Trang cuối</span>
                        <span class="sr-only">Last</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

</div>

<?php require 'inc/footer.php'; ?>