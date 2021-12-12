<?php 
include "../config.php";
session_start();

if(isset($_SESSION["admin"])) { 

    if(isset($_GET["kadi"])) { 

    $kullanici = $_GET["kadi"];



    $sql = "SELECT soru_id, soru_resim FROM sorular WHERE soran = '$kullanici' ";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {

        $soru_id = $row["soru_id"];
        $soru_resim = $row["soru_resim"];


        $asql = "DELETE FROM sorular WHERE soru_id=$soru_id";
        $conn->query($asql);
    
        $asql = "DELETE FROM cozumler WHERE soru_id=$soru_id";
        $conn->query($asql);
        
        $soru_resim = '../'.$soru_resim;
        unlink($soru_resim);


      }
    }




    $sql = "SELECT cozum_id, cozum_kullanici, soru_id FROM cozumler WHERE cozum_kullanici = '$kullanici' ";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {

      while($row = $result->fetch_assoc()) {
        



        $cozum_id = $row["cozum_id"];
        $cozum_kullanici = $row["cozum_kullanici"];
        $soru_id = $row["soru_id"];
    
    
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
    


      }
    }




    $sql = "DELETE FROM uyeler WHERE kadi='$kullanici' ";
    $conn->query($sql);




    $conn->close();

    yonlendir($_SERVER['HTTP_REFERER']);

    }else{
        
       yonlendir("../hata.php");
    
    }

}else{
    
   yonlendir("../admin.php?hata=Lütfen Oturum Açın");

}
?>