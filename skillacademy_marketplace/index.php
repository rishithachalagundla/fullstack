<?php
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>SkillAcademy Marketplace</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Header / Navigation Bar -->
<header>
    <div class="container">
        <h1>SkillAcademy</h1>
        <nav>
            <a href="index.php">Home</a>
            <?php if(isset($_SESSION['user_id'])){ ?>
                <a href="dashboard.php">Dashboard</a>
                <a href="logout.php">Logout</a>
            <?php } else { ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php } ?>
        </nav>
    </div>
</header>

<div class="container" style="margin-top:20px;">

<h1>SkillAcademy Marketplace 🎓</h1>

<hr>

<h2>Available Courses</h2>

<?php
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<div class='card'>";
        echo "<h3>".$row['title']."</h3>";
        echo "<p>".$row['description']."</p>";
        echo "<p>Instructor: ".$row['instructor']."</p>";
        echo "<p>Price: ₹".$row['price']."</p>";

        if(isset($_SESSION['user_id']) && $_SESSION['role'] == 'student'){
            echo "<a href='enroll.php?course_id=".$row['id']."' class='button'>Enroll</a>";
        }

        echo "</div>";
    }
} else {
    echo "<p>No courses available yet.</p>";
}
?>

</div>
</body>
</html>