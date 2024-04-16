<?php
 
return [
    '/contact/list' => [
        'GET' => '\App\Controllers\ContactController@list',
    ],
    '/contact/detail' => [
        'GET' => '\App\Controllers\ContactController@detail'
    ],
    '/contact/add-phone' => [
        'POST' => '\App\Controllers\ContactController@addPhoneContact'
    ],
    '/contact' => [
        'POST' => '\App\Controllers\ContactController@create',   
        'DELETE' => '\App\Controllers\ContactController@delete'
    ] 
];
