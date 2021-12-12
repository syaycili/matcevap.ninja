<?php 
include 'config.php';
session_start();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matematik Yardımlaşma Platformu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="css/Header-Blue.css">
</head>
<body>


<div id="myNav" class="overlay">

  <!-- Button to close the overlay navigation -->
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

  <?php 
  if(isset($_SESSION['kullanici'])){  
  $kullanici = $_SESSION['kullanici'];
  ?>

  <div class="overlay-content">
    
    <span class="hosgeldin" >Merhaba, <span class="isim"><?php echo $kullanici; ?></span> 👋</span>
    <a href="sorusor.php">Soru Sor</a>
    <a href="sorularim.php">Sorularım</a>
    <a href="logout.php">Çıkış Yap</a>
  </div>

  <?php 
  }else{  ?>

  <div class="overlay-content">
    <a href="girisyap.php">Üye Girişi</a>
    <a href="uyeol.php">Kayıt Ol</a>
  </div>  

  <?php  
  }
  ?>



</div>





    
<nav class="navbar navbar-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="img/logo.svg" height="40" class="d-inline-block align-text-top">
    </a>

    <span class="buton" onclick="openNav()"><img height="30" src="img/list.svg"></span>
  </div>
</nav>












<header class="header-blue" style="padding-bottom: 0px;">
        <div class="container hero" style="margin-top: 0px;">
            <div class="row">
                <div class="col-12 col-lg-6 col-xl-5 offset-xl-1">
                    <h1>Matematik sorularınızı sorun!</h1>
                    <p>Matematik sorularınızı sorun ve başka öğrencilerin cevaplaması için bekleyin veya diğer öğrencilere yardımcı olun!</p>
                    
                    
                    
                    
                    
                    
                 





                    <?php 
  if(isset($_SESSION['kullanici'])){  
  $kullanici = $_SESSION['kullanici'];
  ?>

<a href="sorusor.php" class="btn btn-light btn-lg action-button" type="button">Yeni Soru Sorun!</a>

  <?php 
  }else{  ?>

<a href="uyeol.php" class="btn btn-light btn-lg action-button" type="button">Hemen Üye Olun!</a>

  <?php  
  }
  ?>









                    
                  </div>
                <div class="col-md-5 col-lg-5 offset-lg-1 offset-xl-0 d-none d-lg-block phone-holder">
                    <div class="phone-mockup"><img class="device" src="img/undraw_education_f8ru.svg">
                        <div class="screen"></div>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </header>









<div class="govde">






















<div class="sorular">









<?php

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 5;
$offset = ($pageno-1) * $no_of_records_per_page;


$total_pages_sql = "SELECT COUNT(*) FROM sorular";
$result = mysqli_query($conn,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

$sql = "SELECT * FROM sorular ORDER BY soru_id DESC LIMIT $offset, $no_of_records_per_page";
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

      <a href="sorudetay.php?id=<?php echo $soru_id; ?>&gidis=1" class="mt-2"><button class="cevapla">Cevapla</button></a>
      
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

<?php if($pageno == 1 && $pageno == $total_pages){?>

<li class="page-item"><a class="visually-hidden page-link" href="#">#</a></li>
<li class="page-item"><a class="page-link" id="sayfa-gecisleri" href="#"><?php echo $pageno;?></a></li>
<li class="page-item"><a class="visually-hidden page-link" href="#">#</a></li>

<?php }else if($pageno == 1){?>

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