<?php

return [
    '/contact/list' => [
        'GET' => 'ContactController@list',
    ],
    '/contact/detail' => [
        'GET' => 'ContactController@detail'
    ],
    '/contact' => [
        'POST' => 'ContactController@create',   
        'PUT' => 'ContactController@update',
        'DELETE' => 'ContactController@delete'
    ] 
];
