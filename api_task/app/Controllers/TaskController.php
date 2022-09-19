<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class TaskController extends ResourceController
{
    protected $model;

    public function __construct()
    {
        $this->model = model("TaskModel");
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return void
     */
    public function index(): void
    {
        $tasks = $this->model->findAll();

        if ( ! $tasks) $this->responseNotFound();

        echo json_encode($tasks);

        exit;
    }

    /**
     * Return the properties of a resource object
     *
     * @return void
     */
    public function show($id = NULL): void
    {
        $task = $this->model->find($id);

        if ($task) $this->responseNotFoundWithId($id);

        echo json_encode($task);

        exit;
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $data = (array) json_decode(file_get_contents("php://input"));

        $task = new \App\Entities\Task();

        $task->fill($data);

        $insert_id = $this->model->insert($task);

        if ( ! $insert_id) {}

        echo 

        exit;
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }

    /**
     * response a message and 404 status code
     * when does not found the task
     *
     * @return void
     */
    protected function responseNotFound(): void
    {
        http_response_code(404);
        echo json_encode(["message" => "Task not found"]);
        exit;
    }

    /**
     * response a message and 404 status code
     * when does not found the task
     * 
     * @return void
     */
    protected function responseNotFoundWithId(string $id): void
    {
        http_response_code(404);
        echo json_encode(["message" => "Task not found With ID : $id"]);
        exit;
    }
}
