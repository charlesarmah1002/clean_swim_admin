<?php

class Sales extends Controller
{
    public function index()
    {
        $this->status_check();

        $this->view('sales/index');
    }

    public function getProducts()
    {
        
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
