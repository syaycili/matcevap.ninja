<?php
include 'config.php'; 
session_start();

if(isset($_SESSION["kod"])){
}else{
    yonlendir('hata.php');
} ?>


<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="css/uyeol.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body>




<div class="govde">




<h1 class="baslik">Aktivasyon Kodunu Giriniz!</h1>



<form action="uyeolson.php" method="post">

    <label for="kod">Kod:</label>
    <input class="giris" type="number" min="999" max="10000" name="gelen_kod" id="kod" required><br>

    <input class="gonder" type="submit" value="Gönder">

</form>














</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>