<?php


namespace core\components\db;
/**
 * Class Db
 * Класс для работы с базой данных
 * @package core\components\db
 */
use core\contracts\BootstrapInterface;
use core\contracts\ComponentInterface;


class Db implements ComponentInterface, BootstrapInterface
{
    /**
     * @var string Хост
     */
    protected $host;

    /**
     * @var string Пользователь
     */
    protected $user;

    /**
     * @var string Пароль
     */
    protected $password;

    /**
     * @var string База данных
     */
    protected $db;

    private $connection;

    /**
     * Db constructor.
     * @param $host
     * @param $user
     * @param $password
     * @param $db
     */
    public function __construct($host, $user, $password, $db)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->db = $db;
        $this->connect();
    }

    /**
     * Метод для соединения базу данных
     */
    public function connect()
    {
        $dsn = 'mysql:dbname=' . $this->db . ';host=' . $this->host;
        $this->connection = new \PDO($dsn, $this->user, $this->password);
    }

    /**
     * Метод для отправки sql запроса
     *
     * @param string $sql
     * @return array|null|false
     */
    public function query(string $sql)
    {
        $result = $this->connection->query($sql);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Метод для создание экземпляра QueryBuilder
     * @return QueryBuilder
     */
    public function newBuilder(){
        return new QueryBuilder($this);
    }

    public function bootstrap()
    {
        // TODO: Implement bootstrap() method.
    }
}