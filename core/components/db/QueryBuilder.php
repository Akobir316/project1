<?php

namespace core\components\db;

use PDO;

class QueryBuilder implements QueryBuilderInterface
{
    protected $db;
    protected $select;
    protected $table;
    protected $where;
    protected $order;
    protected $limit;
    protected $offset;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function select($columns):QueryBuilderInterface
    {
           $this->select = $columns;
           return $this;
    }

    public function where($conditions): QueryBuilderInterface
    {
        $this->where = $conditions;
        return $this;
    }

    public function table(string $table): QueryBuilderInterface
    {
        $this->table = trim($table);
        return $this;
    }

    public function limit(int $limit): QueryBuilderInterface
    {
        $this->limit = $limit;
        return $this;
    }

    public function offset(int $offset): QueryBuilderInterface
    {
        $this->offset = $offset;
        return $this;
    }

    public function order($order): QueryBuilderInterface
    {
        $this->order = $order;
        return $this;
    }

    public function build(): string
    {
        $sql = 'SELECT ';
        if (!empty($this->select)) {
            foreach ($this->select as $item){
                $sql .= $item . ', ';
            }
            $sql = rtrim($sql, ', ');
        } else $sql .= '*';
        if(!empty($this->table)) {
            $sql .= ' FROM '.$this->table;
            if (!empty($this->where)) {
                $sql .= ' WHERE ';
               foreach ($this->where as $k => $v) {
                   $sql .= $k . '=' . "'" . $v . "'" . ' AND ' ;
               }
               $sql = rtrim($sql, 'AND ');
            }
            if (!empty($this->order)) {
                $sql .= 'ORDER BY ';
                foreach ($this->order as $k => $v){
                    $sql .= $k . ' ' . $v . ', ';
                }
                $sql = rtrim($sql, ', ');
            }
            if (!empty($this->limit)) {
                $sql .= ' LIMIT ' . $this->limit;
            }
            if (!empty($this->offset)) {
                $sql .= ' OFFSET ' . $this->offset;
            }
            return $sql;
        } throw new \Exception('Не введена таблица', 500);
    }

    public function one(): ?array
    {
        $this->limit = 1;
        $sql = $this->build();
        $result = $this->db->query($sql);
        return $result[0];
    }

    public function all(): ?array
    {
        $sql = $this->build();
        return $this->db->query($sql);
    }
}