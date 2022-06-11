<?php

class flasher{

    public static function setFlash($pesan, $tipe)
    {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'tipe' => $tipe
        ];

    }

    public static function flash()
    {
        if(isset( $_SESSION['flash'])){
            echo  '<div class="notyf" data="'.$_SESSION['flash']['pesan'].'" type="'.$_SESSION['flash']['tipe'].'"></div>';
          unset($_SESSION['flash']);
        }
    }
}