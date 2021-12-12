<?php 
include '../config.php';
session_start();


if(isset($_SESSION['admin'])){

$admin = $_SESSION['admin'];?>
   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Admin Paneli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>








<style>
.btn{
  width: 100%;
  height: 75px;
}
</style>

  <div class="container">
    <header>
    <h3 class="text-light">Admin paneli <span class="badge bg-secondary">Merhaba <?php echo $admin?></span></h3><a href="../logout.php">Çıkış Yap</a>
    </header>


  <div class="content">




  <div class="row">
    <div class="col-md-3">
    <a href="ogrenciler.php"><button type="button" class="btn btn-secondary btn-lg">Öğrenciler</button></a>
    </div>
    <div class="col-md-3">
    <a href="sorular.php"><button type="button" class="btn btn-secondary btn-lg">Sorular</button></a>
    </div>
    <div class="col-md-3">
    <a href="cevaplar.php"><button type="button" class="btn btn-secondary btn-lg">Cevaplar</button></a>
    </div>
  </div>













<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>

<?php 
}else{
    yonlendir('../admin.php?hata=Bu sayfayı görüntülemek için admin girişi yapmanız gerekmektedir.');
}


?>