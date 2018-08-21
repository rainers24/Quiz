<?php
namespace Quiz\Database\Mysql;

class MysqlConnectionConfig
{
    /**
     * @var string
     */
    public $driver = 'mysql';
    /**
     * @var string
     */
    public $host = '127.0.0.1';
    /**
     * @var string
     */
    public $user = 'rainers';
    /**
     * @var string
     */
    public $charset = 'utf8';

    /**
     * @var string
     */
    public $password = 'abcd1234';
    /**
     * @var string
     */
    public $database = 'quiz';
    /**
     * @var string
     */
    public $port  = '3306';
}