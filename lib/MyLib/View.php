<?php

namespace lib\MyLib;

//класс отвечающий за рендеринг шаблонов (см http://php.net/manual/ru/book.outcontrol.php)
class View
{
    static private $folder = 'view/templates';

//    выполняет рендер шаблона с переданными переменными, возвращает результат в виде html
    static public function renderTemplate($template, array $data = [])
    {
        extract($data);
        ob_start();
        include(self::$folder."/{$template}.phtml");
        return ob_get_clean();
    }
}
