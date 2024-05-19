<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <title>Formulir Pendaftaran Siswa Bimbel</title>

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
        <h2>Formulir Pendaftaran Peserta Bimbel</h2>

        <?php
        include "koneksi.php";

        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

            $sql = "INSERT INTO peserta (nama, nama_orang_tua, nomor_orang_tua, jenis_kelamin, tanggal_lahir, email, sekolah, no_hp, provinsi, kabupaten, kecamatan, desa, paket_kelas, tingkat_pendidikan, kelas)
                    VALUES ('$nama', '$nama_orang_tua', '$nomor_orang_tua', '$jenis_kelamin', '$tanggal_lahir', '$email', '$sekolah', '$no_hp', '$provinsi', '$kabupaten', '$kecamatan', '$desa', '$paket_kelas', '$tingkat_pendidikan', '$kelas')";

            try {
                $hasil = mysqli_query($kon, $sql);

                if ($hasil) {
                    header("Location: index.php");
                    exit;
                } else {
                    echo '<div class="alert alert-danger">Data gagal disimpan.</div>';
                }
            } catch (mysqli_sql_exception $e) {
                echo '<div class="alert alert-danger">Terjadi kesalahan: ' . $e->getMessage() . '</div>';
            }
        }
        ?>

        <h2>Input Data Peserta</h2>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required>
            </div>

            <div class="form-group">
                <label>Jenis Kelamin:</label><br>
                <input type="radio" id="laki_laki" name="jenis_kelamin" value="Laki-laki" required>
                <label for="laki_laki">Laki-laki</label>
                <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan" required>
                <label for="perempuan">Perempuan</label>
            </div>

            <div class="form-group">
                <label>Tanggal Lahir:</label>
                <input type="date" name="tanggal_lahir" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" placeholder="Masukan Email" required>
            </div>

            <div class="form-group">
                <label>Sekolah:</label>
                <input type="text" name="sekolah" class="form-control" placeholder="Masukan Nama Sekolah" required>
            </div>

            <div class="form-group">
                <label>No HP:</label>
                <input type="text" name="no_hp" class="form-control" placeholder="Masukan No HP" required>
            </div>

            <div class="form-group">
                <label>Nama Orang Tua:</label>
                <input type="text" name="nama_orang_tua" class="form-control" placeholder="Masukan Nama Orang Tua" required>
            </div>

            <div class="form-group">
                <label>Nomor Orang Tua:</label>
                <input type="text" name="nomor_orang_tua" class="form-control" placeholder="Masukan Nomor Orang Tua" required>
            </div>

            <div class="form-group">
                <label>Provinsi:</label>
                <input type="text" name="provinsi" class="form-control" placeholder="Masukan Provinsi" required>
            </div>

            <div class="form-group">
                <label>Kabupaten:</label>
                <input type="text" name="kabupaten" class="form-control" placeholder="Masukan Kabupaten" required>
            </div>

            <div class="form-group">
                <label>Kecamatan:</label>
                <input type="text" name="kecamatan" class="form-control" placeholder="Masukan Kecamatan" required>
            </div>

            <div class="form-group">
                <label>Desa:</label>
                <input type="text" name="desa" class="form-control" placeholder="Masukan Desa" required>
            </div>

            <div class="form-group">
                <label>Paket Kelas:</label><br>
                <input type="radio" id="intensif" name="paket_kelas" value="Intensif" required>
                <label for="intensif">Intensif</label>
                <input type="radio" id="eksklusif" name="paket_kelas" value="Eksklusif" required>
                <label for="eksklusif">Eksklusif</label>
                <input type="radio" id="reguler" name="paket_kelas" value="Reguler" required>
                <label for="reguler">Reguler</label>
            </div>

            <div class="form-group">
                <label>Tingkat Pendidikan:</label><br>
                <input type="radio" id="sd" name="tingkat_pendidikan" value="SD" required>
                <label for="sd">SD</label>
                <input type="radio" id="smp" name="tingkat_pendidikan" value="SMP" required>
                <label for="smp">SMP</label>
                <input type="radio" id="sma" name="tingkat_pendidikan" value="SMA" required>
                <label for="sma">SMA</label>
            </div>

            <div class="form-group" id="kelas-group">
                <label>Kelas:</label><br>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>

        <script>
            function displayKelasOptions(value) {
                const kelasGroup = document.getElementById('kelas-group');
                kelasGroup.innerHTML = ''; 

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

                kelasGroup.innerHTML = kelasOptions; 
            }

            const tingkatPendidikanRadios = document.querySelectorAll('input[name="tingkat_pendidikan"]');
            tingkatPendidikanRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    displayKelasOptions(this.value);
                });
            });

            const tingkatPendidikanRadiosSMA = document.querySelectorAll('input[name="tingkat_pendidikan"][value="SMA"]');
            tingkatPendidikanRadiosSMA.forEach(radio => {
                radio.addEventListener('change', function() {
                    const kelasGroup = document.getElementById('kelas-group');
                    kelasGroup.innerHTML = ''; 

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
                            kelasSmaGroup.innerHTML = ''; 

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
                });
            });
        </script>
    </div>
</body>

</html>
