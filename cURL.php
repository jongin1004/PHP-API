<?php

// curl란, 커맨드라인이나 소스코드로 손 쉽게 웹 브라우저처럼 활동할 수 있도록 해주는 기술 
// 서버와 통신할 수 있는 커맨드 명령어 툴, 다양한 프로토콜을 지원한다. (url을 가지고 할 수 있는 것들이 모두 가능하다.)

//cURL세션 초기화 
$ch = curl_init(); 

$header = [

    "test-header: hi"
];

$header_arr = [];

$callback_header = function($ch, $header) use(&$header_arr) {

    $len = strlen($header);

    list($header_key, $header_val) = explode(':', $header, 2);

    $header_arr[$header_key] = trim($header_val);
    
    return $len;
};

// cURL옵션 설정
// curl_setopt($ch, CURLOPT_URL, "https://jsonplaceholder.typicode.com/posts/1");

// CURLOPT_RETURNTRANSFER는 세션 실행이 성공했을 경우(curl_exec 실행 성공) true값 대신, 실행결과를 반환
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);

// 옵션을 배열의 형태로 전달 가능 
curl_setopt_array($ch, [
    
    CURLOPT_URL => "https://jsonplaceholder.typicode.com/posts/1",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => $header, // request시에 추가 header 정보를 입력 
    // CURLOPT_HEADER => true         //response의 헤더정보를 출력 
    CURLOPT_HEADERFUNCTION => $callback_header

]);

// cURL세션 실행 (성공시 true, 실패시 false, 단, CURLOPT_RETURNTRANSFER가 설정되있는 경우 성공시 결과값)
$response = curl_exec($ch);

// $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// $content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

// $content_length = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH);

// echo $status_code . "\n";
// echo $content_type . "\n";
// echo $content_length . "\n";
print_r($header_arr);
echo $response . "\n";



