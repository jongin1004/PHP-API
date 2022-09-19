<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class NewsController extends ResourceController
{

    protected $builder;

    public function __construct()
    {
        $this->builder = $this->db->table("news");
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $sql = "SELECT id, regist_date, title, content
            FROM news 
            WHERE show_flg IS TRUE 
            AND public_netfax IS TRUE";

        
        $this->builder->select('id, regist_date, title, content')
                      ->from('news')
                      ->where('show_flg IS TURE')
                      ->where('public_netfax IS TURE');

        $news = $this->builder->getResult();

        if ( ! $news) {

            http_response_code(404);
            echo json_encode(["message" => "News not found"]);

            exit;
        }

        echo json_encode($news);

        exit;        
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $sql = "SELECT * FROM news WHERE id = {$id} AND show_flg IS TRUE AND public_netfax IS TRUE";
        $new = $this->db->query($sql)->row();

        $this->builder->where("id", $id)
                      ->where("show_flg IS TURE")
                      ->where("public_netfax IS TRUE");

        $news = $this->builder->getRow();

        if ( ! $news) {

            http_response_code(404);
            echo json_encode(["message" => "News not found"]);

            exit;
        }

        echo json_encode($news);
        
        exit;
    }
}
