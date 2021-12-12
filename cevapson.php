<?php
session_start();
include 'config.php';

if(isset($_SESSION["kullanici"],$_POST["soru_id"],$_POST["cozum"])) {

    if(isset($_POST["cozum_link"])) {
        $cozum_link = $_POST["cozum_link"];
    } else {  
        $cozum_link = "";
    }

    $kullanici = $_SESSION["kullanici"];
    $soru_id = $_POST["soru_id"];
    $cozum = $_POST["cozum"];






    $sql = "INSERT INTO cozumler (cozum, cozum_kullanici, cozum_link, soru_id) VALUES ('$cozum', '$kullanici', '$cozum_link', '$soru_id')";

    if ($conn->query($sql) === TRUE) {

    header('Location: ' . $_SERVER['HTTP_REFERER']);

    } else {
        yonlendir("hata.php");
    }



    $sql = "UPDATE sorular SET total_cevap=total_cevap+1 WHERE soru_id='$soru_id' ";
    $conn->query($sql);


    $sql = "UPDATE uyeler SET tumcevap = tumcevap + 1 WHERE kadi = '$kullanici' ";
    $conn->query($sql);



} else {  
    yonlendir("index.php");
}

mysqli_close($conn);
?>


