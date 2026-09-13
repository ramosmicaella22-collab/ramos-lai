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

        // Protektahan ang lahat ng product pages mula sa unauthenticated users[cite: 1]
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            redirect('login');
            exit();
        }
    }

    // READ - Display all products
    public function index()
    {
        $data['products'] = $this->ProductModel->getAll();
        $this->call->view('products/index', $data);
    }

    // CREATE - Show form
    public function create()
    {
        $this->call->view('products/create');
    }

    // CREATE - Save new product
    public function store()
    {
        $data = [
            'product_name' => $this->io->post('product_name'),
            'description'  => $this->io->post('description'),
            'price'        => $this->io->post('price'),
            'quantity'     => $this->io->post('quantity'),
        ];

        $this->ProductModel->insert($data);
        redirect('products');
    }

    // UPDATE - Show edit form
    public function edit($id)
    {
        $data['product'] = $this->ProductModel->getById($id);
        $this->call->view('products/edit', $data);
    }

    // UPDATE - Save changes
    public function update($id)
    {
        $data = [
            'product_name' => $this->io->post('product_name'),
            'description'  => $this->io->post('description'),
            'price'        => $this->io->post('price'),
            'quantity'     => $this->io->post('quantity'),
        ];

        $this->ProductModel->update($id, $data);
        redirect('products');
    }

    // DELETE
    public function delete($id)
    {
        $this->ProductModel->delete($id);
        redirect('products');
    }
}