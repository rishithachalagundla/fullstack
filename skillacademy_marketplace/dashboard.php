<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - SkillAcademy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Header / Navigation Bar -->
<header>
    <div class="container">
        <h1>SkillAcademy</h1>
        <nav>
            <a href="index.php">Home</a>
            <?php if($_SESSION['role'] == 'admin'){ ?>
                <a href="add_course.php">Add Course</a>
            <?php } ?>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        </nav>
    </div>
</header>

<div class="container" style="margin-top:20px;">

<h2>Welcome, <?php echo $_SESSION['name']; ?> 🎉</h2>
<p>You are logged in as: <b><?php echo $_SESSION['role']; ?></b></p>

<?php if($_SESSION['role'] == 'student'){ ?>
    <h3>My Enrolled Courses</h3>

    <?php
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT courses.id, courses.title, courses.description, 
                   courses.instructor, courses.price
            FROM enrollments
            JOIN courses ON enrollments.course_id = courses.id
            WHERE enrollments.user_id = '$user_id'";

    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo "<div class='card'>";
            echo "<h4>".$row['title']."</h4>";
            echo "<p>".$row['description']."</p>";
            echo "<p>Instructor: ".$row['instructor']."</p>";
            echo "<p>Price: ₹".$row['price']."</p>";
            echo "<a href='unenroll.php?course_id=".$row['id']."' 
                    onclick=\"return confirm('Are you sure you want to unenroll?');\" 
                    class='button'>Unenroll</a>";
            echo "</div>";
        }
    } else {
        echo "<p>You have not enrolled in any courses yet.</p>";
    }
    ?>

<?php } ?>

</div>
</body>
</html>