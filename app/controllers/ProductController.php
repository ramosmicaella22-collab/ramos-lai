<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        
        // I-load ang database, session library, at url helper
        $this->call->database();
        $this->call->library('session');
        $this->call->helper('url');
        $this->call->model('ProductModel');
    }

    // Helper method para protektahan ang bawat CRUD endpoint mula sa mga unauthenticated users[cite: 1]
    private function check_auth()
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            redirect('login');
            exit();
        }
    }

    // READ - Display all products[cite: 1]
    public function index()
    {
        $this->check_auth();
        $data['products'] = $this->ProductModel->getAll();
        $this->call->view('products/index', $data);
    }

    // CREATE - Show form[cite: 1]
    public function create()
    {
        $this->check_auth();
        $this->call->view('products/create');
    }

    // CREATE - Save new product[cite: 1]
    public function store()
    {
        $this->check_auth();
        $data = [
            'product_name' => $this->io->post('product_name'),
            'description'  => $this->io->post('description'),
            'price'        => $this->io->post('price'),
            'quantity'     => $this->io->post('quantity'),
        ];

        $this->ProductModel->insert($data);
        redirect('products');
    }

    // UPDATE - Show edit form[cite: 1]
    public function edit($id)
    {
        $this->check_auth();
        $data['product'] = $this->ProductModel->getById($id);
        $this->call->view('products/edit', $data);
    }

    // UPDATE - Save changes[cite: 1]
    public function update($id)
    {
        $this->check_auth();
        $data = [
            'product_name' => $this->io->post('product_name'),
            'description'  => $this->io->post('description'),
            'price'        => $this->io->post('price'),
            'quantity'     => $this->io->post('quantity'),
        ];

        $this->ProductModel->update($id, $data);
        redirect('products');
    }

    // DELETE - Remove a product[cite: 1]
    public function delete($id)
    {
        $this->check_auth();
        $this->ProductModel->delete($id);
        redirect('products');
    }
}