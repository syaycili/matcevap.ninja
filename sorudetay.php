<?php 
include 'config.php';
session_start();
if(isset($_GET['id'])){

$soru_id = $_GET['id'];

if(isset($_GET['gidis'])){

  $gelis = $_SERVER["HTTP_REFERER"];

  $_SESSION['gelinen'] = $gelis."#$soru_id";

  $gelinen = $_SESSION['gelinen'];

  yonlendir("sorudetay.php?id=$soru_id");

}else{

  $gelinen = $_SESSION['gelinen'];

}


?>








<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matematik Yardımlaşma Platformu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="css/sorudetay.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>







    
<nav class="navbar navbar-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="img/logo.svg" height="40" class="d-inline-block align-text-top">
    </a>

    <a class="anasayfa" href="<?php echo $gelinen;?>"><img height="30" src="img/back.svg" alt=""></a>
  </div>
</nav>




<div class="anagovde">

    














<?php

$sql = "SELECT baslik, soran, soru_resim, sorulan_tarih, total_cevap, sonuc, cozum_id FROM sorular WHERE soru_id='$soru_id' ";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
  while($row = $result->fetch_assoc()) {
 
     
    $baslik = $row["baslik"];
    $soran = $row["soran"];
    $soru_resim = $row["soru_resim"];
    $sorulan_tarih = $row["sorulan_tarih"];
    $total_cevap = $row["total_cevap"];
    $sonuc = $row["sonuc"];
    $acozum_id = $row["cozum_id"];

    if(isset($_SESSION['kullanici'])){

      $kullanici = $_SESSION['kullanici'];

      if($soran==$kullanici && $sonuc==0 ){
        $sahip = 1;
      }else{
        $sahip = 0;
      }

    }else{
      $sahip = 0;
    }


?>



<div class="soru-div" id="<?php echo $soru_id; ?>">
    <div class="card">
      <div class="card-header">
    
    
    
      <div class="row justify-content-between">
        <div class="col-5">
          <p class="sol"><?php echo $soran; ?></p>
        </div>
        <div class="col-5">
          <p class="sag"><span class="badge bg-secondary"><?php echo $total_cevap; ?></span></p>
        </div>
      </div>
    
    
    
      </div>
      <div class="card-body">
        <h5 class="card-title"><?php echo $baslik; ?></h5>
        <p class="card-text">

        <a target="_blank" href="<?php echo $soru_resim; ?>">
            <img id="resim" class="resim" src="<?php echo $soru_resim; ?>" alt="bulunamadi.jpeg">
        </a>

  

        </p>

        <?php

    if($sonuc == 0){?>
<button type="button" class="btn cevapla" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Cevapla</button>
      
      <?php
      }else{ ?>

      <?php } ?>

        





      </div>
    </div>
    </div>
    





<?php
  }
} else {
    yonlendir("hata.php");
}


?>





<br>




<div class="cevaplar">








<?php 
if($sonuc==0){

}else{?>

<h3 class="cevap_baslik">Bu soru çözülmüş, kabul edilen cevap:</h3>










<?php


$sqlb = "SELECT cozum_id, cozum, cozum_kullanici, cozum_link FROM cozumler WHERE cozum_id='$acozum_id' ";
$resulta = $conn->query($sqlb);
if ($resulta->num_rows == 1) {
  while($row = $resulta->fetch_assoc()) {
    $cozum_id = $row['cozum_id'];
    $cozum = $row['cozum'];
    $cozum_kullanici = $row['cozum_kullanici'];
    $cozum_link = $row['cozum_link'];
?>

<div class="card ccard mb-5">
  <div class="card-header chead">
  <?php echo $cozum_kullanici; ?>
  </div>
  <div class="card-body cbody">
      <p><?php echo $cozum; ?></p>
      <p><a href="<?php echo $cozum_link; ?>" target="_blank"><?php echo $cozum_link; ?></a></p>








  </div>
</div>

<?php
  }
} 






 ?>












<?php 

}
?>





























<h3 class="cevap_baslik">Cevaplar</h3>





















<?php


$sqlb = "SELECT cozum_id, cozum, cozum_kullanici, cozum_link FROM cozumler WHERE soru_id='$soru_id' ORDER BY cozum_id DESC";
$resulta = $conn->query($sqlb);
if ($resulta->num_rows > 0) {
  while($row = $resulta->fetch_assoc()) {
    $cozum_id = $row['cozum_id'];
    $cozum = $row['cozum'];
    $cozum_kullanici = $row['cozum_kullanici'];
    $cozum_link = $row['cozum_link'];
?>

<div class="card ccard mb-5">
  <div class="card-header chead">
  <?php echo $cozum_kullanici; ?>
  </div>
  <div class="card-body cbody">
      <p><?php echo $cozum; ?></p>
      <p><a href="<?php echo $cozum_link; ?>" target="_blank"><?php echo $cozum_link; ?></a></p>

<?php

if($sahip==1){?>
  <a type="button" href="cevaponay.php?soru_id=<?php echo $soru_id; ?>&cozum_id=<?php echo $cozum_id; ?>" class="btn btn-success">Cevabı kabul edin</a>
<?php
}else{}
?>







  </div>
</div>

<?php
  }
} else {
  echo "Hiç çözüm yok";
}






 ?>





















</div>















<?php  
if(isset($_SESSION['kullanici'])){  
  $kullanici = $_SESSION['kullanici'];
?>

<style>

.modal-content{
  text-align: left;
}

</style>


<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
  <form method="post" action="cevapson.php">
  <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cevap ekle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

          <input class="visually-hidden" type="number" value="<?php echo $soru_id;?>" name="soru_id" required>

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Çözüm linki (varsa):</label>
            <input type="text" class="form-control" id="recipient-name" name="cozum_link">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Çözüm:</label>
            <textarea class="form-control" id="message-text" name="cozum" required></textarea>
          </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
        <input class="btn btn-primary" type="submit" value="Gönder">
      </div>
    </div>
    </form>
  </div>
</div>


<?php
  }else{ 
    ?>



<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Cevap ekle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p style="text-align: left;">Cevap vermek için üye girişi yapmanız gerekmektedir. Üye girişi yapmak için <a href="girisyap.php">buraya</a> tıklayınız...</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
      </div>
    </div>
  </div>
</div>


<?php
  }
  ?>



































<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>










<?php
}else{
    yonlendir('index.php');
}
$conn->close();


?>