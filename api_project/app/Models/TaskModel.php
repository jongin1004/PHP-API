<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table            = 'task';
    protected $allowedFields    = [
        'name',
        'priority',
        'is_completed'
    ];

    protected $returnType = \App\Entities\Task::class;

    protected $validationRules = [
        'name'     => 'required',
        'priority' => 'integer',
    ];


    protected $validationMessages = [
        'name' => [
            'required' => 'You must input a name'
        ],
        'priority' => [
            'integer' => 'You must input a integer data in priority'
        ]
    ];

    // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    public function getAll(): array
    {
        // $result = $this->db->query("SELECT * FROM task")->getResult();

        $query = $this->db->query("SELECT * FROM task");

        $result = $this->changeIntToBool($query);

        return $result;
    }

    public function get(string $id): array
    {

        // $query = $this->db->query("SELECT * FROM task WHERE id = $id");

         
        // $result = $query->get();

        // $result = $this->changeIntToBool($query);

        // var_dump($result->fill(["name" => "sibal"]));

        exit;

        return $result;
    }

    public function create(array $data): string
    {
        $this->db->table("task")->insert($data);

        return $this->db->insertID();
    }

    // public function update(array $data): string
    // {
        
    // }

    private function changeIntToBool(object $query): array
    {
        $result = [];
        
        while ($row = $query->getUnbufferedRow('array')) {

            $row["is_completed"] = (bool) $row["is_completed"];

            $result[] = $row;
        }

        return $result;
    }

    public function checkExistsTaskById(string $id): array
    {
        $query = $this->db->query("SELECT * FROM task WHERE id = $id");

        return $query->getResult();
    }
}
