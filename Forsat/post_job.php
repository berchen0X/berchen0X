<?php
session_start();
include 'config/database.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'recruiter') {
    die("Unauthorized access.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $requirements = $_POST['requirements'];
    $location = $_POST['location'];
    $company = $_POST['company'];
    $posted_by = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO jobs (title, description, requirements, location, company, posted_by) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$title, $description, $requirements, $location, $company, $posted_by])) {
        echo "Job posted successfully!";
        header('Location: jobs.php');
        exit();
    } else {
        echo "Failed to post job.";
    }
}
?>
