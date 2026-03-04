<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}

$message = "";

if(isset($_POST['add_course'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $instructor = $_POST['instructor'];

    $sql = "INSERT INTO courses (title, description, price, instructor)
            VALUES ('$title', '$description', '$price', '$instructor')";

    if($conn->query($sql) === TRUE){
        $message = "Course added successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Course - Admin</title>
</head>
<body>

<h2>Add New Course</h2>

<?php if($message != "") echo "<p style='color:green;'>$message</p>"; ?>

<form method="POST">
    Title: <input type="text" name="title" required><br><br>
    Description: <textarea name="description" required></textarea><br><br>
    Price: <input type="number" name="price" required><br><br>
    Instructor: <input type="text" name="instructor" required><br><br>
    <button type="submit" name="add_course">Add Course</button>
</form>

<br>
<a href="dashboard.php">Back to Dashboard</a>

</body>
</html>