<?php
session_start();
include 'connect.php';

// Sadece hakemlerin bu sayfaya erişmesine izin verin
if ($_SESSION['role'] != 1) {
    header("Location: homepage.php");
    exit();
}

// Makale ID'sini kontrol edin
if (isset($_GET['id'])) {
    $article_id = $_GET['id'];

    // Makale bilgilerini veritabanından alın
    $query = "SELECT * FROM articles WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $article_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $article = $result->fetch_assoc();
    } else {
        echo "Makale bulunamadı.";
        exit();
    }
} else {
    echo "Makale ID'si belirtilmedi.";
    exit();
}

// Makale inceleme formunu işleme
if (isset($_POST['submitReview'])) {
    $review = $_POST['review'];
    $status = $_POST['status'];

    // Makale durumunu güncelleme
    $updateQuery = "UPDATE articles SET review = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssi", $review, $status, $article_id);

    if ($stmt->execute()) {
        echo "İnceleme başarıyla kaydedildi.";
    } else {
        echo "Hata: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hakem Sayfası</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Makale İncele</h1>
        <h2><?php echo htmlspecialchars($article['title']); ?></h2>
        <p><?php echo htmlspecialchars($article['summary']); ?></p>
        <p><strong>Yüklenme Tarihi:</strong> <?php echo $article['uploaded_at']; ?></p>
        <p><strong>Dosya:</strong> <a href="<?php echo $article['file_path']; ?>" download><?php echo $article['file_name']; ?></a></p>

        <form method="post">
            <label for="review">İnceleme Notları:</label>
            <textarea name="review" id="review" required></textarea>

            <label for="status">Makale Durumu:</label>
            <select name="status" id="status" required>
                <option value="accepted">Kabul Edildi</option>
                <option value="rejected">Reddedildi</option>
            </select>

            <input type="submit" name="submitReview" value="İncelemeyi Kaydet">
        </form>
    </div>
</body>
</html>
