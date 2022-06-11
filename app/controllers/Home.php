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
    SessionManager::token_form();
    $this->view('home/login', $data);
  }

  public function do_login()
  {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

      $csrf = Security::csrf_token();

      $login =  SessionManager::login();
      if ($login === true && $csrf === 1) {
        header("Location:" . BASEURL."about");
        exit(0);
      } else {
        flasher::setFlash('gagal', 'error');
        self::login();
      }
    } else {
      flasher::setFlash('gagal',  'error');
      self::login();
    }
  }

  public function logout()
  {
    SessionManager::logout();
  }
}
