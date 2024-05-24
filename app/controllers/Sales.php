<?php

class Sales extends Controller
{
    public function index()
    {
        $this->status_check();

        $productModel = $this->model('Product');
        $products = $productModel->select(
            'id',
            'p_name',
            'p_price',
            'p_image',
            'stock'
        )
        ->get();

        $this->view('sales/index', $products);
    }

    public function create()
    {
        $this->status_check();
        
        $this->view('sales/create');
    }
}