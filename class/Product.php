<?php
class Product
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $image;
    public $trending;
    public $topic_id;
    public $category_id;

    public static function getAll($pdo)
    {
        $sql = "SELECT * FROM product";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $stmt->fetchAll();
        }
    }

    public static function getPage($pdo, $limit, $offset)
    {
        $sql = "SELECT * FROM product ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $stmt->fetchAll();
        }
    }

    public static function getPageAdmin($pdo, $limit, $offset)
    {
        $sql = "SELECT product.*, topic.name AS topic_name, category.name AS category_name
        FROM product 
        LEFT JOIN topic ON product.topic_id = topic.id
        LEFT JOIN category ON product.category_id = category.id
        ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $stmt->fetchAll();
        }
    }

    public static function getPageAdminSearch($pdo, $searchQuery, $limit, $offset)
    {
        $sql = "SELECT product.*, topic.name AS topic_name, category.name AS category_name
        FROM product 
        LEFT JOIN topic ON product.topic_id = topic.id 
        LEFT JOIN category ON product.category_id = category.id 
        WHERE product.name LIKE :searchQuery ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':searchQuery', '%' . $searchQuery . '%');
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $stmt->fetchAll();
        }
    }

    public static function getOneByID($pdo, $id)
    {
        // $sql = "SELECT * FROM product WHERE id = :id";
        $sql = "SELECT product.*, topic.name AS topic_name, category.name AS category_name
        FROM product
        LEFT JOIN topic ON product.topic_id = topic.id
        LEFT JOIN category ON product.category_id = category.id
        WHERE product.id = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $stmt->fetch();
        }
    }

    public static function getAllSearch($pdo, $searchQuery)
    {
        $sql = "SELECT * FROM product WHERE name LIKE :searchQuery";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':searchQuery', '%' . $searchQuery . '%');

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $stmt->fetchAll();
        }
    }

    public static function getPageSearch($pdo, $searchQuery, $limit, $offset)
    {
        $sql = "SELECT * FROM product WHERE name LIKE :searchQuery ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':searchQuery', '%' . $searchQuery . '%');
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $stmt->fetchAll();
        }
    }

    public static function getTrend($pdo)
    {
        $sql = "SELECT * FROM product WHERE trending = 1 LIMIT 8";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $stmt->fetchAll();
        }
    }

    public static function getAllTopic($pdo, $topic_id)
    {
        $sql = "SELECT * FROM product WHERE topic_id = :topic_id";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':topic_id', $topic_id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $stmt->fetchAll();
        }
    }

    public static function getPageTopic($pdo, $topic_id, $limit, $offset)
    {
        $sql = "SELECT * FROM product WHERE topic_id = :topic_id ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':topic_id', $topic_id, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $stmt->fetchAll();
        }
    }

    public static function getAllCategory($pdo, $category_id)
    {
        $sql = "SELECT * FROM product WHERE category_id = :category_id";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':category_id', $category_id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $stmt->fetchAll();
        }
    }

    public static function getPageCategory($pdo, $category_id, $limit, $offset)
    {
        $sql = "SELECT * FROM product WHERE category_id = :category_id ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':topic_id', $category_id, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $stmt->fetchAll();
        }
    }

    public function create($pdo)
    {
        $sql = "INSERT INTO product(name, description, price, image, trending, topic_id, category_id) 
                VALUES (:name, :desc, :price, :image, :trending, :topic_id, :category_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':desc', $this->description, PDO::PARAM_STR);
        $stmt->bindValue(':price', $this->price, PDO::PARAM_INT);
        $stmt->bindValue(':image', $this->image, PDO::PARAM_STR);
        $stmt->bindValue(':trending', $this->trending, PDO::PARAM_INT);
        $stmt->bindValue(':topic_id', $this->topic_id, PDO::PARAM_INT);
        $stmt->bindValue(':category_id', $this->category_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
    }

    public function update($pdo)
    {
        $sql = "UPDATE product SET name=:name,description=:desc,price=:price,image=:image, trending=:trending,
        topic_id=:topic_id, category_id=:category_id WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':desc', $this->description, PDO::PARAM_STR);
        $stmt->bindValue(':price', $this->price, PDO::PARAM_INT);
        $stmt->bindValue(':image', $this->image, PDO::PARAM_STR);
        $stmt->bindValue(':trending', $this->trending, PDO::PARAM_INT);
        $stmt->bindValue(':topic_id', $this->topic_id, PDO::PARAM_INT);
        $stmt->bindValue(':category_id', $this->category_id, PDO::PARAM_INT);
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
        $sql = "DELETE FROM product WHERE id = :id";
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
