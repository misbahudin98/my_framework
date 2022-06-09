<?php

class Security extends SessionManager
{
   private static $max_time_token = 60; //s

   public function __construct()
   {
      $this->xss_protection();
   }
   private function xss_protection()
   {
      header("X-XSS-Protection: 1; mode=block");
   }



   public  static function csrf_time()
   {
      if (isset($_SESSION['token_time'])) {
         if ($_SESSION['token_time'] + self::$max_time_token >= time()) {
            return 1;
         } else {
            unset($_SESSION['token']);
            unset($_SESSION['token_time']);
            return  0;
         }
      }
      return 0;
   }


   public static function csrf_token()
   {
      parent::start();
      if ($_SERVER['REQUEST_METHOD'] === "POST" && !empty($_POST)) {
         // var_dump($_POST['token'], $_SESSION['token'])  or die;
         if ($_POST['token'] == $_SESSION['token']) {
            return 1;
         } else {
            session_destroy();
            return 0;
         }
      }
      return 0;
   }

   public static function  xss_input($value)
   {
      return  htmlspecialchars(strip_tags($value, '<a><b><i>'), ENT_IGNORE | ENT_HTML401 | ENT_QUOTES | ENT_SUBSTITUTE);
   }
   public static function token_validasi($value): bool
   {
      return $_SESSION['token'] == $value ?: false;
   }

   public static function pass_hash($value)
   {
      return password_hash($value, PASSWORD_BCRYPT);
   }
   public static function pass_verify($value, $hash): bool
   {
      return password_verify($value, $hash);
   }
}
