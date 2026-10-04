<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->library('api');
        $this->call->model('ProductModel');
    }

    private function input()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        return is_array($data) ? $data : [];
    }

    private function validated($in)
    {
        $name  = trim($in['product_name'] ?? '');
        $desc  = isset($in['description']) ? trim($in['description']) : null;
        $price = $in['price'] ?? null;
        $qty   = $in['quantity'] ?? null;

        if ($name === '' || strlen($name) > 100) {
            $this->api->respond_error('product_name is required (max 100 chars)', 422);
        }
        if (!is_numeric($price) || $price < 0) {
            $this->api->respond_error('price must be a non-negative number', 422);
        }
        if (filter_var($qty, FILTER_VALIDATE_INT) === false || $qty < 0) {
            $this->api->respond_error('quantity must be a non-negative integer', 422);
        }

        return [
            'product_name' => $name,
            'description'  => $desc,
            'price'        => $price,
            'quantity'     => (int) $qty,
        ];
    }

    // GET /api/products
    public function index()
    {
        $this->api->require_method('GET');
        $this->api->require_jwt();
        $this->api->respond(['data' => $this->ProductModel->getAll()]);
    }

    // GET /api/products/{id}
    public function show($id)
    {
        $this->api->require_method('GET');
        $this->api->require_jwt();

        $product = $this->ProductModel->getById($id);
        if (!$product) {
            $this->api->respond_error('Product not found', 404);
        }
        $this->api->respond(['data' => $product]);
    }

    // POST /api/products
    public function store()
    {
        $this->api->require_method('POST');
        $this->api->require_jwt();

        $data = $this->validated($this->input());
        $this->ProductModel->insert($data);

        $this->api->respond(['message' => 'Product created', 'data' => $data], 201);
    }

    // PUT/PATCH /api/products/{id}
    public function update($id)
    {
        if (!in_array($_SERVER['REQUEST_METHOD'], ['PUT', 'PATCH'], true)) {
            $this->api->respond_error('Method Not Allowed', 405);
        }
        $this->api->require_jwt();

        if (!$this->ProductModel->getById($id)) {
            $this->api->respond_error('Product not found', 404);
        }

        $data = $this->validated($this->input());
        $this->ProductModel->update($id, $data);

        $this->api->respond(['message' => 'Product updated', 'data' => $data]);
    }

    // DELETE /api/products/{id}
    public function destroy($id)
    {
        $this->api->require_method('DELETE');
        $this->api->require_jwt();

        if (!$this->ProductModel->getById($id)) {
            $this->api->respond_error('Product not found', 404);
        }

        $this->ProductModel->delete($id);
        $this->api->respond(['message' => 'Product deleted']);
    }
}