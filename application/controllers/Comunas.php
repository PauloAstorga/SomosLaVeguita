<?php

class Comunas extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->helper('form');
    }

    function index(){
        echo "Este es el index";
    }

    public function listar(){
        $this->load->view('comunas/listar');
    }

    public function guardar(){
        $this->load->view('comunas/guardar');
    }

    public function borrar(){
        $this->load->view('comunas/borrar');
    }

    
}