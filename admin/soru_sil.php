<?php 
include "../config.php";
session_start();

if(isset($_SESSION["admin"])) { 

    if(isset($_GET["soru_id"],$_GET["resim_yol"],$_GET["soran"])) { 

    $soru_id = $_GET["soru_id"];
    $resim_yol = $_GET["resim_yol"];
    $soran = $_GET["soran"];
  
    $sql = "DELETE FROM sorular WHERE soru_id=$soru_id";
    $conn->query($sql);

    $sql = "DELETE FROM cozumler WHERE soru_id=$soru_id";
    $conn->query($sql);
    
    $resim_yol = '../'.$resim_yol;
    unlink($resim_yol);



    $conn->close();

    yonlendir('sorular.php');

    }else{
        
       yonlendir("../hata.php");
    
    }

}else{
    
   yonlendir("../admin.php?hata=Lütfen Oturum Açın");

}
?>