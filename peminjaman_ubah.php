<?php
if (!isset($_SESSION['user']['id_user'])) {
    echo '<script>alert("Anda belum login!"); window.location.href="login.php";</script>';
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id == 0) {
    echo '<script>alert("ID tidak valid."); window.location.href="?page=peminjaman";</script>';
    exit;
}

if (isset($_POST['submit'])) {
    $id_buku = $_POST['id_buku'];
    $id_user = $_SESSION['user']['id_user'];
    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
    $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
    $status_peminjaman = $_POST['status_peminjaman'];

    $stmt = mysqli_prepare($koneksi, "UPDATE peminjaman SET id_buku=?, tanggal_peminjaman=?, tanggal_pengembalian=?, status_peminjaman=? WHERE id_peminjaman=?");
    mysqli_stmt_bind_param($stmt, "isssi", $id_buku, $tanggal_peminjaman, $tanggal_pengembalian, $status_peminjaman, $id);
    $query = mysqli_stmt_execute($stmt);

    if ($query) {
        echo '<script>alert("Ubah data berhasil."); window.location.href="?page=peminjaman";</script>';
    } else {
        echo '<script>alert("Ubah data gagal.");</script>';
    }
}

$query = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE id_peminjaman=$id");
$data = mysqli_fetch_array($query);
?>

<h1 class="mt-4">Peminjaman Buku</h1>
<div class="card">
    <div class="card-body">
        <form method="post">
            <div class="row mb-3">
                <div class="col-md-2">Buku</div>
                <div class="col-md-8">
                    <select name="id_buku" class="form-control" required>
                        <option value="">-- Pilih Buku --</option>
                        <?php
                        $buk = mysqli_query($koneksi, "SELECT * FROM buku");
                        while ($buku = mysqli_fetch_array($buk)) {
                            $selected = ($buku['id_buku'] == $data['id_buku']) ? 'selected' : '';
                            echo '<option value="' . $buku['id_buku'] . '" ' . $selected . '>' . htmlspecialchars($buku['judul']) . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-2">Tanggal Peminjaman</div>
                <div class="col-md-8">
                   <input type="date" class="form-control" value="<?php echo $data['tanggal_peminjaman']; ?>" name="tanggal_peminjaman">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-2">Tanggal Pengembalian</div>
                <div class="col-md-8">
                   <input type="date" class="form-control" value="<?php echo $data['tanggal_pengembalian']; ?>" name="tanggal_pengembalian">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-2">Status Peminjaman</div>
                <div class="col-md-8">
                  <select name="status_peminjaman" class="form-control">
                      <option value="dipinjam" <?php if($data['status_peminjaman'] == 'dipinjam') echo 'selected'; ?>>Dipinjam</option>
                      <option value="dikembalikan" <?php if($data['status_peminjaman'] == 'dikembalikan') echo 'selected'; ?>>Dikembalikan</option>
                  </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <a href="?page=peminjaman" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
