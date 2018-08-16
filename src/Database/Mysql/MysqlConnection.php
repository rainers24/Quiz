<?php

namespace Quiz\Database\Mysql;

use PDO;
use Quiz\Interfaces\ConnectionInterface;

class MysqlConnection implements ConnectionInterface
{
    /**
     * @var MysqlConnectionConfig
     */
    protected $config;
    /**
     * @var PDO
     */
    protected $connection;

    public function __construct(MysqlConnectionConfig $config = null)
    {
        if (!$config) {
            $config = new MysqlConnectionConfig();
        }
        $this->config = $config;
        $this->connect();
    }

    public function connect()
    {
        $dsn = $this->getDataSourceName();
        $this->connection = new PDO($dsn, $this->config->user, $this->config->password);

    }

    /**
     * @param string $table
     * @param array $conditions
     * @param array $select
     * @return array
     */
    public function select(string $table, array $conditions = [], array $select = []): array
    {
        $conditionSql = '';
        if ($conditions) {
            $conditionStatements = [];
            $conditionSql = 'WHERE ';
            foreach ($conditions as $attribute => $value) {
                $conditionStatements[] = implode(' = ', [$attribute, '?']);
            }

            $conditionSql .= implode(' AND ', $conditionStatements);
        }
        $select = $this->buildSelect($select);
        $sql = "SELECT $select FROM $table $conditionSql";

        $statement = $this->connection->prepare($sql);
        $statement->execute(array_values($conditions));

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    protected function buildSelect (array $select = []): string {
        if(!$select) {
            return '*';
        } return implode(',' , $select);

    }

    /**
     * @param string $table
     * @param string $primaryKey
     * @param array $attributes
     * @return bool
     */
    public function insert(string $table, string $primaryKey, array $attributes): bool
    {
        $attributes = $this->prepareAttributes($attributes, $primaryKey);
        $attributeSql = implode(',', array_keys($attributes));
        $valueSql = implode(',', array_fill(0, count($attributes), '?'));
        $sql = "INSERT INTO $table($attributeSql) VALUES ($valueSql)";
        $statement = $this->connection->prepare($sql);

        return $statement->execute(array_values($attributes));
    }

    /**
     * @param string $table
     * @param string $primaryKey
     * @param array $attributes
     * @return bool
     */
    public function update(string $table, string $primaryKey, array $attributes): bool
    {
        $primaryKey = "$primaryKey = $attributes[$primaryKey]";
        $attributes = $this->prepareAttributes($attributes, $primaryKey);
        $updateStatements= [];

        foreach ($attributes as $attribute => $value) {
            $updateStatements[] =implode()

        }
    }

    /**
     * @param string $table
     * @return array
     */
    public function fetchColumns(string $table): array
    {
        $statement = $this->connection->prepare();
    }

    private function getDataSourceName(): string
    {
        return $this->config->driver . 'host=' . $this->config->host . ';charset=utf8;dbname=' . $this->config->database;
    }

    protected function prepareStatement(string $sql , array $params): \PDOStatement{


    }
    /**
     * @param array $attributes
     * @param $primaryKey
     * @return array $attributes
     */
    private function prepareAttributes($attributes, $primaryKey)
    {
        if (isset($attributes[$primaryKey])) {
            unset($attributes[$primaryKey]);
        }
        return $attributes;
    }


}