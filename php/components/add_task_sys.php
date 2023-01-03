<?php
session_start();

if (!$_SESSION['logged']) {
    header("Location: ../log_in.php");
}


$description = $_POST['description'] ?? NULL;
$priority = $_POST['priority'] ?? NULL;
$end_date = $_POST['end_date'] ?? NULL;
$task_category = $_POST['task_category'] ?? NULL;


if (!is_null($description) and !is_null($priority) and !is_null($end_date) and !is_null($task_category)) {
    require './connection.php';
    $date1 = new DateTime($end_date);
    $date2 = new DateTime(date('Y-m-d'));
    $status = $date1 > $date2 ? 0 : 2;

    $query_str = "INSERT INTO tasks(id, description, status, priority, end_date, categories_name, user_id) VALUES (NULL, '{$description}', '{$status}', '{$priority}', '{$end_date}', '{$task_category}', '{$_SESSION['id']}')";
    $query = $conn->query($query_str);
    $conn = NULL;
    header('Location: ../tasks.php');
}
?>