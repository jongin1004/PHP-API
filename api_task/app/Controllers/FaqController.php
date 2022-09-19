<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class FaqController extends ResourceController
{
    protected $model;

    public function __construct()
    {
        $this->model = model("FaqModel");
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {        
        echo "hi";
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        
    }

    public function getCategories()
    {                
        $builder = $this->db->table('nrp_faq_cat_sub');

        $builder->select('sub.id, sub.name')
                ->join('nrp_faq_cat cat', 'sub.cat_id = cat.id')
                ->where('cat.service', 'netfax')
                ->orderBy('sub.order_no');

        $result = $builder->getResult();

        if ( ! $result) $this->responseNotFound();

        return $this->response->setJson($result);

        exit;
    }

    protected function responseNotFound()
    {
        http_response_code(404);
        echo json_encode(["message" => "dose not found Categories"]);

        exit;
    }
}
