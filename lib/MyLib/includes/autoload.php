<?php
spl_autoload_register(function($className) {
    $dir_book = dirname(__DIR__) . "/../..";
    $file = $dir_book . '\\' . $className . '.php';
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);

    if (file_exists($file)) {
        include $file;
    }
});