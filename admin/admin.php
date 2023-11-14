<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../koneksi.php';

$id_produk = $_GET['id'] ?? null;
$statusTransaksi = '';

if ($id_produk) {
    $stmt = $koneksi->prepare("SELECT status_transaksi FROM produk WHERE id_produk = ?");
    $stmt->bind_param("i", $id_produk);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $prd = $result->fetch_assoc();
        $statusTransaksi = $prd["status_transaksi"];
    }
}

if (isset($_POST["ubah_status"])) {
    $statusBaru = $_POST["status_transaksi"];
    $stmt = $koneksi->prepare("UPDATE produk SET status_transaksi = ? WHERE id_produk = ?");
    $stmt->bind_param("si", $statusBaru, $id_produk);
    
    if ($stmt->execute()) {
        echo "<script>alert('Status berhasil diubah!');</script>";
        $statusTransaksi = $statusBaru;
        header('Location: tampilan.php');
        exit;
    } else {
        echo "<script>alert('Gagal mengubah status: " . $stmt->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .admin-panel {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
        }

        select, button {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            cursor: pointer;
            background-color: #007BFF;
            color: white;
            border: none;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="admin-panel">
    <form action="" method="POST">
        <label for="status_transaksi">Ubah Status Barang:</label>
        <select name="status_transaksi">
            <option value="Pending" <?php echo $statusTransaksi == 'Pending' ? 'selected' : ''; ?>>Pending</option>
            <option value="Dikirim" <?php echo $statusTransaksi == 'Dikirim' ? 'selected' : ''; ?>>Dikirim</option>
            <option value="Diterima" <?php echo $statusTransaksi == 'Diterima' ? 'selected' : ''; ?>>Diterima</option>
        </select>
        <button type="submit" name="ubah_status">Ubah Status</button>
    </form>
</div>
</body>
</html>

