<?php

// Request
// $app->get('/', function($request, $response){
//     return 'Hello, World!';
// });

$app->get('/', 'HomeController:index')->setName('home');

$app->get('/login', 'AuthController:login')->setName('auth.login');
$app->get('/registrar', 'AuthController:register')->setName('auth.register');