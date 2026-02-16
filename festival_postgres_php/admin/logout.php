<?php
session_start();

// सर्व session variables clear
$_SESSION = [];

// session destroy
session_destroy();

// login page ला redirect
header("Location: login.php");
exit;
