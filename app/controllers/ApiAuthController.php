<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiAuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->library('api');
        $this->call->model('UserModel');
    }

    private function input()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        return is_array($data) ? $data : [];
    }

    public function register()
    {
        $this->api->require_method('POST');
        $in = $this->input();

        $username = trim($in['username'] ?? '');
        $email    = trim($in['email'] ?? '');
        $password = (string) ($in['password'] ?? '');

        if ($username === '' || $email === '' || strlen($password) < 6) {
            $this->api->respond_error('username, email, at password (min 6 chars) ay required', 422);
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->api->respond_error('Invalid email', 422);
        }
        if ($this->UserModel->getByUsername($username) || $this->UserModel->getByEmail($email)) {
            $this->api->respond_error('Username o email ay ginagamit na', 409);
        }

        $this->UserModel->create([
            'username'   => $username,
            'email'      => $email,
            'password'   => password_hash($password, PASSWORD_DEFAULT),
            'role'       => 'user',
            'is_active'  => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $this->api->respond(['message' => 'User registered successfully'], 201);
    }

    public function login()
    {
        $this->api->require_method('POST');
        $in = $this->input();

        $login    = trim($in['username'] ?? ($in['email'] ?? ''));
        $password = (string) ($in['password'] ?? '');

        if ($login === '' || $password === '') {
            $this->api->respond_error('Username/email at password ay required', 422);
        }

        $user = $this->UserModel->getByUsername($login) ?: $this->UserModel->getByEmail($login);

        if (!$user || !password_verify($password, (string) $user['password'])) {
            $this->api->respond_error('Invalid credentials', 401);
        }
        if ((int) $user['is_active'] !== 1) {
            $this->api->respond_error('Account is disabled', 403);
        }

        $tokens = $this->api->issue_tokens([
            'id'     => $user['id'],
            'role'   => $user['role'],
            'scopes' => ['read', 'write'],
        ]);

        $this->api->respond([
            'message' => 'Login successful',
            'user'    => [
                'id'       => $user['id'],
                'username' => $user['username'],
                'email'    => $user['email'],
                'role'     => $user['role'],
            ],
            'tokens'  => $tokens,
        ]);
    }

    public function refresh()
    {
        $this->api->require_method('POST');
        $in = $this->input();

        $refresh = $in['refresh_token'] ?? '';
        if ($refresh === '') {
            $this->api->respond_error('refresh_token is required', 422);
        }

        $this->api->refresh_access_token($refresh);
    }

    public function logout()
    {
        $this->api->require_method('POST');
        $this->api->require_jwt();
        $in = $this->input();

        if (!empty($in['refresh_token'])) {
            $this->api->revoke_refresh_token($in['refresh_token']);
        }

        $this->api->respond(['message' => 'Logged out successfully']);
    }
}