<?php 
include('library.php');
$lib = new Library();
if(isset($_GET['kode'])){
    $kode = $_GET['kode']; 
    $data_barang = $lib->get_by_id($kode);
}
else
{
    header('Location: index.php');
}

if(isset($_POST['tombol_update'])){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $hargajual = $_POST['hargajual']; 
    $hargabeli = $_POST['hargabeli'];
    $stok = $_POST['stok'];
    $status_update = $lib->update($kode,$nama,$kategori,$hargajual,$hargabeli,$stok);
    if($status_update)
    {
        header('Location:index.php');
    }
}
?>

<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Update Data Barang</h3>
            </div>
            <div class="card-body">
            <form method="post" action="">
                <input type="hidden" name="kode" value="<?php echo $data_barang['kode']; ?>"/>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" id="nama" value="<?php echo $data_barang['nama']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                    <input type="text" value="<?php echo $data_barang['kategori']; ?>" name="kategori" class="form-control" id="kategori">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hargajual" class="col-sm-2 col-form-label">Harga Jual</label>
                    <div class="col-sm-10">
                    <input type="number"  class="form-control" name="hargajual" id="hargajual" value="<?php echo $data_barang['hargajual']; ?>">
                    </div>
                </div>
				<div class="form-group row">
                    <label for="hargabeli" class="col-sm-2 col-form-label">Harga Beli</label>
                    <div class="col-sm-10">
                    <input type="number" class="form-control" name="hargabeli" id="hargabeli" value="<?php echo $data_barang['hargabeli']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10">
                    <input type="number" class="form-control" name="stok" id="stok" value="<?php echo $data_barang['sisa']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hargajual" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                    <input type="submit" name="tombol_update" class="btn btn-primary" value="Update">
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    </body>
</html>