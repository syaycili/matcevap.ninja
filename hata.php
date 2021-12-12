<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Hata</title>
</head>
<body>



<?php 
if(isset($_GET['hata'])){
 $hata = $_GET['hata'];
}else{
 $hata = 'Beklenmedik bir hata meydana gelid!';
}
?>
    
    <div class="kutu">
    <h1>Hata</h1>
    <p><?php echo $hata;?></p>
    <a href="index.php">Anasayfaya dön</a>





    </div>

<style>
body{
    font-family: sans-serif;
}
.kutu{
    width: 500px;
    margin: auto;
    text-align: center;
}

</style>
</body>
</html>