<?php
$title = 'Xóa user';
require '../inc/init.php';
require '../class/Database.php';
require '../class/User.php';
require '../class/Auth.php';

$error = Auth::requireLogin();

$id = $_GET["id"];

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$pdo = $db->getConn();

$user = User::getOneByID($pdo, $id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user->id = $id;

    if ($user->delete($pdo, $id)) {
        header('location: user-manager.php');
    }
}

?>

<?php
require 'inc/header.php';
?>

<div class="content"><?php if ($error) : ?>
        <h1 style="text-align: center; margin-top: 30vh; transform: translateY(-50%); color: red"><?= $error . "xóa user" ?></h1>
    <?php else : ?>
        <h2>Xác nhận xóa user này</h2>
        <form action="" method="post">
            <table class="table">
                <tr>
                    <th>Id</th>
                    <td><?= $user->id ?></td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td><?= $user->username ?></td>
                </tr>
            </table>
            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa user này không?')" style="margin-top: 30px; background-color:red">Delete</button>
            <a href="user.php?id=<?= $user->id ?>" class="btn btn-danger" style="margin-top: 30px; background-color:black">Cancel</a>
        </form>
    <?php endif; ?>
</div>

<?php require 'inc/footer.php'; ?>