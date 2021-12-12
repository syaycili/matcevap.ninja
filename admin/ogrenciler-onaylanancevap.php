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
    <title>Öğrenciler</title>
  </head>
<body>

<p class="mb-5 mt-5"><span style="font-size: 30px;">Öğrenciler (En çok onaylanan cevabı veren)</span></p>  

<table class="table table-striped table-light">
<p style="text-align: right; width: 1400px; margin: 0px auto 20px auto;">Değiştir: <a href="ogrenciler.php">En çok soru soran</a> - <a href="ogrenciler-onaylanancevap.php">En çok onaylanan cevabı veren</a></p>
<thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Kullanıcı ismi</th>
      <th scope="col">Ad-Soyad</th>
      <th scope="col">Onaylanan cevap</th>
      <th scope="col">Toplam cevap</th>
      <th scope="col">Toplam soru</th>
      <th scope="col">Kullanıcıyı Sil</th>
    </tr>
  </thead>
  <tbody>

    <?php

        $no_of_records_per_page = 10;

        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
            $gecilen_sayfa = $pageno - 1;
            $sirano = $gecilen_sayfa * $no_of_records_per_page;
            $siralama = $sirano;
        } else {
            $pageno = 1;
            $siralama = 0;
        }

    

        $offset = ($pageno-1) * $no_of_records_per_page;

        $total_pages_sql = "SELECT COUNT(*) FROM uyeler";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM uyeler ORDER BY toplamcevap DESC LIMIT $offset, $no_of_records_per_page";
        $res_data = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($res_data)){
            $uye_id = $row['uye_id'];
            $kadi = $row['kadi'];
            $isim = $row['isim'];
            $onaylanan_cevap = $row['toplamcevap'];
            $toplamcevap = $row['tumcevap'];
            $toplam_soru = $row['toplamsoru'];
            $siralama = $siralama + 1;
?>


    <tr>
      <th scope="row"><?php echo $siralama; ?></th>
      <td><?php echo $kadi; ?></td>
      <td><?php echo $isim; ?></td>
      <td><?php echo $onaylanan_cevap; ?></td>
      <td><?php echo $toplamcevap; ?></td>
      <td><?php echo $toplam_soru; ?></td>
      <td><a class="btn btn-danger" href="kullanici_sil.php?kadi=<?php echo $kadi; ?>">Kullanıcıyı Sil</a></td>
    </tr>
    














<?php
        }
        mysqli_close($conn);
    ?>





</tbody>







</table>







<div style="margin-bottom: 30px; margin-top: 10px;">
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


<a class="mt-5" href="admin_paneli.php"><button type="button" class="btn btn-light">Geri Dön</button></a>
<br><br>




</body>
</html>

<?php
}else{
    
   yonlendir("../admin.php?hata=Lütfen Oturum Açın");

}
?>