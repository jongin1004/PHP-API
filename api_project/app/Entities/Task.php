<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Task extends Entity
{
    protected $casts   = [
        'is_completed' => 'boolean'
    ];

    // public function getIsCompleted()
    // {
    //     $this->attributes['is_completed'] = (bool) $this->attributes['is_completed'];

    //     return $this->attributes['is_completed'];
    // }

    // public function setIsCompleted(string $value)
    // {
    //     $this->attributes['is_completed'] = (bool) $value;

    //     return $this;
    // }
}
