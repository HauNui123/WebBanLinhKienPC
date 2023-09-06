<?php
$title = 'Sửa chủ đề';
require '../inc/init.php';
require '../class/Database.php';
require '../class/Topic.php';
require '../class/Auth.php';

$error = Auth::requireLogin();

$id = $_GET["id"];

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$pdo = $db->getConn();

$topic = topic::getOneByID($pdo, $id);

$name = $topic->name;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];

    $topic->id = $id;
    $topic->name = $name;

    if ($topic->update($pdo)) {
        header("Location: topic.php?id={$topic->id}");
        exit;
    }
}
?>

<?php
require 'inc/header.php';
?>

<div class="content">
    <?php if ($error) : ?>
        <h1 style="text-align: center; margin-top: 30vh; transform: translateY(-50%); color: red"><?= $error . "sửa chủ đề" ?></h1>
    <?php else : ?>
        <h2 style="text-align: center;">SỬA CHỦ ĐỀ</h2>
        <form method="post" class="w-50 m-auto" enctype='multipart/form-data'>
            <div class="mb-3">
                <label for="name">Tên chủ đề:</label> <span class='text-danger fw-bold'>*</span>
                <input class="form-control" id="name" name="name" value="<?= $name ?>" required>
            </div>
            <div class="d-flex">
                <button type="submit" name="submit" value="Submit" class="btn btn-primary">Lưu</button>
            </div>

        </form>
    <?php endif; ?>
</div>

<?php require 'inc/footer.php'; ?>