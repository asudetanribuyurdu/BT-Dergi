<?php
session_start();
include 'connect.php';

if (isset($_POST['upload'])) {
    if (isset($_FILES['article']) && $_FILES['article']['error'] == UPLOAD_ERR_OK) {
        $title = $_POST['title'];
        $summary = $_POST['summary'];
        $author_id = $_SESSION['user_id']; // Giriş yapan kullanıcının ID'si
        $fileTmpPath = $_FILES['article']['tmp_name'];
        $fileName = $_FILES['article']['name'];
        $fileSize = $_FILES['article']['size'];
        $fileType = $_FILES['article']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedExtensions = array('doc', 'docx', 'pdf');
        $allowedMimeTypes = array('application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        $uploadFileDir = './uploads/';

        // Maksimum dosya boyutu kontrolü (40 MB)
        $maxFileSize = 40 * 1024 * 1024; // 40 MB

        if (!in_array($fileExtension, $allowedExtensions)) {
            echo "<p class='error'>İzin verilen dosya türleri: " . implode(', ', $allowedExtensions) . ".</p>";
        } elseif (!in_array($fileType, $allowedMimeTypes)) {
            echo "<p class='error'>Geçersiz dosya türü. Lütfen geçerli bir dosya yükleyin.</p>";
        } elseif ($fileSize > $maxFileSize) {
            echo "<p class='error'>Dosya boyutu çok büyük. Maksimum 40 MB olabilir.</p>";
        } else {
            // Benzersiz bir dosya adı oluştur
            $uniqueFileName = time() . '_' . $fileName;
            $dest_path = $uploadFileDir . $uniqueFileName;

            // Yükleme dizini yoksa oluştur
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0777, true);
            }

            try {
                if (!move_uploaded_file($fileTmpPath, $dest_path)) {
                    throw new Exception("Dosya yüklenemedi. Lütfen dizin izinlerini ve dosya boyutunu kontrol edin.");
                }

                // Makale bilgilerini veritabanına kaydetme
                $insertQuery = "INSERT INTO articles (author_id, title, summary, file_name, file_path) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($insertQuery);
                $stmt->bind_param("issss", $author_id, $title, $summary, $uniqueFileName, $dest_path);

                if ($stmt->execute()) {
                    echo "<p class='success'>Makale başarıyla yüklendi ve kaydedildi.</p>";
                } else {
                    echo "<p class='error'>Veritabanına kaydedilirken bir hata oluştu: " . $stmt->error . "</p>";
                }
            } catch (Exception $e) {
                echo "<p class='error'>Hata: " . $e->getMessage() . "</p>";
                error_log("Dosya yükleme hatası: " . $e->getMessage()); // Hata günlüğüne yazdırma
            }
        }
    } else {
        echo "<p class='error'>Dosya yüklenmedi veya yükleme hatası oluştu.</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yazar Sayfası</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Sayfa stili */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 1000px;
        }
        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }
        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            margin-bottom: 20px;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .success {
            color: green;
            margin-top: 20px;
        }
        .error {
            color: red;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Makale Yükle</h1>
        <form method="post" enctype="multipart/form-data">
            <label for="title">Makale Başlığı:</label>
            <input type="text" name="title" id="title" required>
            
            <label for="summary">Makale Özeti:</label>
            <textarea name="summary" id="summary" required></textarea>

            <label for="article">Makale Yükle (Word veya PDF):</label>
            <input type="file" name="article" id="article" required>
            <input type="submit" name="upload" value="Yükle">
        </form>
    </div>
</body>
</html>
