<?php

namespace Quiz\Repositories;

use PDO;
use Quiz\Database\Mysql\MysqlConnection;
use Quiz\Interfaces\RepositoryInterface;
use Quiz\Models\BaseModel;

abstract class BaseRepository implements RepositoryInterface
{
    /**
     * @var MysqlConnection
     */
    protected $connection;

    private static function getPrimaryKey()
    {
        return 'id';
    }

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
        $table = static::getTableName();
        $select = $this->select($table , ['id' => $id]);


        $sql = "SELECT * FROM $table WHERE id = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$id]);

        return $statement->fetch(PDO::FETCH_ASSOC);

    }

    public function save($model): bool
    {
        $connection = static::connect();
        if ($model->isNew) {
            return $connection->insert(static::getTableName(), static::getPrimaryKey(), $this->getAttributes($model));
        }
        return $connection->update(static::getTableName(), static::getPrimaryKey(), $this->getAttributes($model));
    }

        /**
     * @param array $conditions
     * @return array
     */
    public function all(array $conditions = []): array
    {
        $dataArray = static::connect()->select(static::getTableName(), $conditions);
        $instances = [];
        foreach ($dataArray as $data) {
            $instances[] = static::init($data);
        }
        return $instances;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public static function init(array $attributes)
    {
        $class = static::modelName();
        $instance = new $class;
        foreach ($attributes as $key => $value) {
            if (property_exists($class, $key)) {
                $instance->$key = $value;
            }
        }
        return $instance;
    }


    public function getbyCondition(string $condition = 'id = 1')
    {
        $table = static::getTableName();
        $sql = "SELECT * FROM $table where $condition";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);

    }

    /**
     * @param BaseModel $model
     * @return array
     */
    public function getAttributes($model): array
    {
        if (!$model->attributes) {
            $model = $this->prepareAttributes($model);
        }
        return $model->attributes;
    }
    /**
     * @param $model
     * @return BaseModel
     */
    protected function prepareAttributes($model): BaseModel
    {
        $columns = $this->connection->fetchColumns(static::getTableName());
        $attributes = [];
        foreach ($columns as $column) {
            if (property_exists(static::modelName(), $column)) {
                $attributes[$column] = $model->{$column};
            }
        }
        $model->attributes = $attributes;
        return $model;
    }






}
