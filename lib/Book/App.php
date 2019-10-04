<?php

namespace lib\Book;

//класс приложения
class App
{
    const HOST = "db";
    const USER = "root";
    const PASS = "root";
    const DB = "test";

    // начальная инициализаия, установка конфига, настройка автозагрузки, подключение к БД и т.п., создание классов Request и Response и других
    public function init()
    {
        $conn = mysqli_connect(self::HOST, self::USER, self::PASS, self::DB);
        $request = Request::getInstance();
        $request->setParam('x', 10);
        $request->setParam('y', 15);

        $response = Response::getInstance();
    }

    // запуск приложения, создание  объекта FrontController-а, запуск процесса диспетчеризаци, вывод результата объекта Response
    public function run() {
        $request = Request::getInstance();
        $response = Response::getInstance();

        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_path = parse_url($url, PHP_URL_PATH);
        $path_arr = explode("/", $url_path);

        $request->setParam('controller', $path_arr[1]);
        $request->setParam('action', $path_arr[2]);

        $front = new FrontController();
        $front->dispatch($request, $response);
    }
}