<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->model('AccountModel');
    }

    public function login()
    {
        $this->call->view('auth/login');
    }

    public function authenticate()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $account = $this->AccountModel->getByUsername($username);

        if ($account && password_verify($password, $account['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $account['username'];
            redirect('/products');
        } else {
            $_SESSION['error'] = 'Invalid username or password';
            redirect('/login');
        }
    }

    public function logout()
    {
        session_destroy();
        redirect('/login');
    }
}