<?php
class Cart
{
    public $id;
    public $user_id;
    public $pro_id;
    public $quantity;

    public function addToCart($pdo, $quantity)
    {
        $sql = "SELECT * FROM cart WHERE user_id = :user_id AND pro_id = :pro_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->bindParam(':pro_id', $this->pro_id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Cart');
        $cartItem = $stmt->fetch();

        if ($cartItem) {
            $newquantity = $cartItem->quantity + $quantity;
            $sql = "UPDATE cart SET quantity = :quantity WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':quantity', $newquantity, PDO::PARAM_INT);
            $stmt->bindParam(':id', $cartItem->id, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            $sql = "INSERT INTO cart (user_id, pro_id, quantity) VALUES (:user_id, :pro_id, :quantity)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
            $stmt->bindParam(':pro_id', $this->pro_id, PDO::PARAM_INT);
            $stmt->bindValue(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public function updatequantity($pdo)
    {
        $sql = "UPDATE cart SET quantity = :quantity WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':quantity', $this->quantity, PDO::PARAM_INT);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function removeFromCart($pdo)
    {
        $sql = "DELETE FROM cart WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function emptyCart($pdo)
    {
        $sql = "DELETE FROM cart WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public static function getCartItems($pdo, $userId)
    {
        $sql = "SELECT cart.id, cart.quantity, product.name, product.price, product.image FROM cart JOIN product ON cart.pro_id = product.id WHERE cart.user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Cart');
        $cartItems = $stmt->fetchAll();
        return $cartItems;
    }
}
