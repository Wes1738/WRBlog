<?php

namespace App\Controllers;

use App\Models\User;

class AuthController extends Controller {

    public function login ($request, $response) 
    {
        if ($request->isGet()){
            return $this->container->view->render($response, 'login.twig');
        }
    }

    public function register ($request, $response) 
    {
        if ($request->isGet()){
            return $this->container->view->render($response, 'register.twig');
        }

        $now = new \DateTime(date('d/m/Y H:i:s'));

        User::create([
            'name' => $request->getParam('name'),
            'email' => $request->getParam('email'),
            'password' => $request->getParam('password'),
            'confirmation_key' => 'jklkajdshadilas'/*$request->getParam('confirmation_key')*/,
            'confirmation_expires' => $now/*$request->getParam('confirmation_expires')*/,
        ]);

        return $response->withRedirect($this->container->router->pathFor('auth.login'));
    }
}