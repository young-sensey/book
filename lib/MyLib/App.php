<?php

namespace lib\MyLib;

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
        $request->setParam('conn', $conn);

        session_start();
        if (!isset($_SESSION["page_active"])) {
            $_SESSION["page_active"] = 1;
        }
        if ($request->getParam('page')) {
            $_SESSION["page_active"] = $request->getParam('page');
        }

        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $request->setParam('ajax_request', true);
        } else {
            $request->setParam('ajax_request', false);
        }

//        $response = Response::getInstance();
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
        $response->send();
    }
}