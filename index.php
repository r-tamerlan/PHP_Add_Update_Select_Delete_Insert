<?php include("function.php"); $uye=new uye();  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/boost.css" >
    <link rel="icon" type="image/png" href="img/logo.png">
    <title>PDO ÜYELİK SİSTEMİ</title>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-6 mx-auto mt-4" >
<?php

            @$hareket=$_GET["hareket"];

            switch ($hareket):

                case "uyesil":
                    $uye->uyesil($baglanti);
                    break;

                case "uyeguncelle":
                    $uye->uyeguncelle($baglanti);
                    break;

                case "ekle":
                    $uye->ekle($baglanti);
                    break;
                default:
?>
            <table class="table table-bordered table-striped text-center bg-white"> <!--  TUM basliq-->

                <thead>  <!--  tabel basliq-->
                <tr>
                    <th colspan="6"><a href="index.php?hareket=ekle" class="btn btn-success">+ Uye ekle</a></th>
                </tr>
                </thead>

            </table>

            <table class="table table-bordered table-striped text-center bg-white"> <!--  TUM basliq-->

               <thead>  <!--  tabel basliq-->
                <tr>
                    <th class="font-weight-bold">AD</th>
                    <th class="font-weight-bold">SOYAD</th>
                    <th class="font-weight-bold">YAŞ</th>
                    <th class="font-weight-bold">MAAŞ</th>
                    <th class="font-weight-bold">GÜNCELLE</th>
                    <th class="font-weight-bold">SİL</th>
                </tr>
                </thead>

                <tbody> <!--  tabel altliq-->
                   <?php $uye->listele($baglanti); ?>
                </tbody>

            </table>
                <?php
            endswitch;

?>

        </div>

    </div>

</div>
</body>
</html>