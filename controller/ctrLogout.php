<?php
session_start();
unset($_SESSION['auth']['connect_email']);
unset($_SESSION['auth']['admin']);
session_destroy();
header('Location:../index.php');