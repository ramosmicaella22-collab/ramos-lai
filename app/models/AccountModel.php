<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AccountModel extends Model
{
    protected $table = 'accounts';

    public function __construct()
    {
        parent::__construct();
        $this->call->database(); // Niloload nito ang database para magamit ang $this->db
    }

    public function getByUsername($username)
    {
        return $this->db->table($this->table)->where('username', $username)->get();
    }
}