<?php
session_start();

include 'config.php';



$tarih = date("YmdHis");
$randomsayi = rand(10000, 99999);

$resim_ismi = "$tarih"."$randomsayi";


if (isset($_SESSION["kullanici"],$_POST["baslik"])) {


  $baslik = $_POST["baslik"];
  $kadi = $_SESSION["kullanici"];



        $file_name = $_FILES["image_file"]["name"];
        $file_type = $_FILES["image_file"]["type"];
        $temp_name = $_FILES["image_file"]["tmp_name"];
        $file_size = $_FILES["image_file"]["size"];
        $error = $_FILES["image_file"]["error"];
        if (!$temp_name)
        {
            echo "HATA: Lütfen Dosyayı seçiniz";
            exit();
        }
        function compress_image($source_url, $destination_url, $quality)
        {
            $info = getimagesize($source_url);
            if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
            elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
            elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
            imagejpeg($image, $destination_url, $quality);

        }
        if ($error > 0)
        {
            echo $error;
        }
        else if (($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "image/pjpeg"))
        {

            

            if($file_type == "image/jpeg"){
                $tur = ".jpeg";
            }else if($file_type == "image/png"){
                $tur = ".png";
            }else{
                $tur = ".jpg";
            }






            $filename = compress_image($temp_name,"soru_resimleri/".$resim_ismi.$tur, 60);
        }

        else
        {
            echo "Yüklediğiniz dosya PNG veya JPEG türünde olmalıdır.";
        }
   







$yol = 'soru_resimleri/'.$resim_ismi.$tur;



































if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip_adresi = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip_adresi = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip_adresi = $_SERVER['REMOTE_ADDR'];
}









$sql = "INSERT INTO sorular (baslik, soran, soru_resim, soran_ip) VALUES ('$baslik', '$kadi', '$yol', '$ip_adresi')";


if ($conn->query($sql) === TRUE) {




    $sql = "UPDATE uyeler SET toplamsoru = toplamsoru + 1 WHERE kadi = '$kadi' ";
    $conn->query($sql);


  yonlendir("index.php");




} else {
  yonlendir("hata.php?hata=Beklenmedik bir hata meydana geldi!");
}


} else {  
    yonlendir("sorusor.php");
}

mysqli_close($conn);
?>


