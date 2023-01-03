<?php
session_start();
if (!$_SESSION['logged']) {
    header("Location: log_in.php");
}

if (!isset($error)) {
    $error = '';
}

$first_pass = $_POST['f-password'] ?? NULL;
$second_pass = $_POST['s-password'] ?? NULL;

if (!is_null($first_pass) and !is_null($second_pass)) {
    if ($first_pass != $second_pass) {
        $error = "Hasła się różnią!";
    } else {
        require './components/connection.php';
        $query_str = "UPDATE users SET password = {$first_pass} WHERE users.id = {$_SESSION['id']}";
        $query = $conn->query($query_str);
        header('Location: tasks.php');
    }
}

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons@latest/iconfont/tabler-icons.min.css">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <nav class="nav position-fixed">
        <div class="wrapper">
            <a href="../index.php" class="nav--title">To Do App</a>
            <button class="nav--menu">
                <div class="bars"></div>
            </button>
            <div class="nav--links nav--links__desktop ">
                <a href="./tasks.php">zadania</a>
                <a href="./statistics.php">statystyki</a>
                <a href="./components/log_out.php">wyloguj się</a>
            </div>
            <a href="./profile.php" class="nav--profile">
                <img src="<?="../img/custom/" . $_SESSION['picture'] ?>" alt="">
            </a>
        </div>
        <div class="nav--links nav--links__mobile ">
            <a href="../index.php">home</a>
            <a href="./tasks.php">zadania</a>
            <a href="./statistics.php">statystyki</a>
            <a href="./components/log_out.php">wyloguj się</a>
        </div>
    </nav>
    <main class="main">
        <section class="profile profile__edit">
            <h1>Zmień hasło</h1>
            <img src="<?="../img/custom/" . $_SESSION['picture'] ?>" alt="">
            <form method="POST">
                <p>Nowe hasło <span>*</span></p>
                <input type="password" placeholder="Hasło" name="f-password" id="f-password" required>
                <p>Nowe hasło <span>*</span></p>
                <input type="password" placeholder="Hasło" name="s-password" id="s-password" required>
                <button class=" btn2">Zapisz zmiany</button>
                <p class="error">
                    <?= $error ?>
                </p>
            </form>
        </section>
    </main>
    <footer class="settings">
        <a href="./add_task.php" class="circle">
            <i class="ti ti-circle-plus"></i>
        </a>
    </footer>
    <script src="../js/main.js"></script>
</body>

</html>