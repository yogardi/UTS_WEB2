<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Data Dosen</title>
</head>
<body>
<?php

require_once "app/Mhsw.php";
$dosen = new dosen();
$rows = $dosen->tampil();

if(isset($_GET["cari"])){
    $rows = $dosen->cari($_GET["email"]);
}

if(isset($_GET['simpan'])) $vsimpan =$_GET['simpan'];
else $vsimpan ='';
if(isset($_GET['update'])) $vupdate =$_GET['update'];
else $vupdate ='';
if(isset($_GET['reset'])) $vreset =$_GET['reset'];
else $vreset ='';
if(isset($_GET['aksi'])) $vaksi =$_GET['aksi'];
else $vaksi ='';
if(isset($_GET['id'])) $vid =$_GET['id'];
else $vid ='';
if(isset($_GET['nip'])) $vnip =$_GET['nip'];
else $vnip ='';
if(isset($_GET['nama'])) $vnama =$_GET['nama'];
else $vnama ='';
if(isset($_GET['email'])) $vemail =$_GET['email'];
else $vemail ='';

if($vsimpan=='simpan' && ($vnip <>''||$vnama <>''||$vemail <>'')){
    $dosen->simpan();
    $rows = $dosen->tampil();
    $vid ='';
    $vnip ='';
    $vnama ='';
    $vemail ='';
}

if($vaksi=="hapus")  {
    $dosen->hapus();
    $rows = $dosen->tampil();
}
if($vaksi=="cari")  {
    $rows = $dosen->cari();
}

 if($vaksi=="lihat_update")  {
    $urows = $dosen->tampil_update();
    foreach ($urows as $row) {
        $vid = $row['dosen_id'];
        $vnip = $row['dosen_nip'];
        $vnama = $row['dosen_nama'];
        $vemail = $row['dosen_email'];
    }
 }

if ($vupdate=="update"){
    $dosen->update($vid,$vnip,$vnama,$vemail);
    $rows = $dosen->tampil();
    $vid ='';
    $vnip ='';
    $vnama ='';
    $vemail ='';
}
if ($vreset=="reset"){
    $vid ='';
    $vnip ='';
    $vnama ='';
    $vemail ='';
}


?>

<form action="?" method="get">
<table cellspacing="20">
    <tr><td>NIP</td><td>:</td><td>
        <input type="hidden" name="id" value="<?php echo $vid; ?>" /><input type="text" name="nip" value="<?php echo $vnip; ?>" /></td></tr>
    <tr><td>NAMA</td><td>:</td><td><input type="text" name="nama" value="<?php echo $vnama; ?>"/></td></tr>
    <tr><td>EMAIL</td><td>:</td><td><input type="text" autocomplete="off" name="email" value="<?php echo $vemail; ?>"/></td></tr>
    <tr><td></td><td></td><td>
    <input type="submit" name='simpan' value="simpan"/>
    <input type="submit" name='update' value="update"/>
    <input type="submit" name='reset' value="reset"/>
    <input type="submit" name='cari' value="cari"/>
    </td></tr>
</table>
</form>

    <table border="1" cellpadding="10" cellspacing="0" style="text-align:center">
    <tr>
        <th>NO</th>
        <th>NIP</th>
        <th>NAMA</th>
        <th>EMAIL</th>
        <th>AKSI</th>
    </tr>

    <?php foreach ($rows as $row) { ?>
        <tr>
            <td><?php echo $row['dosen_id']; ?></td>
            <td><?php echo $row['dosen_nip']; ?></td>
            <td><?php echo $row['dosen_nama']; ?></td>
            <td><?php echo $row['dosen_email']; ?></td>
            <td><a href="?dosen_id=<?php echo $row['dosen_id']; ?>&aksi=hapus">Hapus</a>&nbsp;&nbsp;&nbsp;
                <a href="?dosen_id=<?php echo $row['dosen_id']; ?>&aksi=lihat_update">Update</a>
                <a href="prodidosen.php?id_dosen=<?php echo $row['dosen_id']; ?>">Prodi</a>
                &nbsp;&nbsp;&nbsp;</td>

        </tr>
    <?php } ?>
 </table>
</body>
</html>