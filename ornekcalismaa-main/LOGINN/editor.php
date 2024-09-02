<?php
session_start();
include 'connect.php';

// Sadece editörlerin bu sayfaya erişmesine izin verin
if ($_SESSION['role'] != 0) {
    header("Location: homepage.php");
    exit();
}

// Makaleleri listeleme
$query = "SELECT * FROM articles WHERE status = 'pending'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editör Sayfası</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>İncelenmesi Gereken Makaleler</h1>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Başlık</th>
                    <th>Özet</th>
                    <th>Yüklenme Tarihi</th>
                    <th>Dosya</th>
                    <th>Hakeme Gönder</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td><?php echo htmlspecialchars($row['summary']); ?></td>
                        <td><?php echo $row['uploaded_at']; ?></td>
                        <td><a href="<?php echo $row['file_path']; ?>" download><?php echo $row['file_name']; ?></a></td>
                        <td>
                            <form method="post" action="send_to_reviewer.php" style="display:inline;">
                                <input type="hidden" name="article_id" value="<?php echo $row['id']; ?>">
                                <input type="submit" value="Hakeme Gönder">
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>İncelenecek makale yok.</p>
        <?php endif; ?>
    </div>
</body>
</html>
