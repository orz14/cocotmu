<?php
class p extends controller {
    public function index($p)
    {
        $data['username'] = $p;
        $profil = query("SELECT nama FROM users_tb WHERE username = '$p'")[0];
        $data['judul'] = $profil["nama"].' | ';
        $this->view('logic/akses');
        $this->view('templates/metaTag', $data);
        $this->view('styles/style');
        $this->view('templates/header');
        $this->view('profil/p', $data);
        $this->view('modal/modalLogout');
        $this->view('templates/footer');
        $this->view('scripts/scriptDefault');
        $this->view('templates/penutup');
    }
}