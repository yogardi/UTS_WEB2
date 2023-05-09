<?php
    abstract  class Peserta {
        abstract protected function tampil();
    }
 class mhsw extends Peserta {
 private $db;
 public function __construct()
     {
   try {
 $this->db = new PDO("mysql:host=localhost;dbname=dbyoga", "root", ""); } catch (PDOException $e) { die ("Error " . $e->getMessage());
        }
    }
    public function tampil()
    {
        $sql = "SELECT * FROM mahasiswa";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $data = [];
        while ($rows = $stmt->fetch()) {
            $data[] = $rows;
            }
        return $data;
    }

    public function simpan()
    {
        $sql = "insert into mahasiswa values ('','".$_GET['nim']."','".$_GET['nama']."','".$_GET['email']."')";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        echo "DATA BERHASIL DISIMPAN !";
    } 

    public function hapus()
    {
        $sqls = "delete from mahasiswa where mhsw_id='".$_GET['mhsw_id']."'";
        $stmts = $this->db->prepare($sqls);
        $stmts->execute();
        echo "DATA BERHASIL DIHAPUS !";
    }      
    public function tampil_update()
    {
        $sql = "SELECT * FROM mahasiswa where mhsw_id='".$_GET['mhsw_id']."'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $data = [];
        while ($rows = $stmt->fetch()) {
            $data[] = $rows;
            }
        return $data;
    }
    public function update($id, $nim,$nama,$tahun,$email)
    {
        $sql = "update mahasiswa set mhsw_nim='".$nim."', mhsw_nama='".$nama."', mhsw_tahun='".$tahun."', mhsw_email='".$email."' where mhsw_id='".$id."'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        echo "DATA BERHASIL DIUPDATE !";
    } 
    public function cari($email){
        $sql = "SELECT * FROM mahasiswa WHERE mhsw_email LIKE '%".$email."%'
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $data = [];
        while ($rows = $stmt->fetch()) {
            $data[] = $rows;
            }
        return $data;
    }  

 }

 class dosen extends Peserta {
    private $db;
    public function __construct()
        {
      try {
    $this->db = new PDO("mysql:host=localhost;dbname=dbyoga", "root", ""); } catch (PDOException $e) { die ("Error " . $e->getMessage());
           }
       }
       public function tampil()
       {
           $sql = "SELECT * FROM dosen";
           $stmt = $this->db->prepare($sql);
           $stmt->execute();
           $data = [];
           while ($rows = $stmt->fetch()) {
               $data[] = $rows;
               }
           return $data;
       }
   
       public function simpan()
       {
           $sql = "insert into dosen values ('','".$_GET['nip']."','".$_GET['nama']."','".$_GET['email']."')";
           $stmt = $this->db->prepare($sql);
           $stmt->execute();
           echo "DATA BERHASIL DISIMPAN !";
       } 
   
       public function hapus()
       {
           $sqls = "delete from dosen where dosen_id='".$_GET['dosen_id']."'";
           $stmts = $this->db->prepare($sqls);
           $stmts->execute();
           echo "DATA BERHASIL DIHAPUS !";
       }      
       public function tampil_update()
       {
           $sql = "SELECT * FROM dosen where dosen_id='".$_GET['dosen_id']."'";
           $stmt = $this->db->prepare($sql);
           $stmt->execute();
           $data = [];
           while ($rows = $stmt->fetch()) {
               $data[] = $rows;
               }
           return $data;
       }
       public function update($id,$nip,$nama,$email)
       {
           $sql = "update dosen set dosen_nip='".$nip."', dosen_nama='".$nama."', dosen_email='".$email."' where dosen_id='".$id."'";
           $stmt = $this->db->prepare($sql);
           $stmt->execute();
           echo "DATA BERHASIL DIUPDATE !";
       } 
       public function cari($email){
           $sql = "SELECT * FROM dosen WHERE dosen_email LIKE '%".$email."%'
           ";
           $stmt = $this->db->prepare($sql);
           $stmt->execute();
           $data = [];
           while ($rows = $stmt->fetch()) {
               $data[] = $rows;
               }
           return $data;
       }  
   
    }

 class jurusan extends Peserta {
 private $db;
 public function __construct()
     {
   try {
 $this->db = new PDO("mysql:host=localhost;dbname=dbyoga", "root", ""); } catch (PDOException $e) { die ("Error " . $e->getMessage());
        }
    }
    public function tampil()
    {
        $sql = "SELECT * FROM jurusan where id_mahasiswa ='".$_GET['id_mhsw']."'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $data = [];
        while ($rows = $stmt->fetch()) {
            $data[] = $rows;
            }
        return $data;
    }

    public function tampildosen()
    {
        $sql = "SELECT * FROM jurusan where id_dosen ='".$_GET['id_dosen']."'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $data = [];
        while ($rows = $stmt->fetch()) {
            $data[] = $rows;
            }
        return $data;
    }

    public function simpan()
    {
        $sql = "insert into jurusan values ('','".$_GET['jurusan']."','".$_GET['id']."',null)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        echo "DATA BERHASIL DISIMPAN !";
    } 
    public function simpandosen()
    {
        $sql = "insert into mahasiswa values ('','".$_GET['jurusan']."',null,'".$_GET['id']."')";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        echo "DATA BERHASIL DISIMPAN !";
    } 

    public function hapus()
    {
        $sqls = "delete from mahasiswa where id='".$_GET['id']."'";
        $stmts = $this->db->prepare($sqls);
        $stmts->execute();
        echo "DATA BERHASIL DIHAPUS !";
    }      
    public function tampil_update()
    {
        $sql = "SELECT * FROM mahasiswa where mhsw_id='".$_GET['id']."'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $data = [];
        while ($rows = $stmt->fetch()) {
            $data[] = $rows;
            }
        return $data;
    }
    public function update($jurusan, $id)
    {
        $sql = "update jurusan set jurusan='".$jurusan."' where id='".$id."'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        echo "DATA BERHASIL DIUPDATE !";
    } 
    public function cari($email){
        $sql = "SELECT * FROM mahasiswa WHERE mhsw_email LIKE '%".$email."%'
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $data = [];
        while ($rows = $stmt->fetch()) {
            $data[] = $rows;
            }
        return $data;
    }  

 }