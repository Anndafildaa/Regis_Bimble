<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* Warna latar belakang dan font */
        body {
            background-color: #e0f2f1;
            font-family: 'Arial', sans-serif;
        }

        /* Gaya untuk elemen navbar */
        .navbar {
            background-color: #00796b; /* Warna hijau tua */
        }

        /* Warna teks dan heading */
        h4, .navbar-brand {
            color: #004d40;
            font-weight: bold; /* Ubah teks menjadi tebal */

        }

        /* Warna tombol */
        .btn-primary {
            background-color: #00796b; /* Warna hijau tua */
            border-color: #00796b;
            margin-top: 20px;
        }

        .btn-primary:hover {
            background-color: #004d40; /* Warna hijau yang lebih gelap */
            border-color: #004d40;
        }

        /* Warna tabel */
        table thead {
            background-color: #004d40; /* Warna hijau tua */
            color: #004d40; /* Warna putih untuk teks */
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #ced4da;
        }

        table td {
            background-color: #e0f2f1; /* Warna hijau muda */
        }

        table tr:nth-child(odd) td {
            background-color: #b2dfdb; /* Warna hijau muda gelap */
        }

       /* Tombol Tambah Data */
.btn-primary {
    background-color: #2ecc71;
    border-color: #27ae60;
    margin-top: 30px;
    margin-left: 50px; 
}



        .btn-primary:hover {
            background-color: #004d40;
            border-color: #2ecc71;
        }

        /* Gaya untuk tabel kumpulan data */
        table {
            width: 100%; /* Lebar penuh sesuai dengan kontainer */
            margin-left: 0; /* Geser tabel ke kiri */
            text-align: left; /* Posisikan teks tabel ke kiri */
            margin-left: 50px;
        }

        /* Gaya untuk elemen konten lainnya */
        .container {
            margin-left: 0; /* Geser konten lainnya ke kiri */
            padding: 0; /* Hapus padding untuk memastikan elemen di sisi kiri */

        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark">
        <span class="navbar-brand mb-0 h1">Daftar peserta Bimble</span>
    </nav>

    <!-- Konten -->
    <div class="container mt-4">
        <?php
        include "koneksi.php";

        // Hapus data jika ada permintaan untuk menghapus peserta berdasarkan id_peserta
        if (isset($_GET['id_peserta'])) {
            $id_peserta = htmlspecialchars($_GET['id_peserta']);

            // Validasi id_peserta
            if (!is_numeric($id_peserta)) {
                echo "<div class='alert alert-danger'>Invalid request.</div>";
                exit;
            }

            // Minta konfirmasi sebelum menghapus data
            echo "<script>
            if (confirm('Are you sure you want to delete this record?')) {
                location.href = 'index.php?confirm_delete=true&id_peserta=$id_peserta';
            }
            </script>";

            // Konfirmasi penghapusan
            if (isset($_GET['confirm_delete']) && $_GET['confirm_delete'] === 'true') {
                // Gunakan prepared statement untuk mencegah SQL injection
                $stmt = $kon->prepare("DELETE FROM peserta WHERE id_peserta = ?");
                $stmt->bind_param("i", $id_peserta);

                // Eksekusi statement
                if ($stmt->execute()) {
                    header("Location: index.php");
                    exit;
                } else {
                    echo "<div class='alert alert-danger'>Data gagal dihapus.</div>";
                }

                // Tutup statement
                $stmt->close();
            }
        }

        // Query untuk mengambil data peserta
        $sql = "SELECT * FROM peserta ORDER BY id_peserta ASC";
        $hasil = mysqli_query($kon, $sql);
        $no = 0;

        echo "<table class='my-3 table table-bordered'>
            <thead class='table-primary'>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Email</th>
                    <th>Sekolah</th>
                    <th>No HP</th>
                    <th>Nama Orang Tua</th>
                    <th>Nomor Orang Tua</th>
                    <th>Provinsi</th>
                    <th>Kabupaten</th>
                    <th>Kecamatan</th>
                    <th>Desa</th>
                    <th>Paket Kelas</th>
                    <th>Tingkat Pendidikan</th>
                    <th>Kelas</th>
                    <th colspan='2'>Aksi</th>
                </tr>
            </thead>
            <tbody>";

        // Looping untuk menampilkan data peserta
        while ($data = mysqli_fetch_array($hasil)) {
            $no++;
            echo "<tr>
                    <td>$no</td>
                    <td>" . htmlspecialchars($data['nama']) . "</td>
                    <td>" . htmlspecialchars($data['jenis_kelamin']) . "</td>
                    <td>" . htmlspecialchars($data['tanggal_lahir']) . "</td>
                    <td>" . htmlspecialchars($data['email']) . "</td>
                    <td>" . htmlspecialchars($data['sekolah']) . "</td>
                    <td>" . htmlspecialchars($data['no_hp']) . "</td>
                    <td>" . htmlspecialchars($data['nama_orang_tua']) . "</td>
                    <td>" . htmlspecialchars($data['nomor_orang_tua']) . "</td>
                    <td>" . htmlspecialchars($data['provinsi']) . "</td>
                    <td>" . htmlspecialchars($data['kabupaten']) . "</td>
                    <td>" . htmlspecialchars($data['kecamatan']) . "</td>
                    <td>" . htmlspecialchars($data['desa']) . "</td>
                    <td>" . htmlspecialchars($data['paket_kelas']) . "</td>
                    <td>" . htmlspecialchars($data['tingkat_pendidikan']) . "</td>
                    <td>" . htmlspecialchars($data['kelas']) . "</td>
                    <td>
                        <a href='update.php?id_peserta=" . htmlspecialchars($data['id_peserta']) . "' class='btn btn-warning'>
                            <i class='fas fa-edit'></i> Ubah
                        </a>
                        <a href='index.php?id_peserta=" . htmlspecialchars($data['id_peserta']) . "' class='btn btn-danger'>
                            <i class='fas fa-trash-alt'></i> Hapus
                        </a>
                    </td>
                </tr>";
        }

        echo "</tbody></table>";

        ?>
        <a href="create.php" class="btn btn-primary">Tambah Data</a>
    </div>
</body>

</html>
