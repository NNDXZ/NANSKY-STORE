<?php

$produk = [
    [
        "nama" => "Laptop",
        "harga" => 5000000,
        "diskon" => 10,
        "gambar" => "laptop.jpg"
    ],
    [
        "nama" => "IPHONE 15",
        "harga" => 3000000,
        "diskon" => 5,
        "gambar" => "iphone.jpg"
    ],
    [
        "nama" => "VGA",
        "harga" => 1500000,
        "diskon" => 0,
        "gambar" => "rtx.png"
    ],
    [
        "nama" => "SSD",
        "harga" => 7000000,
        "diskon" => 15,
        "gambar" => "ssd.jpg"
    ],
    [
        "nama"=> "PC",
        "harga"=> 5000000,
        "diskon"=> 15,
        "gambar"=> "pc.jpg"
        ],
    [
        "nama"=> "PLAYSTATION",
        "harga"=> 5000000,
        "diskon"=> 15,
        "gambar"=> "ps5.jpg"
    ],
];
$jumlahBeli = isset($_POST['jumlah']) ? $_POST['jumlah'] : 0;
$uangPelanggan = isset($_POST['uang']) ? $_POST['uang'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($jumlahBeli > 0) {
        $totalHarga = $jumlahBeli * $produk[0]['harga'];
        $diskon = $produk[0]['diskon'];
        $hargaDiskon = $totalHarga - ($totalHarga * $diskon / 100);

        if ($uangPelanggan >= $hargaDiskon) {
            $kembalian = $uangPelanggan - $hargaDiskon;
            $pesan = "Pembelian sukses. Kembalian: Rp " . number_format($kembalian, 0, ',', '.');
        } else {
            $pesan = "Uang pelanggan tidak mencukupi.";
        }
    } else {
        $totalHarga = 0;
        $diskon = 0;
        $hargaDiskon = 0;
        $pesan = "Tidak ada pembelian.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STORE ALAT </title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
<header class="header">
    <h1>Nansky Store</h1>
</header>

<div class="produk-container">

 <?php foreach ($produk as $key => $item) : ?>

        <div class="produk-card">
            <img src="<?php echo $item['gambar']; ?>" alt="<?php echo $item['nama']; ?>" class="produk-image">
            <h2><?php echo $item['nama']; ?></h2>
            <p>Harga: Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></p>

            <?php if ($item['diskon'] > 0) : ?>
                <p>Diskon <?php echo $item['diskon']; ?>%</p>
                <p>Harga Diskon: Rp <?php echo number_format($item['harga'] - ($item['harga'] * $item['diskon'] / 100), 0, ',', '.'); ?></p>
            <?php else : ?>
                <p>Maaf, tidak ada diskon tersedia saat ini.</p>
            <?php endif; ?>

            <form method="post">
                <div class="form-group">
                    <label for="jumlah">Jumlah Beli:</label>
                    <input type="number" id="jumlah" name="jumlah" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label for="uang">Uang Pelanggan:</label>
                    <input type="number" id="uang" name="uang" class="form-input" min="0">
                </div>
                <button type="submit" class="beli-button">Beli Sekarang</button>
            </form>

    <?php if ($item['nama'] == '') : ?>
        <?php if (isset($kembalian)) : ?>
            <div class="kembalian">
                <p>Kembalian: Rp <?php echo number_format($kembalian, 0, ',', '.'); ?></p>
            </div>
        <?php endif; ?>
    <?php endif; ?>

</div>

<?php endforeach; ?>

</div>

<center>
<!-- (Tampilkan pesan) -->
<?php if (isset($pesan)) : ?>
<p><?php echo $pesan; ?></p>
<?php endif; ?>

<!-- Hasil pembelian -->
<?php if (isset($totalHarga) && $totalHarga > 0) : ?>
    <h3>Hasil Pembelian:</h3>
    <p>Total Harga: Rp <?php echo number_format($totalHarga, 0, ',', '.'); ?></p>
    <p>Diskon: <?php echo $diskon; ?>%</p>
    <p>Harga Setelah Diskon: Rp <?php echo number_format($hargaDiskon, 0, ',', '.'); ?></p>
    <?php if (isset($kembalian)) : ?>
        <p>Kembalian: Rp <?php echo number_format($kembalian, 0, ',', '.'); ?></p>
    <?php endif; ?>
<?php endif; ?>
</center>

<footer class="footer">
<p>&copy; 2023 Nansky Store</p>
</footer>
</body>

</html>
