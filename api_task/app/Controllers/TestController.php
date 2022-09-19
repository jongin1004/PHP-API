<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class TestController extends BaseController
{
    public function index()
    {
        
    }

    public function getFaqs(): void
    {          
        
        $url = "{$_ENV['api_url']}/Api_Faq/getFaqCategory";

        list($faqs, $status_code) = $this->ajaxUsingCurl($url);
        
        if ($status_code !== 200 || ! $faqs) {
                        
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("message");        
        }; 

        dd($faqs);

        exit;
    }

    public function getNews(): void
    {        
        $url = "{$_ENV['api_url']}/Api_News/getNews";

        list($news, $status_code) = $this->ajaxUsingCurl($url);

        if ($status_code !== 200 || ! $news) {
                        
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("message");        
        };

        dd($news);      
    }

    public function getNewsById(string $id = null): void
    {        
        $url = "{$_ENV['api_url']}/Api_News/getNewById/442";        
        
        list($news, $status_code) = $this->ajaxUsingCurl($url);       

        if ($status_code !== 200 || ! $news) {
                        
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("message");        
        };

        dd($news);
    }

    protected function ajaxUsingCurl(string $url): array
    {
        $ch = curl_init();

        curl_setopt_array($ch, [

            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true
        ]);        
        
        $response = [
            json_decode(curl_exec($ch), true),
            curl_getinfo($ch, CURLINFO_HTTP_CODE)
        ];

        return $response;
    }
}
