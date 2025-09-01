<?php
 
 $id = $_GET['kodebarang'];
 $sql = $koneksi->query("delete from persediaan where kode_barang = '$id'");

 if ($sql) {
 
 ?>
 
	<script type="text/javascript">
	alert("Data Berhasil Dihapus");
	window.location.href="?page=persediaan";
	</script>
	
 <?php
 
 }else{?>
	
	<script type="text/javascript">
	alert("Silahkan Periksa Data Kembali!");
	window.location.href="?page=persediaan";
	</script>
	
 <?php }?>
 
 ?>