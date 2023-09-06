<?php
$title = 'Thêm chủ đề';
require '../inc/init.php';
require '../class/Database.php';
require '../class/Topic.php';
require '../class/Auth.php';

$error = Auth::requireLogin();

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$pdo = $db->getConn();

$name = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];

    $topic = new Topic();
    $topic->name = $name;

    if ($topic->create($pdo)) {
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
        <h1 style="text-align: center; margin-top: 30vh; transform: translateY(-50%); color: red"><?= $error . "thêm chủ đề" ?></h1>
    <?php else : ?>
        <h2 style="text-align: center;">THÊM CHỦ ĐỀ MỚI</h2>
        <form method="post" class="w-50 m-auto">
            <div class="mb-3">
                <label for="name">Tên chủ đề:</label> <span class='text-danger fw-bold'>*</span>
                <input class="form-control" id="name" name="name" value="<?= $name ?>" required>
            </div>
            <div class="d-flex">
                <button type="submit" name="submit" value="Submit" class="btn btn-primary">Thêm mới</button>
            </div>

        </form>
    <?php endif; ?>
</div>

<?php require 'inc/footer.php'; ?>