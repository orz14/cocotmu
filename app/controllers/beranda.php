<?php
class beranda extends controller {
    public function index()
    {
        $data['judul'] = 'Beranda | ';
        $this->view('logic/cekLogin');
        $this->view('templates/metaTag', $data);
        $this->view('styles/style');
        $this->view('templates/header');
        $this->view('beranda/beranda');
        $this->view('modal/modalLogout');
        $this->view('templates/footer');
        $this->view('scripts/scriptDefault');
        $this->view('templates/penutup');
    }
}