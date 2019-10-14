<?php

namespace lib\MyLib;

//объект ответа, содержит результат выполнения запроса, это контент и http заголовки, весь контент добавляется в этот объект, никаких echo/print в контроллерах быть не должно
class Response
{
    private static $instance;

    private $content = '';
    private $headers = [];

    public static function getInstance(): Response
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

//    установка контента
    public function setContent($content)
    {
        $this->content .= $content;
    }

    public function getContent()
    {
        return $this->content;
    }

//добавлении http заголовка
    public function addHeader($name, $value)
    {
        $this->headers[$name] = $value;
    }

//получении массива http заголовков
    public function getHeaders()
    {
        return $this->headers;
    }

//вывод запроса, сначала отправляются все заголовки, затем выводиться контент
    public function send()
    {
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }
        echo $this->content;
    }

    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}
}