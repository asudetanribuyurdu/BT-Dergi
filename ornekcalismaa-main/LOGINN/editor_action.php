<?php
session_start();
include 'connect.php';

// Sadece editörlerin bu işlemi yapmasına izin verin
if ($_SESSION['role'] != 0) {
    header("Location: homepage.php");
    exit();
}

if (isset($_GET['id'])) {
    $article_id = $_GET['id'];
    $updateQuery = "UPDATE articles SET status = 'reviewed' WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("i", $article_id);

    if ($stmt->execute()) {
        echo "Makale başarıyla incelendi.";
    } else {
        echo "Hata: " . $stmt->error;
    }
} else {
    echo "Makale ID'si belirtilmedi.";
}
?>
