<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student'){
    header("Location: login.php");
    exit();
}

if(isset($_GET['course_id'])){
    $course_id = $_GET['course_id'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO enrollments (user_id, course_id)
            VALUES ('$user_id', '$course_id')";

    if($conn->query($sql) === TRUE){
        echo "Enrolled successfully! <a href='index.php'>Go Back</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>