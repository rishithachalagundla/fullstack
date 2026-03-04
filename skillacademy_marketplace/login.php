<?php
session_start();
include 'db.php';

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['role'] = $row['role'];

        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid Email or Password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - SkillAcademy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Header -->
<header>
    <div class="container">
        <h1>SkillAcademy Marketplace</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="register.php">Register</a>
        </nav>
    </div>
</header>

<div class="container" style="margin-top:40px; max-width:400px;">

<div class="card">
    <h2 style="text-align:center;">Login</h2>
    
    <?php if(isset($error)){ echo "<p style='color:red; text-align:center;'>$error</p>"; } ?>

    <form method="POST">
        <label>Email:</label><br>
        <input type="email" name="email" required style="width:100%; padding:8px; margin:5px 0;"><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required style="width:100%; padding:8px; margin:5px 0;"><br><br>
        
        <button type="submit" name="login" class="button" style="width:100%;">Login</button>
    </form>

    <p style="text-align:center; margin-top:10px;">
        Don't have an account? <a href="register.php">Register</a>
    </p>
</div>

</div>
</body>
</html>