<?php
include 'config.php';
session_start();
session_destroy();
yonlendir('index.php');
?>