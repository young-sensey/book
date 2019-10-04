<?php

include_once 'lib/Book/includes/autoload.php';

use lib\Book\App;

$app = new App();
$app->init();
$app->run();
