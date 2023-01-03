<?php
session_start();
if (!$_SESSION['logged']) {
    header("Location: ../log_in.php");
}

require '../components/connection.php';
$query_str = "UPDATE tasks SET tasks.status = 2 WHERE tasks.end_date < CURDATE() AND tasks.status = 0 AND tasks.user_id = {$_SESSION['id']}";
$query = $conn->query($query_str);
$query_str = "UPDATE tasks SET tasks.status = 0 WHERE tasks.end_date > CURDATE() AND tasks.status = 2 AND tasks.user_id = {$_SESSION['id']}";
$query = $conn->query($query_str);
header('Location: ../tasks.php');
?>