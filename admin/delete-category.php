<?php
$title = 'Xóa thể loại';
require '../inc/init.php';
require '../class/Database.php';
require '../class/Category.php';
require '../class/Auth.php';

$error = Auth::requireLogin();

$id = $_GET["id"];

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$pdo = $db->getConn();

$category = Category::getOneByID($pdo, $id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $category->id = $id;

    if ($category->delete($pdo, $id)) {
        header('location: category-manager.php');
    }
}

?>

<?php
require 'inc/header.php';
?>

<div class="content"><?php if ($error) : ?>
        <h1 style="text-align: center; margin-top: 30vh; transform: translateY(-50%); color: red"><?= $error . "xóa thể loại" ?></h1>
    <?php else : ?>
        <h2>Xác nhận xóa thể loại này</h2>
        <form action="" method="post">
            <table class="table">
                <tr>
                    <th>Id</th>
                    <td><?= $category->id ?></td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td><?= $category->name ?></td>
                </tr>
            </table>
            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa thể loại này không?')" style="margin-top: 30px; background-color:red">Delete</button>
            <a href="category.php?id=<?= $category->id ?>" class="btn btn-danger" style="margin-top: 30px; background-color:black">Cancel</a>
        </form>
    <?php endif; ?>
</div>

<?php require 'inc/footer.php'; ?>