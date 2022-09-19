<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Task extends Entity
{
    protected $casts   = [
        'is_completed' => 'boolean'
    ];
}
