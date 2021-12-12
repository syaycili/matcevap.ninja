<?php
include 'config.php';

if(isset($_GET['sifreleme'])){

    $sifrele = $_GET['sifreleme'];

    $sifrele = sha1($sifrele);

    echo $sifrele;

}else{
    yonlendir('index.php');
}
?>