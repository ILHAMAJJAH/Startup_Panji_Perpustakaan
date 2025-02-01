<h1 class="mt-4">Peminjaman Buku</h1>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <form method="post">
                    <?php
                    if(isset($_POST['submit'])) {
                        $id_buku =  $_POST['id_buku'];
                        $id_user = $_SESSION['user']['id_user'];
                        $tanggal_peminjaman =  $_POST['tanggal_peminjaman'];
                        $tanggal_pengembalian = $_POST['tanggal_pengembalian']; 
                        $status_peminjaman = $_POST['status_peminjaman'];

                        $query = mysqli_query($koneksi, "INSERT INTO peminjaman (id_buku, id_user, tanggal_peminjaman, tanggal_pengembalian, status_peminjaman) VALUES ('$id_buku', '$id_user', '$tanggal_peminjaman', '$tanggal_pengembalian', '$status_peminjaman')");

                        if($query) {
                            echo '<script>alert("Tambah data berhasil.");</script>';
                        } else {
                            echo '<script>alert("Tambah data gagal.");</script>';
                        }
                    }
                    ?>
                    
                    <div class="row mb-3">
                        <div class="col-md-2">Buku</div>
                        <div class="col-md-8">
                            <select name="id_buku" class="form-control" required>
                                <option value="">-- Pilih Buku --</option>
                                <?php
                                $buk = mysqli_query($koneksi, "SELECT * FROM buku");
                                while($buku = mysqli_fetch_array($buk)) {
                                    echo '<option value="' . $buku['id_buku'] . '">' . htmlspecialchars($buku['judul']) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2">Tanggal Peminjaman</div>
                        <div class="col-md-8">
                           <input type="date" class="form-control" name="tanggal_peminjaman">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2">Tanggal Pengembalian</div>
                        <div class="col-md-8">
                           <input type="date" class="form-control" name="tanggal_pengembalian">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2">Status Peminjaman</div>
                        <div class="col-md-8">
                          <select name="status_peminjaman" class="form-control">
                          <option value="dipinjam">Dipinjam</option>
                          <option value="dikembalikan">Dikembalikan</option>
                          </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary" name="submit" value="submit">Simpan</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <a href="?page=peminjaman" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
