<?php 

include 'connect.php';

if(isset($_POST['signUp'])){
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);

    $checkEmail = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkEmail);
    if($result->num_rows > 0){
        echo "Email Address Already Exists!";
    }
    else{
        // Varsayılan rolü 3 olarak güncelle
        $insertQuery = "INSERT INTO users(firstName, lastName, email, password, role) VALUES ('$firstName', '$lastName', '$email', '$password', 3)";
        if($conn->query($insertQuery) === TRUE){
            header("Location: index.php");
        }
        else{
            echo "Error: " . $conn->error;
        }
    }
}

if(isset($_POST['signIn'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['role'] = $row['role'];

        // Kullanıcının rolüne göre yönlendir
        if($row['role'] == 0){
            header("Location: editor.php");
        }
        elseif($row['role'] == 1){
            header("Location: hakem.php");
        }
        elseif($row['role'] == 2){
            header("Location: yazar.php");
        }
        else{
            header("Location: homepage.php");
        }
        exit();
    }
    else{
        echo "Not Found, Incorrect Email or Password";
    }
}
?>
