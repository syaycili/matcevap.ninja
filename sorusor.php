<?php  
include 'config.php';
session_start();

if(isset($_SESSION['kullanici'])){  
  $kullanici = $_SESSION['kullanici'];
?>




<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soru Sor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="css/sorusor.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>




    
<nav class="navbar navbar-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="img/logo.svg" height="40" class="d-inline-block align-text-top">
    </a>

    <a class="anasayfa" href="index.php"><img height="30" src="img/home-outline.svg" alt=""></a>
  </div>
</nav>




<div class="anagovde">

    <h2>Yeni Soru Ekle</h2>


    <form action="yenisoru.php" method="post" enctype="multipart/form-data">

    <label for="baslik">Başlık:</label>
    <input class="giris" type="text" name="baslik" id="baslik" maxlength="100" required><br>

    <label for="soru">Soru Resmi:</label>
    <input style="margin-bottom: 5px;" class="soru-giris" type="file" name="image_file" id="imgInp" accept="image/x-png,image/jpeg" required>
    <small>Yüklediğiniz fotoğraf yatay çekilmiş olmalıdır!</small><br>

    <div class="kutu">
    <img class="preview" id="blah" src="#" onerror="this.src='img/onizleme.svg'"/>
    </div>

    <input class="gonder" type="submit" value="Paylaş">

    </form>









<script>
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#imgInp").change(function() {
  readURL(this);
});
</script>



















<script>

var uploadField = document.getElementById("soru");

uploadField.onchange = function() {
    if(this.files[0].size > 5080000){
       alert("Dosya boyutu en fazla 5mb olabilir!");
       this.value = "";
    };
};

</script>














</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>



<?php
  }else{ 
    yonlendir('girisyap.php?hata=Soru sormak için üye girişi yapmanız gerekmektedir');
  }
  ?>