<?php
require './isLogged.php';
$login = $_POST['login'] ?? NULL;
$password = $_POST['password'] ?? NULL;
$img = $_FILES["image"]["name"];

if (is_null($login) or is_null($password)) {
    header("Location: ../sign_up.php");
}

define("ALLOWED_SIZE", 2097152);

define("SAVED_DIRECTORY", "../../img/custom/");

$allowed_extensions = array("jpeg", "jpg", "png");

if (isset($_FILES['image'])) {

    $errors = array();



    $uploaded_file_size = $_FILES['image']['size'];

    $uploaded_file_tmp = $_FILES['image']['tmp_name'];

    $uploaded_file_type = $_FILES['image']['type'];



    $file_compositions = explode('.', $img);

    $file_ext = strtolower(end($file_compositions));



    $saved_file_name = $img;



    if (in_array($file_ext, $allowed_extensions) === false)

        $errors[] = 'Extension not allowed, please choose a JPEG or PNG file';



    if ($uploaded_file_size > ALLOWED_SIZE)

        $errors[] = 'File size is too big';



    if (empty($errors)) {

        move_uploaded_file($uploaded_file_tmp, SAVED_DIRECTORY . $saved_file_name);
    } else {

        print_r($errors);
    }
}

require './connection.php';
try {
    $query_str = "SELECT users.id, users.login, users.picture FROM users WHERE users.login = '{$login}'";
    $query = $conn->query($query_str);
    $result = $query->fetch();
    if (strtolower($login) == strtolower($result[1])) {
        $conn = NULL;
        header('Location: ../sign_up.php?error=Użytkownik o takim nicku już istnieje!');
    }
    $query = "INSERT INTO users (id, login, password, picture) VALUES (NULL, '{$login}', '{$password}', '{$img}')";
    $result = $conn->query($query);

    $query_str = "SELECT users.id, users.login, users.picture FROM users WHERE users.login = '{$login}'";
    $query = $conn->query($query_str);
    $result = $query->fetch();
    $_SESSION['logged'] = true;
    $_SESSION['id'] = $result[0];
    $_SESSION['login'] = $result[1];
    $_SESSION['picture'] = $result[2];
    $conn = NULL;
    header('Location: ../tasks.php');
} catch (PDOException $e) {
    $conn = NULL;
    header('Location: ../sign_up.php?error=Użytkownik o takim nicku już istnieje!');
}