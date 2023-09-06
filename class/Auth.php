<?php
class Auth
{
    public static function login($pdo, $username, $password)
    {
        $sql = "SELECT password, role, id FROM user WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result && password_verify($password, $result['password'])) {
                $_SESSION['log_detail'] = $username;
                $_SESSION['role'] = $result['role'];
                $_SESSION['userid'] = $result['id'];
                header('location: index.php');
                exit();
            }
            return 'Sai tên đăng nhập hoặc mật khẩu!';
        }
    }

    public function register($pdo, $username, $password, $role, $email)
    {

        $sql = "INSERT INTO user(username, password, email, role) 
                VALUES (:username, :password, :email, :role)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':role', $role, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        }
    }

    public static function logout()
    {
        session_destroy();
        header('location: ../index.php');
        exit();
    }

    public static function requireLogin()
    {
        if (!isset($_SESSION['log_detail'])) {
            header('location: ../login.php');
            exit();
        }
        if ($_SESSION['role'] != "admin") {
            header('location: ../index.php');
            exit();
        }
    }

    public static function checkEmail($pdo, $email)
    {
        $sql = "SELECT id FROM user WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $user_id = $stmt->fetchColumn();
                return $user_id;
            } else {
                return '';
            }
        }
    }

    public static function checkToken($pdo, $token)
    {
        $sql = "SELECT reset_time FROM user WHERE token = :token";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':token', $token, PDO::PARAM_STR);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $reset_time = $stmt->fetchColumn();
                return $reset_time;
            } else {
                return '';
            }
        }
    }
}
