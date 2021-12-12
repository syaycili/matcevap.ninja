<?php
include 'config.php';

  if(isset($_POST['kadi'],$_POST['sifre'])){  

    session_start();
    session_unset();

    $kadi = $_POST['kadi'];
    $sifre = $_POST['sifre'];
    $sifre = sha1($sifre);

    $sql = "SELECT kadi, sifre FROM uyeler WHERE kadi='$kadi' ";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
      while($row = $result->fetch_assoc()) {
        $gelenkadi = $row["kadi"];
        $gelensifre = $row["sifre"];
      }


      if($gelenkadi == $kadi && $gelensifre == $sifre){


        $_SESSION["kullanici"] = $kadi; 
        yonlendir("index.php");


      }else{
        yonlendir("girisyap.php?hata=Kullanıcı adı veya şifre yanlış!");
      }



    } else {
        yonlendir("girisyap.php?hata=Kullanıcı adı veya şifre yanlış!");
    }

    $conn->close();
  
  }else{
      yonlendir("girisyap.php");
  }



?>