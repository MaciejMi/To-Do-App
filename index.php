<?php
session_start();
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
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <nav class="nav">
        <div class="wrapper">
            <a href="#" class="nav--title">To Do App</a>
            <button class="nav--menu">
                <div class="bars"></div>
            </button>
            <div class="nav--links nav--links__desktop ">
                <a href="./php/tasks.php">zadania</a>
                <a href="./php/statistics.php">statystyki</a>
                <?php if ($_SESSION['logged']): ?>
                    <a href="./php/components/log_out.php">wyloguj się</a>
                    <?php else: ?>
                    <a href="./php/log_in.php">zaloguj się</a>
                    <?php endif; ?>
            </div>
            <?php if ($_SESSION['logged']): ?>
                <a href="./php/profile.php" class="nav--profile">
                    <img src="<?="./img/custom/" . $_SESSION['picture'] ?>" alt="">
                </a>
                <?php endif; ?>
        </div>
        <div class="nav--links nav--links__mobile ">
            <a href="#" class="active">home</a>
            <a href="./php/tasks.php">zadania</a>
            <a href="./php/statistics.php">statystyki</a>
            <?php if ($_SESSION['logged']): ?>
                <a href="./php/components/log_out.php">wyloguj się</a>
                <?php else: ?>
                <a href="./php/log_in.php">zaloguj się</a>
                <?php endif; ?>
        </div>
    </nav>
    <header class="header">
        <div class="bg-image">
            <div class="bg-shadow">
                <div class="text-box">
                    <h1>To Do App</h1>
                    <p>Zbierz wszystkie swoje zadania w jednym miejscu!</p>
                    <a href="./php/tasks.php" class="btn-2">Rozpocznij</a>
                </div>
            </div>

        </div>
    </header>

    <script src="./js/main.js"></script>
</body>

</html>