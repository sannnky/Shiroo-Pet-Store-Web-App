<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

$koneksi = new mysqli("localhost", "root", "", "shiroo_db");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

if (isset($_POST['add_product'])) {
    $name = trim($_POST['name']);
    $desc = trim($_POST['desc']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);
    $category_id = intval($_POST['category_id']);
    $image = trim($_POST['image']);

    if ($name && $desc && $price && $stock && $category_id && $image) {
        $stmt = $koneksi->prepare("INSERT INTO products (name, `desc`, price, stock, category_id, image) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdiis", $name, $desc, $price, $stock, $category_id, $image);
        $stmt->execute();
        $stmt->close();
        header("Location: manage-products.php");
        exit;
    } else {
        $error = "Semua field harus diisi!";
    }
}

if (isset($_POST['edit_product'])) {
    $id = intval($_POST['id']);
    $name = trim($_POST['name']);
    $desc = trim($_POST['desc']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);
    $category_id = intval($_POST['category_id']);
    $image = trim($_POST['image']);

    if ($id && $name && $desc && $price && $stock && $category_id && $image) {
        $stmt = $koneksi->prepare("UPDATE products SET name=?, `desc`=?, price=?, stock=?, category_id=?, image=? WHERE id=?");
        $stmt->bind_param("ssdiisi", $name, $desc, $price, $stock, $category_id, $image, $id);
        $stmt->execute();
        $stmt->close();
        header("Location: manage-products.php");
        exit;
    } else {
        $error = "Semua field harus diisi!";
    }
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $koneksi->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: manage-products.php");
    exit;
}

$result = $koneksi->query("SELECT * FROM products ORDER BY id DESC");
$products = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk - Shiroo</title>
    <link rel="stylesheet" href="css/manage-products.css">
</head>

<body>

    <a href="dashboard.php" class="back-link">← Kembali ke Dashboard</a>

    <h1>Kelola Produk</h1>

    <?php if (!empty($error)) : ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <button class="btn-add" id="openAddModalBtn">+ Tambah Produk</button>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($products): foreach ($products as $product): ?>
            <tr>
                <td data-label="ID"><?= $product['id'] ?></td>
                <td data-label="Nama"><?= htmlspecialchars($product['name']) ?></td>
                <td data-label="Deskripsi"><?= htmlspecialchars($product['desc']) ?></td>
                <td data-label="Harga">Rp<?= number_format($product['price'], 2, ',', '.') ?></td>
                <td data-label="Stok"><?= $product['stock'] ?></td>
                <td data-label="Kategori"><?= $product['category_id'] ?></td>
                <td data-label="Gambar"><?= htmlspecialchars($product['image']) ?></td>
                <td data-label="Aksi">
                    <button class="btn-edit" onclick='openEditModal(
                        <?= $product['id'] ?>,
                        <?= json_encode($product['name']) ?>,
                        <?= json_encode($product['desc']) ?>,
                        <?= $product['price'] ?>,
                        <?= $product['stock'] ?>,
                        <?= $product['category_id'] ?>,
                        <?= json_encode($product['image']) ?>
                    '>Edit</button>
                    <a href="manage-products.php?delete=<?= $product['id'] ?>"
                        onclick="return confirm('Yakin hapus produk ini?')" class="btn-delete">Hapus</a>
                </td>
            </tr>
            <?php endforeach; else: ?>
            <tr>
                <td colspan="8" style="text-align:center;">Belum ada produk.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- MODAL TAMBAH -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeAddModal">&times;</span>
            <h2>Tambah Produk</h2>
            <form method="post" action="">
                <label>Nama Produk</label>
                <input type="text" name="name" required>
                <label>Deskripsi</label>
                <textarea name="desc" required></textarea>
                <label>Harga</label>
                <input type="number" name="price" step="0.01" required>
                <label>Stok</label>
                <input type="number" name="stock" required>
                <label>ID Kategori</label>
                <input type="number" name="category_id" required>
                <label>Nama File Gambar</label>
                <input type="text" name="image" required>
                <button type="submit" name="add_product">Tambah</button>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeEditModal">&times;</span>
            <h2>Edit Produk</h2>
            <form method="post" action="">
                <input type="hidden" name="id" id="edit_id">
                <label>Nama Produk</label>
                <input type="text" name="name" id="edit_name" required>
                <label>Deskripsi</label>
                <textarea name="desc" id="edit_desc" required></textarea>
                <label>Harga</label>
                <input type="number" step="0.01" name="price" id="edit_price" required>
                <label>Stok</label>
                <input type="number" name="stock" id="edit_stock" required>
                <label>ID Kategori</label>
                <input type="number" name="category_id" id="edit_category_id" required>
                <label>Nama File Gambar</label>
                <input type="text" name="image" id="edit_image" required>
                <button type="submit" name="edit_product">Simpan</button>
            </form>
        </div>
    </div>

    <script>
    const addModal = document.getElementById("addModal");
    document.getElementById("openAddModalBtn").onclick = () => addModal.style.display = "block";
    document.getElementById("closeAddModal").onclick = () => addModal.style.display = "none";

    const editModal = document.getElementById("editModal");
    document.getElementById("closeEditModal").onclick = () => editModal.style.display = "none";

    function openEditModal(id, name, desc, price, stock, category_id, image) {
        document.getElementById("edit_id").value = id;
        document.getElementById("edit_name").value = name;
        document.getElementById("edit_desc").value = desc;
        document.getElementById("edit_price").value = price;
        document.getElementById("edit_stock").value = stock;
        document.getElementById("edit_category_id").value = category_id;
        document.getElementById("edit_image").value = image;
        editModal.style.display = "block";
    }

    window.onclick = function(event) {
        if (event.target == addModal) addModal.style.display = "none";
        if (event.target == editModal) editModal.style.display = "none";
    }
    </script>

</body>

</html>