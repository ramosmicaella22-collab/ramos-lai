<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

/**
 * Model: UsersModel
 * 
 * Automatically generated via CLI.
 */
class UsersModel extends Model
{
    protected $table = 'users';
    protected $primary_key = 'id';
    protected $fillable = [];
    protected $guarded = ['id'];

    public function __construct()
    {
        parent::__construct();
    }
}
