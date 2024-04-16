<?php
 
return [
    '/contact/list' => [
        'GET' => '\App\Controllers\ContactController@list',
    ],
    '/contact/detail' => [
        'GET' => '\App\Controllers\ContactController@detail'
    ],
    '/contact' => [
        'POST' => '\App\Controllers\ContactController@create',   
        'POST' => '\App\Controllers\ContactController@addPhoneContact',
        'DELETE' => '\App\Controllers\ContactController@delete'
    ] 
];
