<?php
$title = 'Về chúng tôi';
require 'inc/init.php';
require 'class/Database.php';
require 'class/Category.php';
require 'class/Topic.php';
require 'class/Cart.php';

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$pdo = $db->getConn();

$topics = Topic::getAll($pdo);
$categories = Category::getAll($pdo);

if (isset($_SESSION['userid'])) {
    $userId = $_SESSION['userid'];
    $cartItems = Cart::getCartItems($pdo, $userId);
    $totalQty = count($cartItems);
}
?>

<?php
require 'inc/header.php';
?>

<div class="container mt-4">
    <h1>Chào mừng bạn đến với cửa hàng hoa của chúng tôi!</h1>
    <p>Tại cửa hàng hoa của chúng tôi, chúng tôi đam mê và tận hưởng việc mang đến những bông hoa tươi đẹp và tinh tế cho khách hàng. Với mong muốn tạo ra những trải nghiệm đáng nhớ và gửi đi những thông điệp yêu thương, chúng tôi tự hào cung cấp một loạt các loại hoa tươi, từ hoa cắt cành đơn giản đến những bó hoa phức tạp và sáng tạo.</p>
    <br>
    <p>Chúng tôi hiểu rằng mỗi bông hoa mang trong mình một câu chuyện riêng, và chính vì vậy chúng tôi chọn những bông hoa chất lượng nhất từ các nhà vườn và đối tác đáng tin cậy. Chúng tôi cam kết cung cấp cho bạn những bông hoa tươi, sống lâu và thể hiện sự tinh tế trong từng chi tiết.</p>
    <br>
    <p>Bên cạnh đó, chúng tôi cũng cung cấp các dịch vụ tư vấn và thiết kế hoa theo yêu cầu, giúp bạn tạo ra những buổi lễ, sự kiện đặc biệt và ngày kỷ niệm trở nên đặc sắc hơn bao giờ hết. Đội ngũ nhân viên giàu kinh nghiệm của chúng tôi sẽ đồng hành cùng bạn từ việc lựa chọn hoa cho đến việc sắp xếp và trang trí, đảm bảo rằng mỗi dự án đều mang đến sự hài lòng tuyệt đối.</p>
    <br>
    <p>Hãy ghé thăm cửa hàng hoa của chúng tôi để khám phá bộ sưu tập đa dạng của chúng tôi và trải nghiệm sự tươi mới và sắc sảo của những bông hoa tuyệt vời. Chúng tôi tin rằng mỗi bông hoa có thể tạo nên những kỷ niệm đáng nhớ và đem lại niềm vui cho mọi người xung quanh</p>
    <br>
    <p>Cảm ơn bạn đã lựa chọn cửa hàng hoa của chúng tôi. Hãy để chúng tôi giúp bạn gửi đi những thông điệp yêu thương và làm cho những khoảnh khắc trở nên đặc biệt hơn bằng những bông hoa tươi đẹp!</p>
</div>


<?php require 'inc/footer.php' ?>