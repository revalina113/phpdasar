<?php
session_start();

if(!isset($_SESSION["login"])) {
   header("location: login.php");
   exit;

}
require 'functions.php';

//pagination
//konfigurasi
$jumlahDataPerhalaman = 2;
$jumlahdata = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahdata / $jumlahDataPerhalaman);
$halamanaktif = ( isset($_GET["halaman"])) ? $_GET["halaman"] :1;
$awaldata = ($jumlahDataPerhalaman * $halamanaktif) -$jumlahDataPerhalaman;
   


$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awaldata,$jumlahDataPerhalaman");

// tombol cari ditekan
if( isset($_POST["cari"]) ) {
  $mahasiswa = cari($_POST["keyword"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>halaman Admin</title>
</head>
<body>

<a href="logout.php">logout</a>

    <h1>Daftar Mahasiswa</h1>

    <a href="tambah.php">tambah data mahasiswa</a>
    <br><br>

    <form action="" method="post">

      <input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword pencarian..." autocomplete="off">
      <button type="submit" name="cari">Cari!</button>

    </form>
<br><br>
<!-- navigasi -->

<?php if($halamanaktif > 1) :?>
<a href="?halaman=<?= $halamanaktif -1; ?>">&laquo;</a>
<?php endif; ?>

<?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
  <?php if($i == $halamanaktif): ?>
       <a href="?halaman=<?= $i ?> "style="font_weight:bold; color : red; ><?= $i; ?></a>
  <?php else : ?>
           <a href="?halaman=<?= $i ?>"><?= $i; ?></a>
    <?php endif; ?>
<?php endfor; ?>

<?php if($halamanaktif < $jumlahHalaman ) :?>
<a href="?halaman=<?= $halamanaktif +1; ?>">&raquo;</a>
<?php endif; ?>



    <br>
    <table border="1" cellpadding="10" cellspacing="0">

    <tr>
      <th>No</th>
      <th>Aksi</th>
      <th>Gambar</th>
      <th>NRP</th>
      <th>Nama</th>
      <th>Email</th>
      <th>Jurusan</th>
    
        
</tr>
<?php $i = 1;  ?>
<?php foreach( $mahasiswa as $row ): ?>
    <tr>
      <td><?= $i; ?></td>     
    <td>
           <a href="ubah.php?id=<?= $row["id"];?>">ubah</a>
           <a href="hapus.php?id=<?= $row ["id"]; ?>" onclick="return confirm('yakin?');">hapus</a>
    </td>
     <td><img src="img/<?= $row ["gambar"]; ?>" width="50"></td>
     <td><?= $row["nrp"]; ?></td>
     <td><?= $row["nama"]; ?></td>
     <td><?= $row["email"]; ?></td>
     <td><?= $row["jurusan"]; ?></td>

    </tr>
  <?php $i++; ?>
  <?php endforeach; ?>

</table>

</body>
</html>
