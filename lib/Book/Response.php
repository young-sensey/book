<?php

namespace lib\Book;

//объект ответа, содержит результат выполнения запроса, это контент и http заголовки, весь контент добавляется в этот объект, никаких echo/print в контроллерах быть не должно
class Response
{
    private static $instance;

    public static function getInstance(): Response
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

//    установка контента
    protected function setContent($content){}

    protected function getContent(){}

//добавлении http заголовка
    protected function addHeader($name, $value){}

//получении массива http заголовков
    protected function getHeaders() {}

//вывод запроса, сначала отправляются все заголовки, затем выводиться контент
    protected function send() {}

    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}
}