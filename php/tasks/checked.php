<?php
session_start();
if (!$_SESSION['logged']) {
    header("Location: ../log_in.php");
}

$task_id = $_GET['id'] ?? NULL;
$done = $_GET['done'] ?? NULL;

if (!($done == 0 || $done == 1)) {
    header('Location: ../tasks.php');
}

if (is_null($task_id) or is_null($done)) {
    header("Location: ../tasks.php");
} else {
    require '../components/connection.php';
    $query_str = "UPDATE tasks SET tasks.status = {$done} WHERE tasks.id = {$task_id} AND tasks.user_id = {$_SESSION['id']}";
    $query = $conn->query($query_str);
    $conn = NULL;
    header('Location: ./refresh.php');
}
?>