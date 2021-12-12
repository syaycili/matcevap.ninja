<?php

// Yönlendirme Fonksiyonu
function yonlendir($url,$zaman = 0){
if($zaman != 0){
header("Refresh: $zaman; url=$url");
}
else header("Location: $url");
}


$servername = ""; //Database Server Adress
$username = ""; //Databese Username
$password = ""; //Database Password
$dbname = ""; //Database Name





$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {

    yonlendir('hata.php');
    die();

}










$smtphost =  "mail.sodayazilim.educationhost.cloud"; // SMTP sunucusu örnek : mail.alanadi.com

$smtpusername =  "smtp@sodayazilim.educationhost.cloud"; // Mail kullanıcı adı

$smtppassword =  "Sarp20052323"; // Mail şifresi

$smtpsecuretype =  "tls"; // Şifreleme

$smtpportnumber =  "587"; // SMTP Port




?>


