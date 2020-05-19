<?php
class Library
{
    public function __construct()
    {
        $host = "localhost";
        $dbname = "dbname";
        $username = "userdb";
        $password = "passdb";
        $this->db = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
    }
    public function add_data($kode,$nama,$kategori,$hargajual,$hargabeli,$sisa)
    {
		$code = $this->db->prepare('UPDATE code set code = code+1 where id=1');
        $data = $this->db->prepare('INSERT INTO barang (kode,nama,kategori,hargabeli,hargajual,sisa) VALUES (?, ?, ?, ?, ?, ?)');
        
        $data->bindParam(1, $kode);
        $data->bindParam(2, $nama);
        $data->bindParam(3, $kategori);
        $data->bindParam(4, $hargabeli);
        $data->bindParam(5, $hargajual);
        $data->bindParam(6, $sisa);

        $data->execute();
        $code->execute();
        return $code->rowCount();
    }
    public function show()
    {
        $query = $this->db->prepare("SELECT * FROM barang");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function get_by_id($kode){
        $query = $this->db->prepare("SELECT * FROM barang where kode=?");
        $query->bindParam(1, $kode);
        $query->execute();
        return $query->fetch();
    }
	    public function get_by_cd($kode){
        $query = $this->db->prepare("SELECT * FROM code where id=?");
        $query->bindParam(1, $kode);
        $query->execute();
        return $query->fetch();
    }

    public function update($kode,$nama,$kategori,$hargajual,$hargabeli){
        $query = $this->db->prepare('UPDATE barang set nama=?,kategori=?,hargajual=?,hargabeli=? where kode=?');
        
        $query->bindParam(1, $nama);
        $query->bindParam(2, $kategori);
        $query->bindParam(3, $hargajual);
        $query->bindParam(4, $hargabeli);
        $query->bindParam(5, $kode);

        $query->execute();
        return $query->rowCount();
    }

    public function delete($kode)
    {
		$code = $this->db->prepare('UPDATE code set code = code-1 where id=1');
        $query = $this->db->prepare("DELETE FROM barang where kode=?");
        $query->bindParam(1, $kode);
        $query->execute();
		$code->execute();
        return $query->rowCount();
    }

}
?>