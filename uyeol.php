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




<h1 class="baslik">Kayıt Ol</h1>


<?php 
  if(isset($_GET['hata'])){  
  $hata = $_GET['hata'];
  ?>

    <span class="hata"><?php echo $hata; ?></span>

  <?php 
  }else{}
  ?>




<form action="register.php" method="post">

    <label for="kadi">Kullanıcı Adı:</label>
    <input class="giris" type="text" name="kadi" id="kadi" required><br>

    <label for="isim_soyisim">İsim - Soyisim:</label>
    <input class="giris" type="text" name="isim_soyisim" id="isim_soyisim" required><br>

    <label for="mail">E-Posta Adresi:</label>
    <input class="giris" type="email" name="mail" id="mail" required><br>

    <label for="sifre">Şifre:</label>
    <input class="giris" type="password" pattern=".{8,12}" required title="Şifreniz 8 ile 12 karakter arasında olmalıdır!" name="sifre" id="sifre" required><br>

    <label for="onay">Şifre Tekrar:</label>
    <input class="giris" type="password" name="sifre" id="onay" required>

    <br>

    <input class="gonder" type="submit" value="Kayıt Ol!">

</form>
<br>
<span class="geridon"><a href="index.php">Anasayfa</a> - <a href="girisyap.php">Üye Girişi</a></span>


<script src="js/geri.js"></script>





</div>

<script>
var password = document.getElementById("sifre"), confirm_password = document.getElementById("onay");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Şifreler Uyuşmuyor");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>