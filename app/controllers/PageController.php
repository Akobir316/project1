<?php


namespace app\controllers;

use core\Application;


class PageController
{

    public function viewAction($id, $test)
    {

        echo "id = {$id}<br>";
        echo "test = {$test}";
    }
}