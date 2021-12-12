<?php
session_start();
include 'config.php';

if(isset($_SESSION["kullanici"],$_GET["soru_id"],$_GET["cozum_id"])) {

    $kullanici = $_SESSION["kullanici"];
    $soru_id = $_GET["soru_id"];
    $cozum_id = $_GET["cozum_id"];

    
    $sql = "SELECT soran FROM sorular WHERE soru_id='$soru_id' ";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
  while($row = $result->fetch_assoc()) {
   $soran = $row["soran"];
  }
} else {
    yonlendir("hata.php");
}


if($soran==$kullanici){

    $sql = "UPDATE sorular SET sonuc=1 WHERE soru_id='$soru_id' ";
    $conn->query($sql);

    $sql = "UPDATE sorular SET cozum_id='$cozum_id' WHERE soru_id='$soru_id' ";
    $conn->query($sql);




    $sql = "SELECT cozum_kullanici FROM cozumler WHERE cozum_id = '$cozum_id' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
  
  while($row = $result->fetch_assoc()) {
    $cozen = $row["cozum_kullanici"];
  }}




    $sql = "UPDATE uyeler SET toplamcevap = toplamcevap + 1 WHERE kadi='$cozen' ";
    $conn->query($sql);


    yonlendir($_SERVER["HTTP_REFERER"]);

}else{
    yonlendir("hata.php");
}




} else {  
    yonlendir("index.php");
}

mysqli_close($conn);
?>


