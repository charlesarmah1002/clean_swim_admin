<?php

class Sales extends Controller
{
    public function index()
    {
        $this->status_check();

        $productModel = $this->model('Product');
        $categoryModel = $this->model('Category');

        $products = $productModel->select(
            'id',
            'p_name',
            'p_price',
            'p_image',
            'stock'
        )
        ->get();

        $categories = $categoryModel->select(
            'id',
            'p_category'
        )->get();

        $data = [
            'products' => $products,
            'categories' => $categories
        ];

        $this->view('sales/index', $data);
    }

    public function create()
    {
        $this->status_check();
        
        $this->view('sales/create');
    }

    public function cart()
    {
        $this->status_check();
        
        $cart = [
            'cart_id' => rand(000000, 999999),
            'cart_items' => []
        ];

        echo json_encode($cart);
    }
}