<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        
        // Siguruhing aktibo ang session para gumana ang login state
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->call->database();
        $this->call->helper('url');
        $this->call->library('session');
        $this->call->model('AccountModel');
    }

    public function login()
    {
        // Kung naka-login na, huwag nang pag-access-in ang login page, diretso agad sa products
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            redirect('products');
            exit();
        }

        $this->call->view('auth/login');
    }

    public function authenticate()
    {
        $username = $this->io->post('username');
        $password = $this->io->post('password');

        $account = $this->AccountModel->getByUsername($username);

        if ($account && password_verify($password, $account['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $account['username'];
            
            // Alisin ang unahang slash para tama ang routing ng LavaLust redirect
            redirect('products');
            exit();
        } else {
            $_SESSION['error'] = 'Invalid username or password';
            redirect('login');
            exit();
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        redirect('login');
        exit();
    }
}