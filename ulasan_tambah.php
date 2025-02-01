<h1 class="mt-4">Ulasan Buku</h1>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <form method="post">
                    <?php
                    if(isset($_POST['submit'])) {
                        $id_buku = mysqli_real_escape_string($koneksi, $_POST['id_buku']);
                        $id_user = $_SESSION['user']['id_user'];
                        $ulasan = mysqli_real_escape_string($koneksi, $_POST['ulasan']);
                        $rating = (int) $_POST['rating']; // Pastikan rating berupa angka

                        $query = mysqli_query($koneksi, "INSERT INTO ulasan (id_buku, id_user, ulasan, rating) VALUES ('$id_buku', '$id_user', '$ulasan', '$rating')");

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
                        <div class="col-md-2">Ulasan</div>
                        <div class="col-md-8">
                            <textarea name="ulasan" rows="5" class="form-control" required></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2">Rating</div>
                        <div class="col-md-8">
                            <select name="rating" class="form-control" required>
                                <?php for ($i = 1; $i <= 10; $i++) { ?>
                                    <option value="<?= $i; ?>"><?= $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary" name="submit" value="submit">Simpan</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <a href="?page=buku" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
