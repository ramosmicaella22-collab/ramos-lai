<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserModel extends Model
{
    protected $table = 'users';

    public function __construct()
    {
        parent::__construct();
        $this->call->database();
    }

    public function getByUsername($username)
    {
        return $this->db->table($this->table)->where('username', $username)->get();
    }

    public function getByEmail($email)
    {
        return $this->db->table($this->table)->where('email', $email)->get();
    }

    public function create($data)
    {
        return $this->db->table($this->table)->insert($data);
    }
}