<?php


new Security();

define('BASEURL',"http://localhost/psb/public/");
// //token form
session_start();
$_SESSION['token'] = bin2hex(random_bytes(35));

