<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthMiddleware
{
    public function handle(Closure $next)
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            $_SESSION['auth_denied_msg'] = 'Kailangan mo munang mag-login.';
            redirect('login');
        }

        return $next();
    }
}