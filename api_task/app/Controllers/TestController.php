<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class TestController extends BaseController
{
    public function index()
    {
        
    }

    public function get()
    {                
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => "{$_ENV['api_url']}getFaqCategory",
            CURLOPT_RETURNTRANSFER => true,            
        ]);

        $categories = curl_exec($ch);
        
        dd(json_decode($categories));

        exit;
    }
}
