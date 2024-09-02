<?php
session_start();
include 'connect.php';

// Sadece editörlerin bu sayfaya erişmesine izin verin
if ($_SESSION['role'] != 0) {
    header("Location: homepage.php");
    exit();
}

if (isset($_POST['article_id'])) {
    $article_id = $_POST['article_id'];

    // Makale durumunu 'review' olarak güncelleme
    $updateQuery = "UPDATE articles SET status = 'review' WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("i", $article_id);

    if ($stmt->execute()) {
        // Başarıyla güncellendikten sonra hakem sayfasına yönlendirme
        header("Location: hakem.php?id=" . $article_id);
    } else {
        echo "Hata: " . $stmt->error;
    }
} else {
    echo "Makale ID'si belirtilmedi.";
}
?>
