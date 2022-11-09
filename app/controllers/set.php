<?php
class set extends controller {
    public function index()
    {
        $this->view('logic/akses');
        $this->view('logic/set');
    }
}