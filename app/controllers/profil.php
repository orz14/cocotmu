<?php
class profil extends controller {
    public function index()
    {
        $data['judul'] = 'Profil | ';
        $this->view('logic/akses');
        $this->view('templates/metaTag', $data);
        $this->view('styles/style');
        $this->view('templates/header');
        $this->view('profil/profil');
        $this->view('modal/modalLogout');
        $this->view('templates/footer');
        $this->view('scripts/scriptDefault');
        $this->view('templates/penutup');
    }
    public function edit()
    {
        $data['judul'] = 'Edit Profil | ';
        $this->view('logic/akses');
        $this->view('templates/metaTag', $data);
        $this->view('styles/style');
        $this->view('templates/header');
        $this->view('profil/edit');
        $this->view('modal/modalLogout');
        $this->view('scripts/scriptDefault');
        $this->view('templates/penutup');
    }
    public function password()
    {
        $data['judul'] = 'Ganti Password | ';
        $this->view('logic/akses');
        $this->view('templates/metaTag', $data);
        $this->view('styles/style');
        $this->view('templates/header');
        $this->view('profil/password');
        $this->view('modal/modalLogout');
        $this->view('scripts/scriptDefault');
        $this->view('templates/penutup');
    }
}