<?php


namespace core\components\db;

use core\contracts\BootstrapInterface;
use core\contracts\ComponentInterface;

class Db implements ComponentInterface, BootstrapInterface
{
    protected $dsn;

    protected $user;

    protected $password;

    protected $connection;

    public function __construct($dsn, $user, $password)
    {
        $this->dsn = $dsn;
        $this->user = $user;
        $this->password = $password;
    }

    public function connect()
    {
        $this->connection = new \PDO($this->dsn, $this->user, $this->password);
    }

    public function query(string $sql)
    {
        $result = $this->connection->query($sql);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function newBuilder(){
        return new QueryBuilder($this);
    }

    public function bootstrap()
    {
        // TODO: Implement bootstrap() method.
    }
}