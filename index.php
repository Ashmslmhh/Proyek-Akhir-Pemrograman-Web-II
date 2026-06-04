<?php
// Membuat variabel data sederhana
$nama_project = "Proyek Akhir Pemrograman Web II";
$status_running = "🔥 PHP Berhasil Berjalan dengan Aman!";
$waktu_sekarang = date('H:i:s');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes Project Web II</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #0f172a;
            color: #f8fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            background-color: #1e293b;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.4);
            text-align: center;
            max-width: 450px;
            border: 1px solid #334155;
        }
        h1 {
            color: #38bdf8;
            font-size: 1.6rem;
            margin-bottom: 15px;
        }
        p {
            color: #94a3b8;
            line-height: 1.6;
        }
        .badge {
            background-color: #0284c7;
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            display: inline-block;
            margin-top: 10px;
            font-weight: bold;
        }
        .footer {
            margin-top: 25px;
            font-size: 0.8rem;
            color: #64748b;
            border-top: 1px solid #334155;
            padding-top: 15px;
        }
    </style>
</head>
<body>

    <div class="card">
        <h1><?php echo $status_running; ?></h1>
        <p>Gila, mantap! Script PHP pertama di folder lokal kamu sudah berhasil dieksekusi oleh server local.</p>
        
        <div class="badge">
            <?php echo $nama_project; ?>
        </div>
        
        <div class="footer">
            Dilewati pada jam server lokal: <strong><?php echo $waktu_sekarang; ?> WITA</strong>
        </div>
    </div>

</body>
</html>