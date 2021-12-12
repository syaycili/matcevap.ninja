<?php 
include "../config.php";
session_start();

if(isset($_SESSION["admin"])) { 

    if(isset($_GET["cozum_id"],$_GET["soru_id"],$_GET["cozum_kullanici"])) { 

    $cozum_id = $_GET["cozum_id"];
    $cozum_kullanici = $_GET["cozum_kullanici"];
    $soru_id = $_GET["soru_id"];


    $sql = "SELECT cozum_id FROM sorular WHERE soru_id='$soru_id' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {while($row = $result->fetch_assoc()) {$cozum = $row["cozum_id"];}}

    if($cozum == $cozum_id){

        $sql = "UPDATE sorular SET sonuc = 0 WHERE soru_id='$soru_id' ";
        $conn->query($sql);

        $sql = "UPDATE uyeler SET toplamcevap = toplamcevap - 1 WHERE kadi='$cozum_kullanici' ";
        $conn->query($sql);
    }

    $sql = "UPDATE sorular SET total_cevap = total_cevap - 1 WHERE soru_id='$soru_id' ";
    $conn->query($sql);

    $sql = "UPDATE uyeler SET tumcevap = tumcevap - 1 WHERE kadi='$cozum_kullanici' ";
    $conn->query($sql);

    $sql = "DELETE FROM cozumler WHERE cozum_id=$cozum_id";
    $conn->query($sql);

    $conn->close();

    yonlendir('cevaplar.php');

    }else{
        
       yonlendir("../hata.php");
    
    }

}else{
    
   yonlendir("../admin.php?hata=Lütfen Oturum Açın");

}
?>