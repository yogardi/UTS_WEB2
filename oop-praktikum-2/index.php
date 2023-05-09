<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Data Mahasiswa</title>
</head>
<body>
<?php

require_once "app/mhsw.php";
$mhsw = new mhsw();
$rows = $mhsw->tampil();

if(isset($_GET["cari"])){
    $rows = $mhsw->cari($_GET["email"]);
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
if(isset($_GET['nim'])) $vnim =$_GET['nim'];
else $vnim ='';
if(isset($_GET['nama'])) $vnama =$_GET['nama'];
else $vnama ='';
if(isset($_GET['tahun'])) $vtahun =$_GET['tahun'];
else $vtahun ='';
if(isset($_GET['email'])) $vemail =$_GET['email'];
else $vemail ='';

if($vsimpan=='simpan' && ($vnim <>''||$vnama <>''||$vtahun <>''||$vemail <>'')){
    $mhsw->simpan();
    $rows = $mhsw->tampil();
    $vid ='';
    $vnim ='';
    $vnama ='';
    $vtahun ='';
    $vemail ='';
}

if($vaksi=="hapus")  {
    $mhsw->hapus();
    $rows = $mhsw->tampil();
}
if($vaksi=="cari")  {
    $rows = $mhsw->cari();
}

 if($vaksi=="lihat_update")  {
    $urows = $mhsw->tampil_update();
    foreach ($urows as $row) {
        $vid = $row['mhsw_id'];
        $vnim = $row['mhsw_nim'];
        $vnama = $row['mhsw_nama'];
        $vtahun = $row['mhsw_tahun'];
        $vemail = $row['mhsw_email'];
    }
 }

if ($vupdate=="update"){
    $mhsw->update($vid,$vnim,$vnama,$vtahun,$vemail);
    $rows = $mhsw->tampil();
    $vid ='';
    $vnim ='';
    $vnama ='';
    $vtahun ='';
    $vemail ='';
}
if ($vreset=="reset"){
    $vid ='';
    $vnim ='';
    $vnama ='';
    $vtahun ='';
    $vemail ='';
}


?>

<form action="?" method="get">
<table cellspacing="20">
    <tr><td>NIM</td><td>:</td><td>
        <input type="hidden" name="id" value="<?php echo $vid; ?>" /><input type="text" name="nim" value="<?php echo $vnim; ?>" /></td></tr>
    <tr><td>NAMA</td><td>:</td><td><input type="text" name="nama" value="<?php echo $vnama; ?>"/></td></tr>
     <tr><td>TAHUN</td><td>:</td><td><input type="text" name="tahun" value="<?php echo $vtahun; ?>"/></td></tr>
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
        <th>NIM</th>
        <th>NAMA</th>
        <th>TAHUN</th>
        <th>EMAIL</th>
        <th>AKSI</th>
    </tr>

    <?php foreach ($rows as $row) { ?>
        <tr>
            <td><?php echo $row['mhsw_id']; ?></td>
            <td><?php echo $row['mhsw_nim']; ?></td>
            <td><?php echo $row['mhsw_nama']; ?></td>
            <td><?php echo $row['mhsw_tahun']; ?></td>
            <td><?php echo $row['mhsw_email']; ?></td>
            <td><a href="?mhsw_id=<?php echo $row['mhsw_id']; ?>&aksi=hapus">Hapus</a>&nbsp;&nbsp;&nbsp;
                <a href="?mhsw_id=<?php echo $row['mhsw_id']; ?>&aksi=lihat_update">Update</a>
                <a href="jurusan.php?id_mhsw=<?php echo $row['id_mhsw']; ?>">Jurusan</a>
                &nbsp;&nbsp;&nbsp;</td>

        </tr>
    <?php } ?>
 </table>
</body>
</html>