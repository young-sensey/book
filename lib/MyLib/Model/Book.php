<?php

namespace lib\MyLib\Model;

use lib\MyLib\Request;

//класс модели, содержит набор геттеров и сеттеров для получения, установки данных +  бизнес-логику , не содержит код по работе с БД
class Book
{
    private $conn;
    private $page = 1;
    private $count = 10;

    public function __construct()
    {
        $request = Request::getInstance();
        $this->conn = $request->getParam('conn');
    }

    public function getList(array $filters = [])
    {
        if (isset($filters['page'])) {
            $this->page = $filters['page'];
        }

        if (isset($filters['count'])) {
            $this->count = $filters['count'];
        }

        $sql = "SELECT * FROM book";

        $start_row = ($this->page - 1) * $this->count;
        $sql .= " LIMIT " . $start_row . ", " . $this->count;

        $result = $this->conn->query($sql);

        $list = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $list[] = $row;
            }
        }
        return $list;
    }

    public function getPagesInfo()
    {
        $sql = "SELECT COUNT(*) as 'count' FROM book";
        $result = $this->conn->query($sql);
        $count_records = $result->fetch_assoc()['count'];

        $pages_info = [
            'count_records' => (int)$count_records,
            'page_active' => $_SESSION["page_active"],
            'count_pages' => (int)ceil($count_records / $this->count)
        ];

        return $pages_info;
    }

    public function load($id)
    {
        $sql = "SELECT * FROM book WHERE id_book = $id";
        $result = $this->conn->query($sql);
        $model = $result->fetch_assoc();
        return $model;
    }

    public function save($data)
    {
        $sql = "INSERT INTO book (text, author)
                VALUES ('" . $data['text'] . "','" . $data['author'] . "')";
        $result = $this->conn->query($sql);

        if (!$result) {
            var_dump($this->conn->error_list);
        }
    }
}