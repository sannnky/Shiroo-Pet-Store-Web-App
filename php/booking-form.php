<?php
$koneksi = new mysqli("localhost", "root", "", "shiroo_db");
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $koneksi->prepare("SELECT * FROM booking_detail WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    echo "Layanan tidak ditemukan.";
    exit;
}

$tanggalHariIni = date("Y-m-d");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Form Booking - <?= $data['name'] ?></title>
</head>

<body>
    <h2>Booking Form: <?= $data['name'] ?></h2>

    <div class="booking-info">
        <img src="../img/<?= $data['image'] ?>" alt="<?= $data['name'] ?>" style="width:200px;">
        <p><strong><?= $data['name'] ?></strong></p>
    </div>

    <form action="booking-process.php" method="POST">
        <input type="hidden" name="booking_id" value="<?= $data['id'] ?>">

        <label>Tanggal Booking:</label><br>
        <input type="date" name="tanggal" min="<?= $tanggalHariIni ?>" required><br><br>

        <label>Nama Anda:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>No. Telepon (Mobile):</label><br>
        <input type="tel" name="telp" required><br><br>

        <label>Gender Kucing:</label><br>
        <select name="gender_kucing" required>
            <option value="">-- Pilih --</option>
            <option value="Jantan">Jantan</option>
            <option value="Betina">Betina</option>
        </select><br><br>

        <label>Metode Pembayaran:</label><br>
        <input type="radio" name="metode" value="Cash" required> Cash
        <input type="radio" name="metode" value="Cashless" required> Cashless<br><br>

        <button type="submit">Kirim Booking</button>
    </form>
</body>

</html>