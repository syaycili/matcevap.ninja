<!doctype html>
<html lang="tr">
  <head>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Admin Girişi</title>
  </head>
  <body>
<h1 class="mb-4 mt-4 text-center">Admin Girişi</h1>

<?php if(isset($_GET['hata'])){
$hata=$_GET['hata'];
?>
<p class="text-center text-danger"><?php echo $hata; ?></p>
<?php
}?>



<div class="container">
<form action="admin/admin_giris.php" method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Kullanıcı Adı</label>
    <input type="text" class="form-control"  name="kullanici_adi" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Şifre</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="sifre" required>
  </div>
  <button type="submit" class="btn btn-primary">Giriş Yap</button>
</form>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>