<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>405 Metode Tidak Diizinkan - Krian Swimming Club</title>
    <style>
        body {
            background-color: #f4f7f6;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        .error-card {
            text-align: center;
            background: white;
            padding: 50px 40px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            border-top: 6px solid #e53e3e;
            /* Warna Merah Peringatan */
            max-width: 480px;
            width: 90%;
        }

        .error-icon {
            font-size: 80px;
            margin: 0;
            line-height: 1;
        }

        h1 {
            font-size: 75px;
            color: #e53e3e;
            margin: 10px 0 0 0;
            font-weight: 800;
            letter-spacing: -2px;
        }

        h2 {
            color: #1a202c;
            margin: 15px 0 10px 0;
            font-size: 22px;
        }

        p {
            color: #718096;
            line-height: 1.6;
            margin-bottom: 30px;
            font-size: 15px;
        }

        .back-btn {
            display: inline-block;
            background: #2d3748;
            color: white;
            text-decoration: none;
            padding: 12px 28px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(45, 55, 72, 0.2);
        }

        .back-btn:hover {
            background: #1a202c;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(45, 55, 72, 0.3);
        }
    </style>
</head>

<body>

    <div class="error-card">
        <div class="error-icon">🚫🛑</div>
        <h1>405</h1>
        <h2>Metode Tidak Diizinkan!</h2>
        <p>kamu mencoba mengakses halaman ini langsung dari URL browser (GET), padahal rute ini dikunci dan hanya
            menerima kiriman data data dari Form pendaftaran (POST).</p>
        <a href="/" class="back-btn">
            ⬅️ Kembali ke Beranda
        </a>
    </div>

</body>

</html>