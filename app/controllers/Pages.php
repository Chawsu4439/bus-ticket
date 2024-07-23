<?php

class Pages extends Controller
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function index()
    {
        // echo('ok');
        // exit;
        $this->view('pages/login');
    }

    public function login()
    {
        $this->view('pages/login');
    }

    public function register()
    {
        $this->view('pages/register');
    }

    public function about()
    {
        $this->view('pages/about');
    }

    public function home()
    {
        $this->view('pages/home');
    }

    public function bookSuccess()
    {
        $this->view('pages/bookSuccess');
    }

    
    public function history()
    {
        $this->view('pages/history');
    }

}

