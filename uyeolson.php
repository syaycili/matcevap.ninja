<?php 
include 'config.php';
session_start();

if(isset($_POST['gelen_kod'])){

    $gelen_kod = $_POST['gelen_kod'];
    $kod = $_SESSION["kod"];
  

    if($gelen_kod == $kod){


    $kadi = $_SESSION["0kadi"];
    $isim_soyisim = $_SESSION["0isim_soyisim"];
    $sifre = $_SESSION["0sifre"];
    $mail = $_SESSION["0mail"];

        

    $sql = "INSERT INTO uyeler (kadi, isim, mail, sifre) VALUES ('$kadi', '$isim_soyisim', '$mail', '$sifre')";
    
    if ($conn->query($sql) === TRUE) {

        session_unset();
        $_SESSION["kullanici"] = $kadi;

        yonlendir("index.php");

    } else {
      yonlendir("hata.php");
    }
    
    $conn->close();



    }else{
        session_unset();
        yonlendir("uyeol.php?hata=Hatalı kod");
    }




}else{
    yonlendir("hata.php");
}

?>