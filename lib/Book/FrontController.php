<?php

namespace lib\Book;

//front-контроллер, находит и выполняет нужный контроллер
class FrontController
{
//   dispatch (диспетчеризация) - принимает на вход объекты Request и Response , находит нужный контроллер из параметров объекта Request, создает контроллер, вызывает функцию dispatch у найденного контроллера
    public function dispatch($request, $response) {
        $controller = $request->getParam('controller');

        $class = "\\lib\\Book\\Controller\\" . $controller . "Controller";
        $object = new $class();
        $object->dispatch();
    }
}