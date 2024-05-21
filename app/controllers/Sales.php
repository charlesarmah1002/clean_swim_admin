<?php

class Sales extends Controller
{
    public function index()
    {
        $this->status_check();
        $this->view('sales/index');
    }

    public function create()
    {
        $this->status_check();
        
        $this->view('sales/create');
    }
}