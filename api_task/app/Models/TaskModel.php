<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table            = 'task';
    protected $returnType       = \App\Entities\Task::class;
    protected $allowedFields    = [
        'name',
        'priority',
        'is_completed'
    ];

    // Validation
    protected $validationRules      = [
        'name' => 'required',
        'priority' => 'permit_empty|integer'
    ];

    protected $validationMessages   = [
        'name' => [
            'required' => 'name field is required'            
        ],
        'priority' => [
            'integer' => 'priority field is integer type'
        ]
    ];

}
