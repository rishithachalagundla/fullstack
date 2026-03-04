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

    $sql = "DELETE FROM enrollments 
            WHERE user_id='$user_id' AND course_id='$course_id'";

    if($conn->query($sql) === TRUE){
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>