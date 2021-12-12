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
    <title>Matematik Yardımlaşma Platformu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="css/sorularim.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body>


<nav class="navbar navbar-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="img/logo.svg" height="40" class="d-inline-block align-text-top">
    </a>

    <a class="anasayfa" href="index.php"><img height="30" src="img/home-outline.svg" alt=""></a>
  </div>
</nav>




<div class="govde">



<div class="sorular">

<?php


$sql = "SELECT toplamcevap, tumcevap, toplamsoru FROM uyeler WHERE kadi = '$kullanici' ";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
  while($row = $result->fetch_assoc()) {
   $toplamcevap = $row["toplamcevap"];
   $tumcevap = $row["tumcevap"];
   $toplamsoru = $row["toplamsoru"];
  }
} else {
}


?>

<div class="bilgiler">

<h4>Soru sayısı: <span class="badge bg-secondary"><?php echo $toplamsoru; ?></span></h4>
<h4>Cevap sayısı: <span class="badge bg-secondary"><?php echo $tumcevap; ?></span></h4>
<h4>Onaylanan cevap sayısı: <span class="badge bg-secondary"><?php echo $toplamcevap; ?></span></h4>
</div>

<br>




<?php

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 5;
$offset = ($pageno-1) * $no_of_records_per_page;


$total_pages_sql = "SELECT COUNT(*) FROM sorular WHERE soran='$kullanici'";
$result = mysqli_query($conn,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

$sql = "SELECT * FROM sorular WHERE soran='$kullanici' ORDER BY soru_id DESC LIMIT $offset, $no_of_records_per_page";
$res_data = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($res_data)){
    $baslik = $row['baslik'];
    $soran = $row['soran'];
    $total_cevap = $row['total_cevap'];
    $sonuc = $row['sonuc'];
    $soru_id = $row['soru_id'];
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


        <?php

    if($sonuc == 0){?>

      <a href="sorudetay.php?id=<?php echo $soru_id; ?>&gidis=1" class="mt-2"><button class="cevapla">Cevaplara Bak</button></a>
      
      <?php
      }else{ ?>

    <a href="sorudetay.php?id=<?php echo $soru_id; ?>&gidis=1" class="mt-2"><button class="cevapla">Yanıtları Gör</button></a>
    <img class="onay_svg" src="img/onay.svg" data-toggle="tooltip" title="Çözüldü!">

      <?php } ?>

        





      </div>
    </div>
    </div>
    







<?php
}
mysqli_close($conn);
?>










<div style="margin-bottom: 10px;">
      <nav aria-label="Sayfa Navigasyonu">
        <ul class="pagination justify-content-center">
          <li class="page-item">
            <a class="<?php if($pageno <= 1){ echo 'btn disabled '; } ?>page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".'1'; } ?>" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          <?php if($pageno == 1){?>

<li class="page-item"><a class="visually-hidden page-link" href="#">#</a></li>
<li class="page-item"><a class="page-link" id="sayfa-gecisleri" href="#"><?php echo $pageno;?></a></li>
<li class="page-item"><a class="page-link" href="<?php echo "?pageno=".($pageno + 1);?>"><?php echo $pageno + 1;?></a></li>

<?php }else if($pageno == $total_pages){?>

<li class="page-item"><a class="page-link" href="<?php echo "?pageno=".($pageno - 1);?>"><?php echo $pageno - 1;?></a></li>
<li class="page-item"><a class="page-link" id="sayfa-gecisleri" href="#"><?php echo $pageno;?></a></li>
<li class="page-item"><a class="visually-hidden page-link" href="#">#</a></li>
<?php }else{?>


<li class="page-item"><a class="page-link" href="<?php echo "?pageno=".($pageno - 1);?>"><?php echo $pageno - 1;?></a></li>
<li class="page-item"><a class="page-link" id="sayfa-gecisleri" href="#"><?php echo $pageno;?></a></li>
<li class="page-item"><a class="page-link" href="<?php echo "?pageno=".($pageno + 1);?>"><?php echo $pageno + 1;?></a></li>
<?php }

?>
          <li class="page-item">
            <a class="<?php if($pageno >= $total_pages){ echo 'btn disabled '; } ?>page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".$total_pages; } ?>" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>
  

    </div>








</div>







</div>

<script src="js/menu.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>


<?php
  }else{ 
    yonlendir('girisyap.php?hata=Bu sayfayı görüntülemek için üye girişi yapmanız gerekmektedir');
  }
  ?>