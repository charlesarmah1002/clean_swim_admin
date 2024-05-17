<?php


class Users extends Controller
{
    public function index()
    {
        $this->status_check();
        $userModel = $this->model('User');

        $usersInfo = $userModel->all();

        $this->view('user/index', $usersInfo);
    }

    public function create()
    {
        $this->view('user/create');
    }
}