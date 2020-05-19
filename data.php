<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <td>No</td>
			<td>Kode</td>
            <td>Nama</td>
            <td>Kategori</td>
            <td>Harga Jual</td>
            <td>Harga Beli</td>
            <td>Action</td>
        </tr>
    </thead>
               <tbody>
                    <?php 
            include 'koneksi.php';
            $no = 1;
            $query = "SELECT * FROM barang ORDER BY kode DESC";
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
                        echo "<td><a class='btn btn-info' href='form_edit.php?kode=".$row['kode']."'>Update</a>
                        <a onclick='return checkDelete()' class='btn btn-danger' href='index.php?hapus_barang=".$row['kode']."'>Hapus</a></td>";
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
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>