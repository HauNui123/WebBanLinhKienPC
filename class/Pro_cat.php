<?php
class Pro_cat
{
    public $pro_id;
    public $cat_id;

    public function create($pdo)
    {
        $sql = "INSERT INTO pro_cat(pro_id, cat_id) 
                VALUES (:pro_id, :cat_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':pro_id', $this->pro_id, PDO::PARAM_INT);
        $stmt->bindValue(':cat_id', $this->cat_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
    }

    public function delete($pdo)
    {
        $sql = "DELETE FROM pro_cat WHERE pro_id = :pro_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':pro_id', $this->pro_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
    }
}
