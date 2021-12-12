<?php 
include "../config.php";
session_start();

if(isset($_SESSION["admin"])) { 


?>  


<!doctype html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/admin_tablo.css">
    <title>Tüm Sorular</title>
  </head>
  <body>

  <h3 class="mb-5 mt-5">Tüm Sorular</h3>

  





    






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
    $soru_resim = $row['soru_resim'];
?>

<div class="row">
    <div class="col-10">
 







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


      <a href="../sorudetay.php?id=<?php echo $soru_id; ?>&gidis=1" class="mt-2"><button class="cevapla">Soruyu Gör</button></a>
      


      </div>
    </div>
    </div>









    </div>
    <div class="col-2 btngurubu">
      <a class="btn btn-danger islem-button-soru" href="soru_sil.php?soru_id=<?php echo $soru_id; ?>&soran=<?php echo $soran; ?>&resim_yol=<?php echo $soru_resim; ?>">Sil</a>
      <a class="btn btn-warning islem-button-soru" href="kullanici_sil.php?kadi=<?php echo $soran; ?>">Kullanıcıyı Sil</a>
    </div>
  </div>

   
    







<?php
}
mysqli_close($conn);
?>




<br>





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





















<br>
<a class="mt-5" href="admin_paneli.php"><button type="button" class="btn btn-light">Geri Dön</button></a>
<br><br>


        </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  </body>
</html>



<?php
}else{
    
   yonlendir("../admin.php?hata=Lütfen Oturum Açın");

}
?>