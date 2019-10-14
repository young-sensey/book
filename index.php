<?php

include_once 'lib/MyLib/includes/autoload.php';

use lib\MyLib\App;

$app = new App();
$app->init();
$app->run();
