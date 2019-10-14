<?php

namespace lib\MyLib\Controller;

use lib\MyLib\Request;

//абстрактный контроллер
class AbstractController
{
    //dispatch - используя объект Request получает параметр action, находит соответсвующую функцию в текущем классе и вызвает её
    public function dispatch() {
        $request = Request::getInstance();
        $action = $request->getParam('action');

        $function = $action . "Action";
        $this->$function();
    }

    //[name]Action - action , (indexAction , viewAction и т.д.)  - выполнение действия, так же здесь выполняется rendering шаблона, используя объект View.php если требуется
    public function indexAction() {
        var_dump('indexAction');
    }

    public function viewAction() {
        var_dump('viewAction');
    }
}
