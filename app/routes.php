<?php

// Request
// $app->get('/', function($request, $response){
//     return 'Hello, World!';
// });

$app->get('/', 'HomeController:index');
