<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt & Giriş</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" id="signup" style="display:none;">
        <h1 class="form-title">Kayıt Ol</h1>
        <form method="post" action="register.php">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="fName" id="fName" placeholder="First Name" required>
                <label for="fname">İsim</label>
            </div>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="lName" id="lName" placeholder="Last Name" required>
                <label for="lName">Soyisim</label>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="email">E-posta</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" placeholder="password" required>
                <label for="password">Şifre</label>
            </div>
            <input type="submit" class="btn" value="Kayıt Ol" name="signUp">
        </form>
        <p class="or">
            --------veya--------
        </p>
        <div class="icons">
            <i class="fab fa-google"></i>
            <i class="fab fa-facebook"></i>
        </div>
        <div class="links">
            <p>Zaten bir hesabınız var mı?</p>
            <button id="signInButton">Giriş</button>
        </div>
    </div>

<div class="container" id="signIn">
        <h1 class="form-title">Giriş</h1>
        <form method="post" action="register.php">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="email">E-posta</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" placeholder="password" required>
                <label for="password">Şifre</label>
            </div>
            <p class="recover">
                <a href="#">Şifremi Unuttum</a>
            </p>
            <input type="submit" class="btn" value="Giriş" name="signIn">
        </form>
        <p class="or">
            --------veya--------
        </p>
        <div class="icons">
            <i class="fab fa-google"></i>
            <i class="fab fa-facebook"></i>
        </div>
        <div class="links">
            <p>Bir hesabınız yok mu?</p>
            <button id="signUpButton">Kayıt Ol</button>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>