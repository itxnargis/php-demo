<?php

namespace Core;
use PDO, PDOException;

class Database
{
    public $connection;
    public $statement;

    public function __construct($config)
    {
        $dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'] . ';charset=' . $config['charset'];

        try {
            $this->connection = new PDO($dsn, $config['username'], $config['password'], [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            die();
        }
    }

    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        return $this;
    }
    public function get(){
        return $this->statement->fetchAll();
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function findOrFail(){
        $result = $this->find();

        if(!$result) {
            abort();
        }
        return $result;
    }
}
