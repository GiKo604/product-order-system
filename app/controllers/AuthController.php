<?php

class AuthController
{
    public function loginForm()
    {
        echo 'Login form';
    }

    public function login()
    {
        echo 'Do login (TODO: ověřit usera, nastavit session)';
    }

    public function logout()
    {
        echo 'Logout (TODO: zrušit session)';
    }
}
