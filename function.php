<?php
try {  $baglanti=new PDO("mysql:host=localhost;dbname=pdodersler;charset=utf8","root","");
$baglanti->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
        die($exception->getMessage());
   // echo "Connection failed: " . $exception->getMessage();
}

class uye  {

   function ekle ($baglanti){
       @$buton=$_POST["buton"];

      if(@$buton):
          $ad=htmlspecialchars($_POST["ad"]);
          $soyad=htmlspecialchars($_POST["soyad"]);
          $yas=htmlspecialchars($_POST["yas"]);
          $aidat=htmlspecialchars($_POST["aidat"]);

      $data=$baglanti->prepare("insert into users (ad,soyad,yas,aidat) VALUES ('$ad','$soyad',$yas,$aidat)");
      $data->execute();
          echo '<tr>
            <td colspan="6" class="alert-success" style="text-align: center">Uye EKLENDi</td>
                  </tr>';
          header("refresh:2, url=index.php");
      else:
          echo '
       <table class="table table-bordered table-striped text-center bg-white"> <!--  TUM basliq-->

                <thead>  <!--  tabel basliq-->
                <tr>
                    <th colspan="6">+ Uye ekle</th>
                </tr>
                </thead>
                <tbody> <!--  tabel altliq-->
                <tr>
                <td colspan="6">
                <form action="index.php?hareket=ekle" method="post">
                   <input type="text" name="ad" class="form-control mx-auto col-md-3 mt-2" placeholder="Adiniz yaziniz...">
                   <input type="text" name="soyad" class="form-control mx-auto col-md-3 mt-2"  placeholder="Soyadiniz yaziniz...">
                   <input type="text" name="yas" class="form-control mx-auto col-md-3 mt-2"  placeholder="Yasinizi yaziniz...">
                   <input type="text" name="aidat" class="form-control mx-auto col-md-3 mt-2"  placeholder="Aidat yaziniz..."><br>
                   <input type="submit" name="buton" class="btn btn-success" value="+ Ekle">
                </form> 
                </td>
                </tr> 
                </tbody>
            </table>
      ';

      endif;


   }

   function  uyeguncelle($baglanti){

       @$uyeid=$_GET["uyeid"];

       if(@$uyeid):
           $cikti=$baglanti->prepare("select * from users where id=$uyeid");
           $cikti->execute();
           $cikti2=$cikti->fetch(PDO::FETCH_ASSOC);

           echo '
       <table class="table table-bordered table-striped text-center bg-white"> <!--  TUM basliq-->

                <thead>  <!--  tabel basliq-->
                <tr>
                    <th colspan="6">Guncelleme</th>
                </tr>
                </thead>
                <tbody> <!--  tabel altliq-->
                <tr>
                <td colspan="6">
                <form action="index.php?hareket=uyeguncelle&id='.$cikti2["id"].'" method="post">
                   <input type="text" name="ad" class="form-control mx-auto col-md-3 mt-2" value="'.$cikti2["ad"].'">
                   <input type="text" name="soyad" class="form-control mx-auto col-md-3 mt-2" value="'.$cikti2["soyad"].'"  >
                   <input type="text" name="yas" class="form-control mx-auto col-md-3 mt-2" value="'.$cikti2["yas"].'" >
                   <input type="text" name="aidat" class="form-control mx-auto col-md-3 mt-2" value="'.$cikti2["aidat"].'" ><br>
                   <input type="submit" name="buton" class="btn btn-success" value="Guncelle">
                </form> 
                </td>
                </tr> 
                </tbody>
            </table>
      ';
       else:
           @$buton=$_POST["buton"];

           if(@$buton):
           $id=$_GET["id"];
           $ad=htmlspecialchars($_POST["ad"]);
           $soyad=htmlspecialchars($_POST["soyad"]);
           $yas=htmlspecialchars($_POST["yas"]);
           $aidat=htmlspecialchars($_POST["aidat"]);

$data=$baglanti->prepare("update users set ad='$ad',soyad='$soyad',yas=$yas,aidat=$aidat where id=$id");
$data->execute();
           echo '<tr>
            <td colspan="6" class="alert-success" style="text-align: center">Guncelledni</td>
                  </tr>';
           header("refresh:2, url=index.php");
           endif;
       endif;


   }

  function uyesil ($baglanti){

        if (@$_GET["uyeid"]):
            @$id=$_GET["uyeid"];

            $data=$baglanti->prepare("delete from users where id=$id");
            $data->execute();
            echo '<tr>
            <td colspan="6" class="alert-danger" style="text-align: center">Uye Silindi</td>
                  </tr>';

        else:
            echo "Silmede Bir hata olusdu";
        endif;
        header("refresh:2, url=index.php");

    }

  function listele ($baglanti){
      $data=$baglanti->prepare("select * from users");
      $data->execute();
      while ($cikti=$data->fetch(PDO::FETCH_ASSOC)):
          echo '    <tr>
                    <td>'.$cikti["ad"].'</td>
                    <td>'.$cikti["soyad"].'</td>
                    <td>'.$cikti["yas"].'</td>
                    <td>'.$cikti["aidat"].'</td>
                    <td><a href="index.php?hareket=uyeguncelle&uyeid='.$cikti["id"].'" class="btn btn-warning">Güncelle</a></td>
                    <td><a href="index.php?hareket=uyesil&uyeid='.$cikti["id"].'" class="btn btn-danger">Sil</a></td>
                </tr>';
      endwhile;

  }
}




?>