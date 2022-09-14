<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation extends BaseConfig
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------

    public $task = [
        'name' => 'required',
        'priority' => 'integer',
        // 'is_completed' => 'in_list[0, 1,]'
    ];

    public $task_errors = [

        'name' => [
            'required' => 'You must input a name'
        ],
        'priority' => [
            'integer' => 'You must input a integer data in priority'
        ],
        // 'is_completed' => [            
        //     'in_list' => 'You must input a boolean data in is_completed [ 0 or 1 ]'
        // ]
    ];
}
