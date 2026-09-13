<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthMiddleware
{
    public function handle(Closure $next)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Makuha ang kasalukuyang URI path
        $current_uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        // Kung nasa login page o auth routes, huwag i-check ang login session
        if ($current_uri === 'login' || $current_uri === 'auth/login' || $current_uri === 'auth/authenticate') {
            return $next();
        }

        // Kung wala sa login page at hindi pa naka-login, i-redirect sa login
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            $_SESSION['auth_denied_msg'] = 'Kailangan mo munang mag-login.';
            redirect('login');
            exit();
        }

        return $next();
    }
}