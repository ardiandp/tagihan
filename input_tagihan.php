
    <div class="container mt-5">
        <h2 class="mb-4">Form Inputan</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="no_tagihan">Nomor Tagihan</label>
                <input type="text" class="form-control" id="no_tagihan" name="no_tagihan" placeholder="Masukkan Nomor Tagihan" required>
            </div>
            <div class="form-group">
                <label for="periode">Periode</label>
                <input type="month" class="form-control" id="periode" name="periode" required>
            </div>
            <div class="form-group">
                <label for="tgl_bayar">Tanggal Bayar</label>
                <input type="date" class="form-control" id="tgl_bayar" name="tgl_bayar" required>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah" required>
            </div>
            <div class="form-group">
                <label for="file">Unggah Gambar</label>
                <input type="file" class="form-control-file" id="file" name="file" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
            $no_tagihan = htmlspecialchars($_POST['no_tagihan']);
            $periode = htmlspecialchars($_POST['periode']);
            $tgl_bayar = htmlspecialchars($_POST['tgl_bayar']);
            $jumlah = htmlspecialchars($_POST['jumlah']);

            if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['file']['tmp_name'];
                $fileType = mime_content_type($fileTmpPath);
                $fileData = file_get_contents($fileTmpPath);
                $base64 = 'data:' . $fileType . ';base64,' . base64_encode($fileData);

              

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "INSERT INTO bayar_tagihan (no_tagihan, periode, tgl_bayar, jumlah, bukti) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssds", $no_tagihan, $periode, $tgl_bayar, $jumlah, $base64);

                if ($stmt->execute()) {
                  echo "<script>alert('data tersimpan');document.location.href='tampil-bayar-tagihan.html'</script>";
                }
                else {
                  echo "<script>alert('data gagal tersimpan')</script>";
                }

                $stmt->close();
                $conn->close();
            } 
        }
        ?>
    </div>

