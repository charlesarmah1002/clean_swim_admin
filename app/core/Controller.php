<?php

class Controller
{
    public function model($model)
    {
        require_once '../app/models/'. $model. '.php';
        return new $model();
    }

    public function view($view, $data = [])
    {
        require_once '../app/views/'. $view. '.php';
    }

    public function status_check()
    {
        if (!isset($_SESSION['email'])) {
            header('location: ../public/auth/');
            die();
        }
    }
}