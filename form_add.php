<?php 
include('library.php');
$lib = new Library();

if(isset($_POST['tombol_tambah'])){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $hargajual = $_POST['hargajual'];
    $hargabeli = $_POST['hargabeli'];

    $add_status = $lib->add_data($kode,$nama,$kategori,$hargajual,$hargabeli);
    if($add_status){
    header('Location: index.php');
    }
}
?>
<?php
//Menggabungkan dengan file koneksi yang telah kita buat
include 'koneksi.php';
?>
<?php 
$username = "dsgroupm"; 
$password = "1Yqb4Tba02"; 
$database = "dsgroupm_inven"; 
$mysqli = new mysqli("localhost", $username, $password, $database); 
$query = "SELECT * FROM code";
 
if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $code = $row["code"];

}
} 
?>
 <?php
  $query = "SELECT * FROM kategori";
  $result = mysqli_query($db1, $query);
 ?>
<html>
    <head>
        <title></title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Tambah Data Barang</h3>
            </div>
            <div class="card-body">
            <form method="post" action="">
                <div class="form-group row">
                    <label for="kode" class="col-sm-2 col-form-label">Kode</label>
                    <div class="col-sm-10">
                    <input type="text" name="kode" class="form-control" id="kode" value="<?php echo $code ?>">
                    </div>
                </div>
				<div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" id="nama">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
					<select class="form-control" name="kategori" id="kategori">
					<?php while($data = mysqli_fetch_assoc($result) ){?>
					<option value="<?php echo $data['kode']; ?>"><?php echo $data['nama']; ?></option>
					<?php } ?>
					</select>
                    </div>
					
                </div>
                <div class="form-group row">
                    <label for="hargajual" class="col-sm-2 col-form-label">Harga Jual</label>
                    <div class="col-sm-10">
					<input type="number" value="0" name="hargajual" class="form-control" id="hargajual">
                    </div>
                </div>
				<div class="form-group row">
                    <label for="hargabeli" class="col-sm-2 col-form-label">hargabeli</label>
                    <div class="col-sm-10">
                    <input type="number" value="0" name="hargabeli" class="form-control" id="hargabeli">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hargabeli" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                    <input type="submit" name="tombol_tambah" class="btn btn-primary" value="Tambah">
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    </body>
</html>