<?php
$title = 'Quên mật khẩu';
require 'inc/init.php';
require 'class/Database.php';
require 'class/Category.php';
require 'class/Topic.php';
require 'class/Cart.php';
require 'class/Auth.php';
require 'class/User.php';

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$pdo = $db->getConn();

$topics = Topic::getAll($pdo);
$categories = Category::getAll($pdo);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

$emailErrors = '';
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $email = $_POST['email'];
    $id = Auth::checkEmail($pdo, $email);
    $user = User::getOneByID($pdo, $id);
    if (!$id) {
        $emailErrors = 'Email chưa đúng!';
    } else {
        $token = bin2hex(random_bytes(32));
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $reset_time = date('Y-m-d H:i:s');

        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = SMTP_HOST;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = SMTP_USER;                     //SMTP username
            $mail->Password   = SMTP_PASS;                               //SMTP password
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('nhat7858@gmail.com', 'Admin');
            $mail->addAddress($email, 'Customer');     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Reset password';
            $mail->Body    = "http://sunshineshop.infinityfreeapp.com/reset_pass.php?userid={$id}&token={$token}";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        $user->token = $token;
        $user->reset_time = $reset_time;

        $user->updateResetPassword($pdo);

        header('location: login.php');
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
                <h2 class="text-center mb-4">QUÊN MẬT KHẨU</h2>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label> <span class='text-danger fw-bold'>*</span>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email của bạn" required>
                </div>
                <?php if ($emailErrors) : ?>
                    <span class='text-danger fw-bold'><?= $emailErrors ?></span>
                <?php endif ?>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require 'inc/footer.php' ?>