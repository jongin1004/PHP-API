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

        $query = $this->db->query("SELECT * FROM task WHERE id = $id");

        $result = $this->changeIntToBool($query);

        return $result;
    }

    private function changeIntToBool(object $query): array
    {
        $result = [];
        
        while ($row = $query->getUnbufferedRow('array')) {

            $row["is_completed"] = (bool) $row["is_completed"];

            $result[] = $row;
        }

        return $result;
    }
}
