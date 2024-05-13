<?php

class Home extends Controller 
{
    public function index()
    {
        if(!isset($_SESSION['email'])){
            header('location: auth/');
        }
        
        $this->view('home/index');
    }
}