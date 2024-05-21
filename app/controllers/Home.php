<?php

class Home extends Controller 
{
    public function index()
    {
        $this->status_check();
        $this->view('home/index');
    }
}