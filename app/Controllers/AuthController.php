<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\UserPermission;

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
        // Prazo de 1 hora para validar o token
        $now->modify('+1 hour');
        $key = bin2hex(random_bytes(20));

        $user = User::create([
            'name' => $request->getParam('name'),
            'email' => $request->getParam('email'),
            'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
            'confirmation_key' => $key/*$request->getParam('confirmation_key')*/,
            'confirmation_expires' => $now/*$request->getParam('confirmation_expires')*/,
        ]);

        $user->permissions()->create(UserPermission::$defaults);

        return $response->withRedirect($this->container->router->pathFor('auth.login'));
    }
}