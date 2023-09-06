<?php
$title = 'Liên hệ';
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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

$name = '';
$email = '';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = SMTP_HOST;                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = SMTP_USER;                     //SMTP username
        $mail->Password   = SMTP_PASS;                                 //SMTP password
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('nhat7858@gmail.com', 'Admin');
        $mail->addAddress('nhat7858@gmail.com', 'Admin');     //Add a recipient

        $mail->addReplyTo($email, $name);
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Day la mail cua khach hang';
        $mail->Body    = "{$message}";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();

        $mail->setFrom('nhat7858@gmail.com', 'Admin');
        $mail->addAddress($email, $name);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Thank you!';
        $mail->Body    = 'Cảm ơn bạn đã gửi thông tin cho chúng tôi!';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        header('location: index.php');
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<?php
require 'inc/header.php';
?>

<div class="container-fluid" style="padding-bottom: 30px; padding-top: 30px;">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <form method="post" class="p-4 p-md-5 border rounded bg-light">
                <h2 class="text-center mb-4">THÔNG TIN LIÊN HỆ</h2>
                <div class="mb-3">
                    <label for="name" class="form-label">Tên:</label> <span class='text-danger fw-bold'>*</span>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên của bạn" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label> <span class='text-danger fw-bold'>*</span>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email của bạn" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Nội dung:</label> <span class='text-danger fw-bold'>*</span>
                    <textarea class="form-control" id="message" name="message" placeholder="Nhập nội dung của bạn" required></textarea>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php require 'inc/footer.php' ?>