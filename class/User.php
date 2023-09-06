<?php
class User
{
    public $id;
    public $username;
    public $password;
    public $email;
    public $role;
    public $token;
    public $reset_time;

    public static function getAll($pdo)
    {
        $sql = "SELECT * FROM user";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'user');
            return $stmt->fetchAll();
        }
    }

    public static function getPage($pdo, $limit, $offset)
    {
        $sql = "SELECT * FROM user ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'user');
            return $stmt->fetchAll();
        }
    }

    public static function getOneByID($pdo, $id)
    {
        $sql = "SELECT * FROM user WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'user');
            return $stmt->fetch();
        }
    }

    public function create($pdo)
    {
        $sql = "INSERT INTO user(username, password, email, role) 
                VALUES (:username, :password, :email, :role)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
        $stmt->bindValue(':password', $this->password, PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindValue(':role', $this->role, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
    }

    public function update($pdo)
    {
        $sql = "UPDATE user SET username=:username, password=:password, email=:email, role=:role
        WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
        $stmt->bindValue(':password', $this->password, PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindValue(':role', $this->role, PDO::PARAM_STR);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
    }

    public function delete($pdo)
    {
        $sql = "DELETE FROM user WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
    }

    public function updateResetPassword($pdo)
    {
        $sql = "UPDATE user SET token = :token, reset_time = :reset_time 
        WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':token', $this->token, PDO::PARAM_STR);
        $stmt->bindValue(':reset_time', $this->reset_time, PDO::PARAM_STR);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
    }

    public function updatePass($pdo)
    {
        $sql = "UPDATE user SET password = :password, token = NULL, reset_time = NULL WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':password', $this->password, PDO::PARAM_STR);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
    }
}
