<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['secure'])) {
	header('Location: https://secure.login.dsgroupmedia.com');
	exit;
}
include('library.php');
$lib = new Library();

if(isset($_POST['tombol_tambah'] ) && $_COOKIE["logged-in"] == "admin"){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $hargajual = $_POST['hargajual'];
    $hargabeli = $_POST['hargabeli'];
    $stok = $_POST['stok'];

    $add_status = $lib->add_data($kode,$nama,$kategori,$hargajual,$hargabeli,$stok);
    if($add_status){
    header('Location: index.php');
    }
	$data_siswa = $lib->show();
}
if(isset($_GET['hapus_barang']) && $_COOKIE["logged-in"] == "admin"){
    $kode = $_GET['hapus_barang'];
    $status_hapus = $lib->delete($kode);
    if($status_hapus)
    {
        header('Location: index.php');
    }

}
?>
<?php
//Menggabungkan dengan file koneksi yang telah kita buat
include 'koneksi.php';
?>
<?php 
$username = "userdb"; 
$password = "passdb"; 
$database = "dbname"; 
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
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="icon" href="dk.png">
	<title>Input Barang - PD Muliasari</title>
	<!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
</head>
<body>

<nav class="navbar navbar-dark bg-primary">
	  <a class="navbar-brand" href="index.php" style="color: #fff;">
	    PD Mulia Sari
	  </a>
	  
	  <input type="submit" name="sign_in" class="btn" value="Logout" onClick="logout();">
	</nav>
<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Are you sure?');
}
</script>
	<div class="container">
		<h2 align="center" style="margin: 30px;">Input Barang</h2>
        <hr>
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
                    <label for="hargabeli" class="col-sm-2 col-form-label">Harga Beli</label>
                    <div class="col-sm-10">
                    <input type="number" value="0" name="hargabeli" class="form-control" id="hargabeli">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10">
                    <input type="number" value="100" name="stok" class="form-control" id="stok">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hargabeli" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                    <input type="submit" name="tombol_tambah" class="btn btn-primary" value="Tambah">
                    </div>
                </div>
            </form>
			</hr>
<!-- FORM----------------------------->
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <td>No</td>
			<td>Kode</td>
            <td>Nama</td>
            <td>Kategori</td>
            <td>Harga Jual</td>
            <td>Harga Beli</td>
            <td>Stock</td>
            <td>Action</td>
        </tr>
    </thead>
               <tbody>
                    <?php 
            include 'koneksi.php';
            $no = 1;
            $query = "SELECT * FROM barang ORDER BY no";
            $dewan1 = $db1->prepare($query);
            $dewan1->execute();
            $res1 = $dewan1->get_result();
 
            if ($res1->num_rows > 0) {
                while ($row = $res1->fetch_assoc()) {
                    {
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".$row['kode']."</td>";
                        echo "<td>".$row['nama']."</td>";
                        echo "<td>".$row['kategori']."</td>";
                        echo "<td>".$row['hargajual']."</td>";
                        echo "<td>".$row['hargabeli']."</td>";
                        echo "<td>".$row['sisa']."</td>";
                        echo "<td><a class='btn btn-info' href='form_edit.php?kode=".$row['kode']."'>Update</a>
                        <a name='hapus' onclick='return checkDelete()' class='btn btn-danger' href='index.php?hapus_barang=".$row['kode']."'>Hapus</a></td>";
                        echo "</tr>";
                        $no++;
                    }
                    ?>
					        <?php } } else { ?> 
            <tr>
                <td colspan='7'>Tidak ada data ditemukan</td>
            </tr>
        <?php } ?>
    </tbody>
	</table>		
    </div>


    <div class="text-center">© <?php echo date('Y'); ?> Copyright:
	    <a href="https://dsgroupmedia.com/"> DS Media Group Systems, Inc</a>
	</div>
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- DataTable -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
	function logout()
	{
		window.location.href = "securelogout.php";
	}
</script>
</body>
</html>