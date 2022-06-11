<?php

class About extends Controller{

    private  $judul = "About";
    public function __construct() {


           $session = SessionManager::getCurrentUser();

    }

    public function index($nama = "misbah", $as="gamer")
    {
        $this->santri();
    }
    public function santri()
    {

        $data['judul'] = $this->judul;
        $data['table'] = true;
        $data['button'] = true;
        $data['santri'] = $this->model('User_model')->getAllSantri();

        $this->view('templates/header',$data);
        $this->view('about/santri',$data);
        $this->view('templates/footer',$data);
    }
    public function detail($id)
    {
        $data['judul'] = 'Detail Mahasiswa';
        $data['santri'] = $this->model('User_model')->getSantriById($id);

        $this->view('templates/header',$data);
        $this->view('about/detail',$data);
        $this->view('templates/footer');
    }
    public function tambah()
    {

        if ($this->model('User_model')->tambah($_POST) > 0) {
            flasher::setFlash('berhasil','ditambahkan','success');
            header("Location:".BASEURL."about/santri");
            exit();
        }else{
            flasher::setFlash('gagal','ditambahkan','danger');
            header("Location:".BASEURL."about/santri");
            exit();
        }
    }

    public function hapus($id)
    {
        if ($this->model('User_model')->hapus($id) > 0) {
            flasher::setFlash('berhasil','dihapus','success');
            header("Location:".BASEURL."about/santri");
            exit();
        }else{
            flasher::setFlash('gagal','dihapus','danger');
            header("Location:".BASEURL."about/santri");
            exit();
        }
    }
    public function getUbah()
    {
        echo json_encode($this->model('User_model')->getSantriById($_POST['id']));

    }

    public function ubah()
    {

        if ($this->model('User_model')->ubah($_POST) > 0) {
            flasher::setFlash('berhasil','diubah','success');
            header("Location:".BASEURL."about/santri");
            exit();
        }else{
            flasher::setFlash('gagal','diubah','danger');
            header("Location:".BASEURL."about/santri");
            exit();
        }
    }
    public function cari()
    {

        $data =
        [
            'santri' => $this->model("User_model")->cari(),

            'judul' => $this->judul
        ];
        $this->view('templates/header',$data);
        $this->view('about/santri',$data);
        $this->view('templates/footer');

    }
}