<?php
session_start();

$_SESSION = array();

session_destroy();
setcookie('_bk_','',time()-(60*60*24),'/');
header("Location:../../index.php");
exit;

?>