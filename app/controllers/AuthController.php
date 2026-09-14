<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->call->database();
        $this->call->helper('url');
        $this->call->library('session');
        $this->call->model('AccountModel');
    }

    public function login()
    {
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
            
            redirect('products');
            exit();
        } else {
            $_SESSION['error'] = 'Invalid username or password';
            redirect('login'); // <-- Itinugma natin ito sa route mo na 'login' para hindi mag-404
            exit();
        }
    }
}