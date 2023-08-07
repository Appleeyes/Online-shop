<?php

namespace OnlineShop\Models;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



class Database
{
    protected $pdo;

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


    public function delete($table, $condition): bool
    {
        $query = "DELETE FROM $table WHERE $condition";
        return $this->pdo->exec($query);
    }
}


?>