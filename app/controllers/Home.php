<?php

class Home extends Controller 
{
    public function status_check()
    {
        if(!isset($_SESSION['email'])){
            header('location: auth/');
        }
    }
    public function index()
    {
        $this->status_check();
        $this->view('home/index');
    }
}