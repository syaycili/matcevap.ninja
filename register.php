<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


include 'config.php';

  if(isset($_POST['kadi'],$_POST['isim_soyisim'],$_POST['sifre'],$_POST['mail'])){  

    session_start();
    session_unset();


  $kadi = $_POST['kadi'];
  $kadi = filter_var($kadi, FILTER_SANITIZE_STRING);

  $isim_soyisim = $_POST['isim_soyisim'];
  $isim_soyisim = filter_var($isim_soyisim, FILTER_SANITIZE_STRING);
  
  $sifre = $_POST['sifre'];
  $sifre = sha1($sifre);

  $mail = $_POST['mail'];
  $eposta = filter_var($mail, FILTER_SANITIZE_EMAIL);





  $sql = "SELECT kadi, mail FROM uyeler WHERE mail='$mail' ";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) {}

  yonlendir("uyeol.php?hata=Bu mail adresi zaten alınmış");
    die();
  } 
  else {

    $sql = "SELECT kadi, mail FROM uyeler WHERE kadi='$kadi' ";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) {}
  
    yonlendir("uyeol.php?hata=Bu kullanıcı adı zaten alınmış");
      die();
    } 
    else {}


  }
  $conn->close();









  $_SESSION["0kadi"] = "$kadi";
  $_SESSION["0isim_soyisim"] = "$isim_soyisim";
  $_SESSION["0sifre"] = "$sifre";
  $_SESSION["0mail"] = "$mail";


  $kod = rand(1000, 9999);

  $_SESSION["kod"] = $kod;





        

  require 'PHPMailer/src/Exception.php';
  require 'PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/src/SMTP.php';
  
  
  $mail = new PHPMailer(true);
  try {
   //Server settings
   $mail->CharSet = 'UTF-8';
   $mail->SMTPDebug = 0; // debug on - off
   $mail->isSMTP(); 
   $mail->Host = $smtphost; // SMTP sunucusu örnek : mail.alanadi.com
   $mail->SMTPAuth = true; // SMTP Doğrulama
   $mail->Username = $smtpusername; // Mail kullanıcı adı
   $mail->Password = $smtppassword; // Mail şifresi
   $mail->SMTPSecure = $smtpsecuretype; // Şifreleme
   $mail->Port = $smtpportnumber; // SMTP Port
  $mail->SMTPOptions = array(
   'ssl' => array(
   'verify_peer' => false,
   'verify_peer_name' => false,
   'allow_self_signed' => true
   )
  );
  
   //Alıcılar
   $mail->setfrom("$smtpusername", 'Matematik Yardımlaşma Platformu');
   $mail->addAddress($eposta);
   $mail->addReplyTo("sarpyaycili@gmail.com", "Teknik Destek");
   //İçerik
   $mail->isHTML(true);
   $mail->Subject = 'Üyelik Aktivasyonu';
   $mail->Body = "
   
   
<h3>Üyelik Aktivasyonu</h3><br>
<p>Merhaba, üyeliğinizi aktifleştirmek için lütfen aşağıdaki kodu gerekli alana giriniz...</p><br>
<h2>".$kod."</h2><br>";
  
   $mail->send();
 
   yonlendir("mailgonderildi.php");


  } catch (Exception $e) {

   echo 'Üyelik işlemi tamamlanamadı!', $mail->ErrorInfo;

  }





































  
  }else{
      yonledir("uyeol.php");
  }



?>