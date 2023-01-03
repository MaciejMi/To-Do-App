<?php
session_start();
if (!$_SESSION['logged']) {
    header("Location: log_in.php");
}

require "./components/connection.php";
$query_str = "SELECT count(*) FROM tasks WHERE tasks.user_id = {$_SESSION['id']}";
$query = $conn->query($query_str);
$all = $query->fetch();

$query_str = "SELECT count(*) FROM tasks WHERE tasks.user_id = {$_SESSION['id']} AND tasks.status = 1";
$query = $conn->query($query_str);
$done = $query->fetch();

$query_str = "SELECT count(*) FROM tasks WHERE tasks.user_id = {$_SESSION['id']} AND tasks.status = 0";
$query = $conn->query($query_str);
$to_do = $query->fetch();

$query_str = "SELECT count(*) FROM tasks WHERE tasks.user_id = {$_SESSION['id']} AND tasks.status = 2";
$query = $conn->query($query_str);
$late = $query->fetch();


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
    <nav class="nav ">
        <div class="wrapper">
            <a href="../index.php" class="nav--title">To Do App</a>
            <button class="nav--menu">
                <div class="bars"></div>
            </button>
            <div class="nav--links nav--links__desktop ">
                <a href="./tasks.php">zadania</a>
                <a href="#" class="active">statystyki</a>
                <a href="./components/log_out.php">wyloguj się</a>
            </div>
            <a href="./profile.php" class="nav--profile">
                <img src="<?=" ../img/custom/" . $_SESSION['picture'] ?>" alt="">
            </a>
        </div>
        <div class="nav--links nav--links__mobile ">
            <a href="../index.php">home</a>
            <a href="./tasks.php">zadania</a>
            <a href="#" class="active">statystyki</a>
            <a href="./components/log_out.php">wyloguj się</a>
        </div>
    </nav>
    <main class="main">
        <section class="statistics">
            <div class="card-box">
                <div class="card blue">
                    <p>👍</p>
                    <p>
                        <?= $all[0] ?> zadań łącznie
                    </p>
                </div>
                <div class="card green">
                    <p>😉</p>
                    <p> <?= $done[0] ?> wykonanych</p>
                </div>
                <div class="card red">
                    <p>😥</p>
                    <p>
                        <?= $to_do[0] ?> nie wykonanych
                    </p>
                </div>
                <div class="card yellow">
                    <p>⏰</p>
                    <p>
                        <?= $late[0] ?> spóźnionych
                    </p>
                </div>
            </div>
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