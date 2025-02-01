<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori=$id");

?>
<script>
    alert('Hapus data berhasil');
    location.href = "index.php?page=kategori";
</script>