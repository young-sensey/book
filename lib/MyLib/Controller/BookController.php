<?php

namespace lib\MyLib\Controller;

use lib\MyLib\Model\Book;
use lib\MyLib\Request;
use lib\MyLib\Response;
use lib\MyLib\View;

class BookController extends AbstractController
{
    public function indexAction() {

        $model = new Book();

        $pages_info = $model->getPagesInfo();

        $filters = [
            'count' => 8,
            'page' => $pages_info["page_active"]
        ];
        $list = $model->getList($filters);

        $data = [
            'list' => $list,
            'page_active' => $pages_info["page_active"],
            'count_pages' => $pages_info["count_pages"]
        ];
        $html = View::renderTemplate("home", $data);

//        $request = Request::getInstance();
        $response = Response::getInstance();

        $response->setContent($html);
    }

    public function addAction() {
        $html = View::renderTemplate("add");
        echo $html;
    }

    public function saveAction() {
        $request = Request::getInstance();
        $response = Response::getInstance();

        $data = $request->getParam('data');

        $model = new Book();

        $validation_errors = $this->validationErrors($data);
        if (empty($validation_errors)) {
            $model->save($data);
            $response->addHeader('Location', 'http://test1.local/Book/index');
        } else {
            foreach ($validation_errors as $error) {
                var_dump($error);
            }
        }
    }

    public function validationErrors($data = [])
    {
        $errors = [];

        if (strlen($data['author']) == 0) {
            $errors[] = 'author should not be empty';
        } elseif (strlen($data['author']) > 20) {
            $errors[] = 'author must be less than 20 characters';
        }

        if (strlen($data['text']) == 0) {
            $errors[] = 'text should not be empty';
        } elseif (strlen($data['text']) > 700) {
            $errors[] = 'text must be less than 700 characters';
        }

        return $errors;
    }

    public function getlistAction()
    {
        $model = new Book();

        $pages_info = $model->getPagesInfo();
        $filters = [
            'count' => 8,
            'page' => $pages_info["page_active"]
        ];
        $list = $model->getList($filters);

        $request = Request::getInstance();
        $response = Response::getInstance();

        $html = View::renderTemplate("bookTable", ['list' => $list]);
        $response->setContent($html);
    }
}