<?php

namespace Quiz\Repositories;

use PDO;
use Quiz\Database\Mysql\MysqlConnection;
use Quiz\Interfaces\RepositoryInterface;

abstract class DatabaseRepository implements RepositoryInterface
{
    /**
     * @var MysqlConnection
     */
    protected $connection;

    public function connect()
    {
        $this->connection = new MysqlConnection();

        return $this->connection;
    }

    public function closeConnection()
    {
        return $this->connection = null;

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getbyId(int $id)
    {
        $this->connect();
        $table = static::getTableName();
        $sql = "SELECT * FROM $table WHERE id = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$id]);

        return $statement->fetch(PDO::FETCH_ASSOC);

    }

    public function getbyCondition(string $condition = 'id = 1')
    {
        $table = static::getTableName();
        $sql = "SELECT * FROM $table where $condition";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);

    }

}
