<?php
 
 $id = $_GET['id_penjualan'];
 $sql = $koneksi->query("delete from penjualan where id_penjualan = '$id'");

 if ($sql) {
 
 ?>
 
	<script type="text/javascript">
	alert("Data Berhasil Dihapus");
	window.location.href="?page=penjualan";
	</script>
	
 <?php
 
 }
 
 ?>