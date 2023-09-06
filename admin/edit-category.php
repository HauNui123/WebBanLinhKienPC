<?php
$title = 'Sửa thể loại';
require '../inc/init.php';
require '../class/Database.php';
require '../class/Category.php';
require '../class/Auth.php';

$error = Auth::requireLogin();

$id = $_GET["id"];

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$pdo = $db->getConn();

$category = Category::getOneByID($pdo, $id);

$name = $category->name;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];

    $category->id = $id;
    $category->name = $name;

    if ($category->update($pdo)) {
        header("Location: category.php?id={$category->id}");
        exit;
    }
}
?>

<?php
require 'inc/header.php';
?>

<div class="content">
    <?php if ($error) : ?>
        <h1 style="text-align: center; margin-top: 30vh; transform: translateY(-50%); color: red"><?= $error . "sửa thể loại" ?></h1>
    <?php else : ?>
        <h2 style="text-align: center;">SỬA THỂ LOẠI</h2>
        <form method="post" class="w-50 m-auto" enctype='multipart/form-data'>
            <div class="mb-3">
                <label for="name">Tên thể loại:</label> <span class='text-danger fw-bold'>*</span>
                <input class="form-control" id="name" name="name" value="<?= $name ?>" required>
            </div>
            <div class="d-flex">
                <button type="submit" name="submit" value="Submit" class="btn btn-primary">Lưu</button>
            </div>

        </form>
    <?php endif; ?>
</div>

<?php require 'inc/footer.php'; ?>