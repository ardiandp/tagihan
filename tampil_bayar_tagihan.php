<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pembayaran Tagihan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Daftar Pembayaran Tagihan</h2>
        <div class="table-responsive">
            <a href="input-tagihan.html" class="btn btn-primary mb-3">Input Tagihan</a>
            <table id="tagihanTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>No. Tagihan</th>
                        <th>Periode</th>
                        <th>Tanggal Bayar</th>
                        <th>Jumlah</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Database connection
                  
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT no_tagihan, periode, tgl_bayar, jumlah, bukti FROM bayar_tagihan";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["no_tagihan"] . "</td>";
                            echo "<td>" . $row["periode"] . "</td>";
                            echo "<td>" . $row["tgl_bayar"] . "</td>";
                            echo "<td>" . $row["jumlah"] . "</td>";
                            echo "<td><img src='data:image/jpeg;base64," . $row["bukti"] . "' style='max-width: 100px; max-height: 100px;' /></td>";
                            echo "<td><a href='detail_bayar_tagihan.php?no_tagihan=" . $row["no_tagihan"] . "' class='btn btn-primary'>detail</a> 
                            <a href='hapus-bayar-tagihan/" . $row["no_tagihan"] . ".html' class='btn btn-danger'>hapus</a></td>";

                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#tagihanTable').DataTable();
        });
    </script>
</body>
</html>
