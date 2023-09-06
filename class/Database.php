<?php
class Database
{
    protected $db_host;
    protected $db_name;
    protected $db_user;
    protected $db_pass;
    public function __construct($host, $name, $user, $pass)
    {
        $this->db_host = $host;
        $this->db_name = $name;
        $this->db_user = $user;
        $this->db_pass = $pass;
    }
    public function getConn()
    {
        $dsn = "mysql:host={$this->db_host};dbname={$this->db_name};charset=UTF8";

        try {
            $pdo = new PDO($dsn, $this->db_user, $this->db_pass);

            return $pdo;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}
