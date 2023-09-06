<?php
$title = 'Trang chủ | Admin';
require '../inc/init.php';
require '../class/Database.php';
require '../class/Product.php';
require '../class/Auth.php';

Auth::requireLogin();

?>

<?php require 'inc/header.php'; ?>

<!-- Page content -->
<div class="content">
    <div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
        <h1>Welcome !!!</h1>
    </div>

</div>



<?php require 'inc/footer.php'; ?>