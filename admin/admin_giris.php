<?php 
include '../config.php';
session_start();
session_unset();

if(isset($_POST['kullanici_adi'],$_POST['sifre'])){

    $admin_adi = $_POST['kullanici_adi'];
    $sifre = $_POST['sifre'];
    $admin_sifre = sha1($sifre);



$sql = "SELECT admin_adi, admin_sifre FROM adminler WHERE admin_adi = '$admin_adi' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $db_admin_adi = $row["admin_adi"];
    $db_admin_sifre = $row["admin_sifre"];
  }
} else {
    yonlendir('../admin.php?hata=Kullanıcı adı veya şifre hatalı');
}


if($admin_adi == $db_admin_adi && $admin_sifre == $db_admin_sifre){

    $_SESSION['admin'] = $admin_adi;
    yonlendir('admin_paneli.php');

}else {
    yonlendir('../admin.php?hata=Kullanıcı adı veya şifre hatalı');
}






$conn->close();



}else{
    yonlendir('../admin.php');
}


?>