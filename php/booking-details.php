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
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= $data['name'] ?> - Booking Details</title>
</head>

<body>
    <div class="booking-details">
        <img src="../img/booking-img/<?= $data['image'] ?>" alt="<?= $data['name'] ?>">
        <h2><?= $data['name'] ?></h2>
        <p><?= $data['description'] ?></p>
        <a href="booking-form.php?id=<?= $data['id'] ?>">Booking Now</a>

    </div>
</body>

</html>