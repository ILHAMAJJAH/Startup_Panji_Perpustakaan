<h1 class="mt-4">Ulasan Buku</h1>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <form method="post">
                    <?php
                    // Validasi ID ulasan dari URL
                    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
                        echo '<script>alert("ID ulasan tidak valid!"); window.location.href="?page=ulasan";</script>';
                        exit;
                    }

                    $id = (int) $_GET['id'];

                    // Mengambil data ulasan berdasarkan ID
                    $query = mysqli_query($koneksi, "SELECT * FROM ulasan WHERE id_ulasan = $id");
                    $data = mysqli_fetch_array($query);

                    if (!$data) {
                        echo '<script>alert("Data tidak ditemukan!"); window.location.href="?page=ulasan";</script>';
                        exit;
                    }

                    if (isset($_POST['submit'])) {
                        $id_buku = mysqli_real_escape_string($koneksi, $_POST['id_buku']);
                        $ulasan = mysqli_real_escape_string($koneksi, $_POST['ulasan']);
                        $rating = (int) $_POST['rating']; // Pastikan rating berupa angka

                        $update = mysqli_query($koneksi, "UPDATE ulasan SET id_buku='$id_buku', ulasan='$ulasan', rating='$rating' WHERE id_ulasan=$id");

                        if ($update) {
                            echo '<script>alert("Ubah data berhasil."); window.location.href="?page=ulasan";</script>';
                        } else {
                            echo '<script>alert("Ubah data gagal.");</script>';
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
                                while ($buku = mysqli_fetch_array($buk)) {
                                    $selected = ($data['id_buku'] == $buku['id_buku']) ? 'selected' : '';
                                    echo '<option value="' . $buku['id_buku'] . '" ' . $selected . '>' . htmlspecialchars($buku['judul']) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2">Ulasan</div>
                        <div class="col-md-8">
                            <textarea name="ulasan" rows="5" class="form-control" required><?= htmlspecialchars($data['ulasan']); ?></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2">Rating</div>
                        <div class="col-md-8">
                            <select name="rating" class="form-control" required>
                                <?php
                                for ($i = 1; $i <= 10; $i++) {
                                    $selected = ($data['rating'] == $i) ? 'selected' : '';
                                    echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary" name="submit" value="submit">Simpan</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <a href="?page=ulasan" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
