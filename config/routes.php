<?php

use core\components\router\Router;
//define routes
Router::add('^$',['controller'=>'Main', 'action'=>'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');