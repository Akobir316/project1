<?php
namespace core\contracts;
interface ContainerInterface{
    public function get();
    public function has();
}