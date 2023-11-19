
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function hitungGajiBersih($golongan, $jamKerja) {
        $gajiPokok = 0;

        // Ketentuan gaji pokok
        switch ($golongan) {
            case 'A':
                $gajiPokok = 2000000;
                break;
            case 'B':
                $gajiPokok = 1500000;
                break;
            case 'C':
                $gajiPokok = 1000000;
                break;
            case 'D':
                $gajiPokok = 700000;
                break;
            default:
                echo "Golongan tidak valid";
                return;
        }

        // Menghitung jam lembur
        $jamNormal = 173;
        $jamLembur = max($jamKerja - $jamNormal, 0);

        // Menghitung gaji lembur
        $gajiLembur = $jamLembur * 20000; 

        // Menghitung pajak untuk gaji pokok
        $pajakGajiPokok = 0.005 * $gajiPokok; 

        // Menghitung gaji bersih
        $gajiBersih = $gajiPokok + $gajiLembur - $pajakGajiPokok;

        return $gajiBersih;
    }

    $nama = $_POST["nama"];
    $golongan = $_POST["golongan"];
    $jamKerja = $_POST["jam_kerja"];

    $gajiBersih = hitungGajiBersih($golongan, $jamKerja);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitung Gaji Bersih</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card">
        <div class="ket">
            <h4>Form Penggajian</h4>
            <p>Aplikasi menghitung gaji bersih karyawan</p>
        </div>

        <form action="index.php" method="post">
            <input class="input" placeholder="Nama" type="text" id="nama" name="nama" required>

            <input class="input" placeholder="Jam Kerja" type="number" id="jam_kerja" name="jam_kerja" required>
            <select class="input" id="golongan" name="golongan" required>
                <option value="A">Pilih Golongan</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select><br>
            <div class="btn">
                <button id="btn1" type="submit">Gaji Bersih</button>
                <a id="btn2" href="index.php" >Reset</a>
            </div>
        </form>

        <div class="hasil">
            <?php if (isset($gajiBersih)) : ?>
                <h1>Rp.<?php echo number_format($gajiBersih, 0, ',', '.'); ?></h1>
                <div class="flex">
                    <p><?php echo $nama; ?></p>
                    <p>Gol <?php echo $golongan; ?></p>
                    <p><?php echo $jamKerja; ?> Jam</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
