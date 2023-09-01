<?php

namespace OnlineShop\Models;

class Database
{
    protected $pdo;

    /**
     * @__construct - connect to database
     */
    public function __construct()
    {
        $configPath = __DIR__ . '/../../config/database.php';

        if (!file_exists($configPath)) {
            die('<p class="error">Database configuration file not found.</p>');
        }
        
        try{
            $config = require $configPath;
            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']}";
            $this->pdo = new \PDO($dsn, $config['username'], $config['password']);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die('<p class="error">Connection failed: ' . $e->getMessage() . '</p>');
            return null;
        }
    }

    /**
     * @fetch : fetch specific data in a table from database
     */
    public function fetch($query, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch(\PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            die('<p class="error">Query failed: ' . $e->getMessage() . '</p>');
            return null;
        }
    }

    /**
     * @fetchArray : fetch data in a table as an array from database
     */
    public function fetchArray($query, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            die('<p class="error">Query failed: ' . $e->getMessage() . '</p>');
            return null;
        }
    }

    /**
     * @fetchAll: fetch all data in a table from database
     * return: array
     */
    public function fetchAll($query, $params = []): array
    {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(\PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            die('<p class="error">Query failed: ' . $e->getMessage() . '</p>');
            return null;
        }
    }

    /**
     * @insert: insert data to databse table
     * return: bool
     */
    public function insert($table, $data): bool
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->pdo->prepare($query);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    /**
     * @update: update data in database table
     * return: bool
     */
    public function update($table, $data, $condition): bool
    {
        $set = '';
        foreach ($data as $key => $value) {
            $set .= "$key = :$key, ";
        }
        $set = rtrim($set, ', ');

        $query = "UPDATE $table SET $set WHERE $condition";
        $stmt = $this->pdo->prepare($query);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    /**
     * @delete: delete data from database table
     * return: bool
     */
    public function delete($query, $params = []): bool
    {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            return true;
        } catch (\PDOException $e) {
            die('<p class="error">Query failed: ' . $e->getMessage() . '</p>');
            return false;
        }
    }

    /**
     * @beginTransaction
     */
    public function beginTransaction()
    {
        return $this->pdo->beginTransaction();
    }

    /**
     * @commit
     */
    public function commit()
    {
        return $this->pdo->commit();
    }

    /**
     * @rollBack
     */
    public function rollBack()
    {
        return $this->pdo->rollBack();
    }
}


?>