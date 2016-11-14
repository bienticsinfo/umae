<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Principal
 *
 * @author felipe de jesus
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Principal extends Config{
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $this->load->view('principal/index');
    }
}
