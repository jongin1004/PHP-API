<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class TestController extends BaseController
{
    public function index()
    {
        
    }

    public function getFaqs()
    {                
        $ch = curl_init();

        curl_setopt_array($ch, [

            CURLOPT_URL            => "{$_ENV['api_url']}Api_Faq/getFaqCategory",
            CURLOPT_RETURNTRANSFER => true,            
        ]);

        $result  = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if ( $status_code !== 200 || ! $result) return;        

        json_decode($result, true);

        exit;
    }

    public function getNews()
    {        
        $ch = curl_init();

        curl_setopt_array($ch, [

            CURLOPT_URL            => "{$_ENV['api_url']}/Api_News/getNews",
            CURLOPT_RETURNTRANSFER => true, 
        ]);

        $result = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
        if ( $status_code !== 200 || ! $result) return;        

        $news = json_decode($result, true);        

    }

    public function getNewsById($id = null)
    {        
        $ch = curl_init();

        curl_setopt_array($ch, [

            CURLOPT_URL            => "{$_ENV['api_url']}/Api_News/getNewById/442",
            CURLOPT_RETURNTRANSFER => true
        ]);

        $result = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if ($status_code !== 200 || ! $result) return;

        $news = json_decode($result, true);

        dd($news);
    }
}
