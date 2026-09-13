<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthMiddleware
{
    public function handle(Closure $next)
    {
        // Siguruhing active ang session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Suriin kung ang user ay naka-login na
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            // Kung hindi pa naka-login, i-redirect sa login page
            redirect('login');
            exit();
        }

        return $next();
    }
}