<?php
session_start();
if (!$_SESSION['logged']) {
    header("Location: ../log_in.php");
}

$task_id = $_GET['id'] ?? NULL;

if (is_null($task_id)) {
    header("Location: ../tasks.php");
} else {
    require '../components/connection.php';
    $query_str = "DELETE FROM tasks WHERE tasks.id = {$task_id} AND tasks.user_id = {$_SESSION['id']}";
    $query = $conn->query($query_str);
    $conn = NULL;
    header("Location: ../tasks.php");
}
?>