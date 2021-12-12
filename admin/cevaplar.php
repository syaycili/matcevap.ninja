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
    <title>Cevaplar</title>
  </head>
  <body>

  <h3 class="mb-5 mt-5">Verilen son 100 cevap</h3>

  <table style="color: white;" class="table">
  <thead>
    <tr>

      <th scope="col">ID</th>
      <th scope="col">Çözüm İçerik</th>
      <th scope="col">Oluşturan Kullanıcı</th>
      <th scope="col">Çözüm Linki</th>
      <th scope="col">Soru ID</th>
      <th scope="col">Cevap Sil</th>

    </tr>
  </thead>
  <tbody>









<?php 

$sql = "SELECT * FROM cozumler ORDER BY cozum_id DESC LIMIT 100";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {?>



<tr>

    <td><?php echo $row["cozum_id"]; ?></td>
    <td><?php echo $row["cozum"]; ?></td>
    <td><?php echo $row["cozum_kullanici"]; ?></td>
    <td><?php echo $row["cozum_link"]; ?></td>
    <td><?php echo $row["soru_id"]; ?></td>
    <td><a class="btn btn-danger" href="cevap_sil.php?cozum_id=<?php echo $row["cozum_id"]; ?>&soru_id=<?php echo $row["soru_id"]; ?>&cozum_kullanici=<?php echo $row["cozum_kullanici"]; ?>">Sil</a></td>
    </tr>

   

<?php }
} else {
  echo "Hiç Sonuç Bulunamadı"."<br>"."<br>";
}
?>

  </tbody>
</table>
<br><br>
<a class="mt-5" href="admin_paneli.php"><button type="button" class="btn btn-light">Geri Dön</button></a>


<style>
        td{
            max-width: 100px;
    overflow:hidden;
    white-space:nowrap;
    text-overflow:ellipsis;
        }
        </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  </body>
</html>



<?php
}else{
    
   yonlendir("../admin.php?hata=Lütfen Oturum Açın");

}
?>