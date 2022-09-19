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
        $sql = 
        "SELECT 
            qa.id, qa.que, qa.ans, qa.cat_sub_id, qa.order_no qa_order,
            main.name main_name, main.order_no main_order,
            sub.name sub_name, sub.order_no sub_order
        FROM 
            nrp_faq qa
        LEFT OUTER JOIN
            nrp_faq_cat_sub sub ON sub.id = qa.cat_sub_id
        LEFT OUTER JOIN
            nrp_faq_cat main ON main.id = sub.cat_id
        WHERE
            sub.id = $cat_id
        AND
            qa.status = 't'
        ORDER BY
            main.order_no,
            sub.order_no,
            qa.order_no";

        $result = $this->db->query($sql)->result_array();

        $this->_echo_json($result);

        return $this->response->setJson($result);
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
    }

    protected function responseNotFound()
    {
        http_response_code(404);
        echo json_encode(["message" => "dose not found Categories"]);

        exit;
    }
}
