<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <title>Pembaruan Data Siswa Bimbel</title>

    <style>
        body {
            background-color: #e0f7fa;
            font-family: 'Arial', sans-serif;
        }

        h2 {
            margin-top: 20px;
            color: #004d40;
            text-transform: uppercase;
            font-weight: bold;
            text-align: center;
        }

        .container {
            margin-top: 20px;
            max-width: 800px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            color: #004d40;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        textarea {
            border: 1px solid #00796b;
            padding: 10px;
            border-radius: 4px;
            background-color: #e0f2f1;
        }

        .btn-primary {
            background-color: #00796b;
            margin-top: 20px;
            margin-left: 20px;
        }

        .btn-primary:hover {
            background-color: #004d40;
            border-color: #004d40;
        }

        input[type="radio"] + label {
            margin-right: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Tambahkan foto header -->
        <img src="https://assets-a1.kompasiana.com/items/album/2019/12/17/img-20180426-wa0055-5df809d2d541df0ebe4b79d2.jpg" alt="Header Bimbel" style="width: 100%; height: auto; border-radius: 8px;">
        <br>

        <?php
        include "koneksi.php";
        // Fungsi untuk membersihkan input data
        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // Cek apakah ada nilai yang dikirim menggunakan method GET dengan nama id_peserta
        if (isset($_GET['id_peserta'])) {
            $id_peserta = input($_GET["id_peserta"]);
            $sql = "SELECT * FROM peserta WHERE id_peserta='$id_peserta'";
            $hasil = mysqli_query($kon, $sql);
            $data = mysqli_fetch_assoc($hasil);
        }

        // Cek apakah ada kiriman form dari method POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id_peserta = input($_POST["id_peserta"]);
            $nama = input($_POST["nama"]);
            $nama_orang_tua = input($_POST["nama_orang_tua"]);
            $nomor_orang_tua = input($_POST["nomor_orang_tua"]);
            $jenis_kelamin = input($_POST["jenis_kelamin"]);
            $tanggal_lahir = input($_POST["tanggal_lahir"]);
            $email = input($_POST["email"]);
            $sekolah = input($_POST["sekolah"]);
            $no_hp = input($_POST["no_hp"]);
            $provinsi = input($_POST["provinsi"]);
            $kabupaten = input($_POST["kabupaten"]);
            $kecamatan = input($_POST["kecamatan"]);
            $desa = input($_POST["desa"]);
            $paket_kelas = input($_POST["paket_kelas"]);
            $tingkat_pendidikan = input($_POST["tingkat_pendidikan"]);
            $kelas = input($_POST["kelas"]);

            // Query untuk memperbarui data peserta
            $sql = "UPDATE peserta SET 
                        nama = '$nama',
                        nama_orang_tua = '$nama_orang_tua',
                        nomor_orang_tua = '$nomor_orang_tua',
                        jenis_kelamin = '$jenis_kelamin',
                        tanggal_lahir = '$tanggal_lahir',
                        email = '$email',
                        sekolah = '$sekolah',
                        no_hp = '$no_hp',
                        provinsi = '$provinsi',
                        kabupaten = '$kabupaten',
                        kecamatan = '$kecamatan',
                        desa = '$desa',
                        paket_kelas = '$paket_kelas',
                        tingkat_pendidikan = '$tingkat_pendidikan',
                        kelas = '$kelas'
                    WHERE id_peserta = '$id_peserta'";

            // Menjalankan query
            $hasil = mysqli_query($kon, $sql);

            // Cek apakah berhasil atau tidak dalam mengeksekusi query
            if ($hasil) {
                header("Location: index.php");
                exit;
            } else {
                echo '<div class="alert alert-danger">Data gagal disimpan.</div>';
            }
        }

        ?>

        <h2>Update Data Peserta Bimbel</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="id_peserta" value="<?php echo $data['id_peserta']; ?>">

            <!-- Input nama siswa -->
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" value="<?php echo $data['nama']; ?>" required>
            </div>

            <!-- Input jenis kelamin -->
            <div class="form-group">
                <label>Jenis Kelamin:</label><br>
                <input type="radio" id="laki_laki" name="jenis_kelamin" value="Laki-laki" <?php echo ($data['jenis_kelamin'] == 'Laki-laki') ? 'checked' : ''; ?> required>
                <label for="laki_laki">Laki-laki</label>
                <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan" <?php echo ($data['jenis_kelamin'] == 'Perempuan') ? 'checked' : ''; ?> required>
                <label for="perempuan">Perempuan</label>
            </div>

            <!-- Input tanggal lahir -->
            <div class="form-group">
                <label>Tanggal Lahir:</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo $data['tanggal_lahir']; ?>" required>
            </div>

            <!-- Input email -->
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" placeholder="Masukan Email" value="<?php echo $data['email']; ?>" required>
            </div>

            <!-- Input sekolah -->
            <div class="form-group">
                <label>Sekolah:</label>
                <input type="text" name="sekolah" class="form-control" placeholder="Masukan Nama Sekolah" value="<?php echo $data['sekolah']; ?>" required>
            </div>

            <!-- Input nomor telepon siswa -->
            <div class="form-group">
                <label>No HP:</label>
                <input type="text" name="no_hp" class="form-control" placeholder="Masukan No HP" value="<?php echo $data['no_hp']; ?>" required>
            </div>

             <!-- Input nama orang tua -->
            <div class="form-group">
                <label>Nama Orang Tua:</label>
                <input type="text" name="nama_orang_tua" class="form-control" placeholder="Masukan Nama Orang Tua" value="<?php echo $data['nama_orang_tua']; ?>" required>
            </div>

            <!-- Input nomor telepon orang tua -->
            <div class="form-group">
                <label>Nomor Orang Tua:</label>
                <input type="text" name="nomor_orang_tua" class="form-control" placeholder="Masukan Nomor Orang Tua" value="<?php echo $data['nomor_orang_tua']; ?>" required>
            </div>

            <!-- Input alamat yang dipecah -->
            <div class="form-group">
                <label>Provinsi:</label>
                <input type="text" name="provinsi" class="form-control" placeholder="Masukan Provinsi" value="<?php echo $data['provinsi']; ?>" required>
            </div>

            <div class="form-group">
                <label>Kabupaten:</label>
                <input type="text" name="kabupaten" class="form-control" placeholder="Masukan Kabupaten" value="<?php echo $data['kabupaten']; ?>" required>
            </div>

            <div class="form-group">
                <label>Kecamatan:</label>
                <input type="text" name="kecamatan" class="form-control" placeholder="Masukan Kecamatan" value="<?php echo $data['kecamatan']; ?>" required>
            </div>

            <div class="form-group">
                <label>Desa:</label>
                <input type="text" name="desa" class="form-control" placeholder="Masukan Desa" value="<?php echo $data['desa']; ?>" required>
            </div>

            <!-- Input paket kelas -->
            <div class="form-group">
                <label>Paket Kelas:</label><br>
                <input type="radio" id="intensif" name="paket_kelas" value="Intensif" <?php echo ($data['paket_kelas'] == 'Intensif') ? 'checked' : ''; ?> required>
                <label for="intensif">Intensif</label>
                <input type="radio" id="eksklusif" name="paket_kelas" value="Eksklusif" <?php echo ($data['paket_kelas'] == 'Eksklusif') ? 'checked' : ''; ?> required>
                <label for="eksklusif">Eksklusif</label>
                <input type="radio" id="reguler" name="paket_kelas" value="Reguler" <?php echo ($data['paket_kelas'] == 'Reguler') ? 'checked' : ''; ?> required>
                <label for="reguler">Reguler</label>
            </div>

            <!-- Input tingkat pendidikan -->
            <div class="form-group">
                <label>Tingkat Pendidikan:</label><br>
                <input type="radio" id="sd" name="tingkat_pendidikan" value="SD" <?php echo ($data['tingkat_pendidikan'] == 'SD') ? 'checked' : ''; ?> required>
                <label for="sd">SD</label>
                <input type="radio" id="smp" name="tingkat_pendidikan" value="SMP" <?php echo ($data['tingkat_pendidikan'] == 'SMP') ? 'checked' : ''; ?> required>
                <label for="smp">SMP</label>
                <input type="radio" id="sma" name="tingkat_pendidikan" value="SMA" <?php echo ($data['tingkat_pendidikan'] == 'SMA') ? 'checked' : ''; ?> required>
                <label for="sma">SMA</label>
            </div>

            <!-- Input kelas -->
            <div class="form-group" id="kelas-group">
                <label>Kelas:</label><br>
                <!-- Kelas akan ditampilkan berdasarkan tingkat pendidikan yang dipilih -->
            </div>

            <!-- Tombol submit -->
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </form>

        <!-- JavaScript untuk mengatur pilihan kelas berdasarkan tingkat pendidikan -->
        <script>
            // Fungsi untuk menampilkan opsi kelas berdasarkan tingkat pendidikan
            function displayKelasOptions(value) {
                const kelasGroup = document.getElementById('kelas-group');
                kelasGroup.innerHTML = ''; // Kosongkan kelas-group sebelum menambahkan opsi baru

                let kelasOptions = '';

                if (value === 'SD') {
                    kelasOptions = `
                        <input type="radio" id="kelas1" name="kelas" value="Kelas 1" required>
                        <label for="kelas1">Kelas 1</label><br>
                        <input type="radio" id="kelas2" name="kelas" value="Kelas 2" required>
                        <label for="kelas2">Kelas 2</label><br>
                        <input type="radio" id="kelas3" name="kelas" value="Kelas 3" required>
                        <label for="kelas3">Kelas 3</label><br>
                        <input type="radio" id="kelas4" name="kelas" value="Kelas 4" required>
                        <label for="kelas4">Kelas 4</label><br>
                        <input type="radio" id="kelas5" name="kelas" value="Kelas 5" required>
                        <label for="kelas5">Kelas 5</label><br>
                        <input type="radio" id="kelas6" name="kelas" value="Kelas 6" required>
                        <label for="kelas6">Kelas 6</label>
                    `;
                } else if (value === 'SMP') {
                    kelasOptions = `
                        <input type="radio" id="kelas7" name="kelas" value="Kelas 7" required>
                        <label for="kelas7">Kelas 7</label><br>
                        <input type="radio" id="kelas8" name="kelas" value="Kelas 8" required>
                        <label for="kelas8">Kelas 8</label><br>
                        <input type="radio" id="kelas9" name="kelas" value="Kelas 9" required>
                        <label for="kelas9">Kelas 9</label>
                    `;
                }

                kelasGroup.innerHTML = kelasOptions; // Tambahkan opsi kelas ke dalam kelas-group
            }

            // Tambahkan pendengar acara perubahan pada input radio tingkat pendidikan
            const tingkatPendidikanRadios = document.querySelectorAll('input[name="tingkat_pendidikan"]');
            tingkatPendidikanRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    displayKelasOptions(this.value);
                });
            });

            // Fungsi untuk mengatur jurusan IPA dan IPS jika tingkat pendidikan SMA dipilih
            function displayJurusanOptions() {
                const kelasGroup = document.getElementById('kelas-group');
                kelasGroup.innerHTML = ''; // Kosongkan kelas-group sebelum menambahkan opsi baru

                let kelasOptions = `
                    <input type="radio" id="ipa" name="jurusan_sma" value="IPA" required>
                    <label for="ipa">IPA</label><br>
                    <input type="radio" id="ips" name="jurusan_sma" value="IPS" required>
                    <label for="ips">IPS</label><br>
                    <div id="kelas-sma-group"></div>
                `;

                kelasGroup.innerHTML = kelasOptions;

                const jurusanRadios = document.querySelectorAll('input[name="jurusan_sma"]');
                const kelasSmaGroup = document.getElementById('kelas-sma-group');

                jurusanRadios.forEach(radio => {
                    radio.addEventListener('change', function() {
                        kelasSmaGroup.innerHTML = ''; // Kosongkan kelas-sma-group sebelum menambahkan opsi baru

                        let kelasSmaOptions = '';

                        if (this.value === 'IPA') {
                            kelasSmaOptions = `
                                <input type="radio" id="kelas10_ipa" name="kelas" value="Kelas 10 IPA" required>
                                <label for="kelas10_ipa">Kelas 10 IPA</label><br>
                                <input type="radio" id="kelas11_ipa" name="kelas" value="Kelas 11 IPA" required>
                                <label for="kelas11_ipa">Kelas 11 IPA</label><br>
                                <input type="radio" id="kelas12_ipa" name="kelas" value="Kelas 12 IPA" required>
                                <label for="kelas12_ipa">Kelas 12 IPA</label>
                            `;
                        } else if (this.value === 'IPS') {
                            kelasSmaOptions = `
                                <input type="radio" id="kelas10_ips" name="kelas" value="Kelas 10 IPS" required>
                                <label for="kelas10_ips">Kelas 10 IPS</label><br>
                                <input type="radio" id="kelas11_ips" name="kelas" value="Kelas 11 IPS" required>
                                <label for="kelas11_ips">Kelas 11 IPS</label><br>
                                <input type="radio" id="kelas12_ips" name="kelas" value="Kelas 12 IPS" required>
                                <label for="kelas12_ips">Kelas 12 IPS</label>
                            `;
                        }

                        kelasSmaGroup.innerHTML = kelasSmaOptions;
                    });
                });
            }

            // Tambahkan pendengar acara perubahan pada input radio tingkat pendidikan
            document.querySelectorAll('input[name="tingkat_pendidikan"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    const value = this.value;
                    if (value === 'SMA') {
                        displayJurusanOptions();
                    } else {
                        displayKelasOptions(value);
                    }
                });
            });

            // Set nilai default saat halaman pertama kali dimuat
            window.onload = function() {
                document.querySelector(`input[name="tingkat_pendidikan"][value="${data['tingkat_pendidikan']}"]`).checked = true;
                tingkatPendidikanRadios.forEach(radio => {
                    if (radio.checked) {
                        radio.dispatchEvent(new Event('change'));
                    }
                });
                if (data['tingkat_pendidikan'] === 'SMA') {
                    document.querySelector(`input[name="jurusan_sma"][value="${data['jurusan']}"]`).checked = true;
                    document.querySelector(`input[name="jurusan_sma"][value="${data['jurusan']}"]`).dispatchEvent(new Event('change'));
                }
            };
        </script>
    </div>
</body>

</html>
