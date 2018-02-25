<?php

session_start();

$_SESSION['ingreso'] = false;
unset($_SESSION['mensaje']);

header("Location: index.php");

?>

