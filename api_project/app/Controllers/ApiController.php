<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\ErrorHandler;

class ApiController extends BaseController
{
    public function index()
    {
        set_exception_handler("App\Controllers\ErrorHandler::handlerExecption");

        $uri_string = explode("/", uri_string());
        $resource   = $uri_string[1];
        $id         = $uri_string[2] ?? null;
                
        if ($resource !== "tasks") {

            http_response_code(404);
            exit;

        }

        $method = strtoupper($this->request->getMethod());        

        $this->distinguishMethod($method, $id);
                
    }

    // ?string에서 ?를 붙히는 이유 : uri에서 id값이 없는 경우에는 null을 넣어주기 때문에,
    // string 타입이 아니라서 에러가 발생하게 된다. ?를 붙힘으로써 nullable을 하겠다라는 의미
    protected function distinguishMethod(string $method, ?string $id)
    {        
        if ( ! $id) {

            if ($method === "GET") {

                echo "hi";
                

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
        
        exit;
    }
}
