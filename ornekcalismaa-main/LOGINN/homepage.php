<?php
session_start();
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f0f0f0;
        }
        .header {
            background-color: white;
            color: black;
            padding: 10px 20px;
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
        }
        .header .button-container {
            display: flex;
            gap: 10px; /* Butonlar arasında boşluk */
        }
        .header .button-container button {
            padding: 5px 10px;
            background-color: #3f51b5;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .header .button-container button:hover {
            background-color: #303f9f;
        }
        .header .button-container button.active {
            background-color: #303f9f;
        }
        .header .title {
            font-weight: bold;
            margin-right: 15px;
            font-size: 16px;
            color: #3f51b5;
        }
        .header span {
            font-weight: bold;
            margin-right: 15px; /* İkon ile kullanıcı adı arasına boşluk ekler */
        }
        .header i {
            font-size: 18px; /* İkon boyutu */
        }
        .card {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 40px;
            width: 450px;
            padding: 50px;
            text-align: left;
            position: fixed;
            top: 150px;
            min-height: 170px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .card.left {
            left: 80px;
        }
        .card.center {
            left: 50%;
            transform: translateX(-50%);
        }
        .card.right {
            right: 80px;
        }
        .card h2 {
            margin-top: 0;
            color: #3f51b5;
        }
        .list {
            list-style: none;
            padding: 0;
            margin: 0;
            flex-grow: 1;
        }
        .list-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        .list-item:last-child {
            border-bottom: none;
        }
        .list-item i {
            margin-right: 10px;
            font-size: 16px;
        }
        .list-item span {
            flex-grow: 1;
        }
        .list-item i.info-icon {
            margin-left: 10px;
            cursor: pointer;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="header">
        <div class="button-container">
            <div class="title">BT Yönetişim ve Denetim Dergisi</div>
            <button class="about-button">Hakkında</button>
            <button>Konular</button>
            <button>Trendler</button>
            <button>Yardım</button>
            <button>Araştırmacılar</button>
            <button>Yayıncılar</button>
            <button>Dergiler</button>
        </div>
        <div>
            <i class="fa-regular fa-bell"></i>
            <i class="fa-solid fa-circle-user"></i> <!-- Kullanıcı ikonu -->
            <span><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Ziyaretçi'; ?></span>
        </div>
    </div>

    <div class="card left">
        <h2>Dergiler ve Makaleler</h2>
        <ul class="list">
            <li class="list-item">
                <i class="fas fa-book"></i>
                <span>Dergilerim</span>
                <i class="fas fa-info-circle info-icon"></i>
            </li>
            <li class="list-item">
                <i class="fas fa-book"></i>
                <span>Makalelerim (Sorumlu Yazar)</span>
                <i class="fas fa-info-circle info-icon"></i>
            </li>
            <li class="list-item">
                <i class="fas fa-book"></i>
                <span>Makalelerim (Diğer Yazar)</span>
                <i class="fas fa-info-circle info-icon"></i>
            </li>
        </ul>
    </div>

    <div class="card center">
        <h2>Kütüphane</h2>
        <ul class="list">
            <li class="list-item">
                <i class="fas fa-book-open"></i>
                <span>Araştırmalarım</span>
                <i class="fas fa-info-circle info-icon"></i>
            </li>
            <li class="list-item">
                <i class="fas fa-book-open"></i>
                <span>Favori Makalelerim</span>
                <i class="fas fa-info-circle info-icon"></i>
            </li>
        </ul>
    </div>

    <div class="card right">
        <h2>Takip Edilenler</h2>
        <ul class="list">
            <li class="list-item">
                <i class="fas fa-bookmark"></i>
                <span>Takip Edilen Dergiler</span>
                <i class="fas fa-info-circle info-icon"></i>
            </li>
            <li class="list-item">
                <i class="fas fa-bookmark"></i>
                <span>Takip Edilen Konular</span>
                <i class="fas fa-info-circle info-icon"></i>
            </li>
            <li class="list-item">
                <i class="fas fa-bookmark"></i>
                <span>Takip Edilen Araştırmacılar</span>
                <i class="fas fa-info-circle info-icon"></i>
            </li>
        </ul>
    </div>
 
</body>
</html>
