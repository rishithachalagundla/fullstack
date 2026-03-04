<?php
session_start();
include 'db.php';

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = "student";

    // Check if email already exists
    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if($check->num_rows > 0){
        $error = "Email already registered";
    } else {
        $sql = "INSERT INTO users (name, email, password, role)
                VALUES ('$name', '$email', '$password', '$role')";
        if($conn->query($sql)){
            $success = "Account created successfully! <a href='login.php'>Login here</a>";
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - SkillAcademy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Header -->
<header>
    <div class="container">
        <h1>SkillAcademy Marketplace</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="login.php">Login</a>
        </nav>
    </div>
</header>

<div class="container" style="margin-top:40px; max-width:400px;">

<div class="card">
    <h2 style="text-align:center;">Register</h2>
    
    <?php 
    if(isset($error)){ echo "<p style='color:red; text-align:center;'>$error</p>"; } 
    if(isset($success)){ echo "<p style='color:green; text-align:center;'>$success</p>"; } 
    ?>

    <form method="POST">
        <label>Name:</label><br>
        <input type="text" name="name" required style="width:100%; padding:8px; margin:5px 0;"><br>

        <label>Email:</label><br>
        <input type="email" name="email" required style="width:100%; padding:8px; margin:5px 0;"><br>

        <label>Password:</label><br>
        <input type="password" name="password" required style="width:100%; padding:8px; margin:5px 0;"><br><br>

        <button type="submit" name="register" class="button" style="width:100%;">Register</button>
    </form>

    <p style="text-align:center; margin-top:10px;">
        Already have an account? <a href="login.php">Login</a>
    </p>
</div>

</div>
</body>
</html>