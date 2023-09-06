<?php
$title = 'Xóa chủ đề';
require '../inc/init.php';
require '../class/Database.php';
require '../class/Topic.php';
require '../class/Auth.php';

$error = Auth::requireLogin();

$id = $_GET["id"];

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$pdo = $db->getConn();

$topic = topic::getOneByID($pdo, $id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $topic->id = $id;

    if ($topic->delete($pdo, $id)) {
        header('location: topic-manager.php');
    }
}

?>

<?php
require 'inc/header.php';
?>

<div class="content"><?php if ($error) : ?>
        <h1 style="text-align: center; margin-top: 30vh; transform: translateY(-50%); color: red"><?= $error . "xóa chủ đề" ?></h1>
    <?php else : ?>
        <h2>Xác nhận xóa chủ đề này</h2>
        <form action="" method="post">
            <table class="table">
                <tr>
                    <th>Id</th>
                    <td><?= $topic->id ?></td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td><?= $topic->name ?></td>
                </tr>
            </table>
            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa chủ đề này không?')" style="margin-top: 30px; background-color:red">Delete</button>
            <a href="topic.php?id=<?= $topic->id ?>" class="btn btn-danger" style="margin-top: 30px; background-color:black">Cancel</a>
        </form>
    <?php endif; ?>
</div>

<?php require 'inc/footer.php'; ?>