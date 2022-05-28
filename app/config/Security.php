<?php

class Security{
 public function __construct()
 {
    $this->xss_protection();
 }
 private function xss_protection(){
    header("X-XSS-Protection: 1; mode=block");

 }

 public static function  xss_input($value){
    return  htmlspecialchars(strip_tags($value,'<a><b><i>'),ENT_IGNORE|ENT_HTML401|ENT_QUOTES|ENT_SUBSTITUTE);
 }
 public static function token_validasi($value) :bool
 {
    return $_SESSION['token'] == $value ? : false;
 }

 public static function pass_hash($value){
    return password_hash($value,PASSWORD_BCRYPT);
 }
 public static function pass_verify($value,$hash) :bool
 {
   return password_verify($value,$hash);
 }


}