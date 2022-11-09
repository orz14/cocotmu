<?php
class post extends controller {
    public function edit($id)
    {
        $data['judul'] = 'Edit Postingan | ';
        $data['id'] = $id;
        $this->view('logic/akses');
        $this->view('templates/metaTag', $data);
        $this->view('styles/style');
        $this->view('templates/header');
        $this->view('post/edit', $data);
        $this->view('modal/modalLogout');
        $this->view('scripts/scriptDefault');
        $this->view('templates/penutup');
    }
    public function hapus($id)
    {
        $data['judul'] = 'Hapus Postingan | ';
        $data['id'] = $id;
        $this->view('logic/akses');
        $this->view('templates/metaTag', $data);
        $this->view('styles/style');
        $this->view('templates/header');
        $this->view('post/hapus', $data);
        $this->view('modal/modalLogout');
        $this->view('scripts/scriptDefault');
        $this->view('templates/penutup');
    }
}