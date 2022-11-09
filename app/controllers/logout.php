<?php
class logout extends controller {
    public function index()
    {
        $data['judul'] = 'Logout | ';
        $this->view('logic/akses');
        $this->view('logic/clearCookie');
        $this->view('templates/metaTag', $data);
        $this->view('styles/style');
        $this->view('templates/header');
        $this->view('logout/logout');
        $this->view('scripts/scriptDefault');
        $this->view('templates/penutup');
    }
}