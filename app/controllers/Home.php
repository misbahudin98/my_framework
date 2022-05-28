<?php
class Home extends Controller
{
  private $judul = "Home";
  public function index()
  {
    $data['judul'] = $this->judul;

    $this->view('home/index', $data);
  }

  public function login()
  {
    $data['judul'] = $this->judul;
    $this->view('home/login', $data);
  }

  public function do_login()
  {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      $data['judul'] = $this->judul;
      $login =  SessionManager::login();
      if ($login === true ) {
        header("Location:" . BASEURL . "about");
        exit(0);
      } else {
        flasher::setFlash('gagal', 'periksa kembali username dan password !', 'danger');
        header("Location:" . BASEURL . "home/login");
      }
    }else {
      flasher::setFlash('gagal', 'periksa kembali username dan password !', 'danger');
      header("Location:" . BASEURL . "home");
    }

  }

  public function logout()
  {
     SessionManager::logout();
  }
}
