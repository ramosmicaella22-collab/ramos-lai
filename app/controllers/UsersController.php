<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

/**
 * Controller: UsersController
 * 
 * Automatically generated via CLI.
 */
class UsersController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('UsersModel');
    }

    public function testdb()
    {

        if ($this->db) {
            echo 'database connected';
        } else {
            echo 'database not connected';
        }
    }

    public function getUsers()
    {
        $data['users'] = $this->UsersModel->all();

        $this->call->view('show', $data);
    }
}
