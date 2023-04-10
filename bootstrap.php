<?php

use Core\Container;
use Core\App;

$container = new Container();

$container->bind("Core\Database", function () {
  $config = require base_path("config.php");
  return new Core\Database($config['database'], 'admin', '123456');
});

App::setContainer($container);
