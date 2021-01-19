<?php

namespace core\components\db;
interface QueryBuilderInterface
{
    public function select($columns): QueryBuilderInterface;

    public function where($conditions): QueryBuilderInterface;

    public function table(string $table): QueryBuilderInterface;

    public function limit(int $limit): QueryBuilderInterface;

    public function offset(int $offset): QueryBuilderInterface;

    public function order($order): QueryBuilderInterface;

    public function build(): string;

    public function one(): ?array;

    public function all(): ?array;
}