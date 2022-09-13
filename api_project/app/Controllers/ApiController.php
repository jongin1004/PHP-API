<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\ErrorHandler;

class ApiController extends BaseController
{
    private $db;
    private $taskModel;

    public function __construct()
    {
        $this->db = db_connect();
        $this->taskModel = model("TaskModel");
    }
    
    public function index()
    {        
        set_exception_handler("App\Controllers\ErrorHandler::handlerExecption");
        // set_error_handler("App\Controllers\ErrorHandler::handlerError");

        $uri_string = explode("/", uri_string());
        $resource   = $uri_string[1];
        $id         = $uri_string[2] ?? null;
                
        if ($resource !== "tasks") {

            // header를 이용해서 직접 설정하게 되면, 더 상세한 이유를 적을 수 있지만
            // http2같은 경우는 지원되지 않고 실제로 클라이언트에게 도움되는 정보는 아니므로
            // 또한 상세한 내용은 body에 추가하면 되기 때문에 http_response_code사용            
            http_response_code(404);
            exit;

        }

        header("Content-type: application/json; charset=UTF-8");

        $method = strtoupper($this->request->getMethod());        

        $this->distinguishMethod($method, $id);        
    }

    // ?string에서 ?를 붙히는 이유 : uri에서 id값이 없는 경우에는 null을 넣어주기 때문에,
    // string 타입이 아니라서 에러가 발생하게 된다. ?를 붙힘으로써 nullable을 하겠다라는 의미
    protected function distinguishMethod(string $method, ?string $id)
    {        
        if ( ! $id) {

            if ($method === "GET") {

                echo json_encode($this->taskModel->getAll());
                

            } else if ($method === "POST") {

                $data = (array) json_decode(file_get_contents("php://input"), true);
                
                $id = $this->taskModel->create($data);

                $this->responseCreated($id);
                
                exit;

            } else {

                $this->responseMethodNotAllowed("GET, POST");
                exit;
            }

            
        } else {

            $task = $this->taskModel->get($id);

            if ( ! $task) {

                $this->responseNotFound($id);
                exit;
            }


            switch ($method) {

                case "GET":
                    echo json_encode($this->taskModel->get($id));
                    exit;

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

    private function responseMethodNotAllowed(string $method): void
    {
        http_response_code(405);

        header("Allow: $method");
    }

    private function responseNotFound(string $id): void
    {
        http_response_code(404);
        echo json_encode(["message" => "Does Not Found Task with ID: $id"]);
    }

    private function responseCreated(string $id): void
    {
        http_response_code(201);
        echo json_encode(["message" => "Successfully Created Task with ID: $id"]);
    }
}
