<?php
class Topic
{
    public $id;
    public $name;

    public static function getAll($pdo)
    {
        $sql = "SELECT * FROM topic";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Topic');
            return $stmt->fetchAll();
        }
    }

    public static function getPage($pdo, $limit, $offset)
    {
        $sql = "SELECT * FROM topic ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Topic');
            return $stmt->fetchAll();
        }
    }

    public static function getOneByID($pdo, $id)
    {
        $sql = "SELECT * FROM topic WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Topic');
            return $stmt->fetch();
        }
    }

    public function create($pdo)
    {
        $sql = "INSERT INTO topic(name) 
                VALUES (:name)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
    }

    public function update($pdo)
    {
        $sql = "UPDATE topic SET name=:name WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
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
        $sql = "DELETE FROM topic WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
    }
}
