<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ApiController extends BaseController
{
    public function index()
    {
        $uri_string = explode("/", uri_string());
        $resource   = $uri_string[1];
        $id         = $uri_string[2] ?? null;
        
        if ($resource !== "tasks") {

            http_response_code(404);
            exit;

        }

        $method = strtoupper($this->request->getMethod());

        var_dump($method);

        $this->distinguishMethod($method, $id);
                
    }

    protected function distinguishMethod($method, $id)
    {        
        if ( ! $id) {

            if ($method === "GET") {

                echo "SHOW TASKS";

            } else if ($method === "POST") {

                echo "POST TASKS";
            }

        } else {

            switch ($method) {

                case "GET":
                    echo "SHOW {$id}";
                    break;

                case "PATCH":
                    echo "MODIFY {$id}";
                    break;
                
                case "DELETE":
                    echo "DELETE {$id}";
                    break;
            }
        }        
    }
}
