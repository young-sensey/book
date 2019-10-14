<?php

namespace lib\MyLib;

//объект запроса , содержит функции для получения входных параметров, таких как $_GET и $_POST. Напрямую $_GET и $_POST в приложении нигде не должны использоваться.
class Request
{
    private $params = [];

    private static $instance;

    public static function getInstance(): Request
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    //возвращает параметр по имени, выполняет поиск сначала в кастомных параметрах, затем в $_POST и в $_GET
    public function getParam($name) {
        $param = null;
        if (isset($this->params[$name])) {
            $param = $this->params[$name];
        } elseif (isset($_POST[$name])) {
            $param = $_POST[$name];
        } elseif (isset($_GET[$name])) {
            $param = $_GET[$name];
        }
        return $param;
    }

    //setParam($name, $value) - установка кастомного параметра
    public function setParam($name, $value) {
        $this->params[$name] = $value;
    }

    //возвращает $_POST параметр, если парметр не указан, то возвращает все post-данные
    public function gePost($name = null) {}

    //возвращает $_GET параметр, если парметр не указан, то возвращает все get-данные
    public function geQuery($name = null) {}

    //isPost() - возвращает true если текущий запрос это POST
    public function isPost() {}

    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}
}