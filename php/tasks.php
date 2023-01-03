<?php
session_start();
if (!$_SESSION['logged']) {
    header("Location: log_in.php");
}

require './components/connection.php';
$search = $_GET['search'] ?? NULL;
if (!is_null($search)) {
    switch ($search) {
        case 1:
            $query_str = "SELECT * FROM tasks WHERE tasks.user_id = {$_SESSION['id']} AND tasks.status = 0";
            break;
        case 2:
            $query_str = "SELECT * FROM tasks WHERE tasks.user_id = {$_SESSION['id']} AND tasks.status = 2";
            break;
        case 3:
            $query_str = "SELECT * FROM tasks WHERE tasks.user_id = {$_SESSION['id']} AND tasks.status = 1";
            break;
        default:
            break;

    }
} else {
    $query_str = "SELECT * FROM tasks WHERE tasks.user_id = {$_SESSION['id']}";
}

// Do pokazania wyników

$query = $conn->query($query_str);
$result = $query->fetchAll();

// Sprawdza czy są wyniki

$areThere = $conn->query("SELECT * FROM tasks WHERE tasks.user_id = {$_SESSION['id']}");
$areThereResult = $areThere->fetch();

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
                <a href="#" class="active">zadania</a>
                <a href="./statistics.php">statystyki</a>
                <a href="./components/log_out.php">wyloguj się</a>
            </div>
            <a href="./profile.php" class="nav--profile">
                <img src="<?="../img/custom/" . $_SESSION['picture'] ?>" alt="">
            </a>
        </div>
        <div class="nav--links nav--links__mobile ">
            <a href="../index.php">home</a>
            <a href="#" class="active">zadania</a>
            <a href="./statistics.php">statystyki</a>
            <a href="./components/log_out.php">wyloguj się</a>
        </div>
    </nav>
    <main class="main">
        <?php if (!$areThereResult): ?>
            <section class="no-tasks">
                <div class="box">
                    <img src="../img/no-tasks.png" alt="Dziewczyna patrzy się na listę rzeczy do zrobienia.">
                    <p>Co chcesz dzisiaj zrobić?</p>
                    <p>Kliknij + aby dodać swoje zadanie!</p>
                </div>
            </section>
            <?php else: ?>
            <section class="tasks">
                <div class="find-box">
                    <h2>Znajdź: </h2>
                    <a href="./tasks/refresh.php" class="btn green"><i class="ti ti-refresh"></i></a>
                    <a href="./tasks.php?search=1" class="btn blue"><i class="ti ti-x"></i></a>
                    <a href="./tasks.php?search=2" class="btn yellow"><i class="ti ti-clock-hour-11"></i></a>
                    <a href="./tasks.php?search=3" class="btn red"><i class="ti ti-checks"></i></a>
                </div>
                <div class="card-box">
                    <?php foreach ($result as $r): ?>
                        <?php if ($r[2] == 0): ?>
                            <div class="card">
                                <div class="card--top">
                                    <p><span>Treść: </span>
                                        <?= $r[1] ?>
                                    </p>
                                </div>
                                <div class="card--middle">
                                    <p><span>Status: </span> do zrobienia</p>
                                    <p><span>Priorytet: </span>
                                        <?php if ($r[3] == 3) {
                                        echo 'Wysoki';
                                    } elseif ($r[3] == 2) {
                                        echo "Średni";
                                    } else {
                                        echo "Niski";
                                    } ?>
                                    </p>
                                    <p><span>Data końcowa: </span><?= $r[4] ?> </p>
                                    <p><span>Kategoria: </span>
                                        <?= $r[5] ?>
                                    </p>
                                </div>
                                <div class="card--bottom">
                                    <a href="./tasks/checked.php?id=<?= $r[0] ?>&done=1" class="btn green"><i
                                            class="ti ti-check"></i></a>
                                    <a href="./tasks/edit.php?id=<?= $r[0] ?>" class="btn blue"><i class="ti ti-ballpen"></i></a>
                                    <a href="./tasks/delete.php?id=<?= $r[0] ?>" class="btn red"><i class="ti ti-trash"></i></a>
                                </div>
                            </div>
                            <?php endif; ?>

                        <?php if ($r[2] == 1): ?>
                            <div class="card card__done">
                                <div class="card--top">
                                    <p><span>Treść: </span>
                                        <?= $r[1] ?>

                                    </p>
                                </div>
                                <div class="card--middle">
                                    <p><span>Status: </span> do zrobienia</p>
                                    <p><span>Priorytet: </span>
                                        <?php if ($r[3] == 3) {
                                        echo 'Wysoki';
                                    } elseif ($r[3] == 2) {
                                        echo "Średni";
                                    } else {
                                        echo "Niski";
                                    } ?>
                                    </p>
                                    <p><span>Data końcowa: </span> <?= $r[4] ?></p>
                                    <p><span>Kategoria: </span>
                                        <?= $r[5] ?>
                                    </p>
                                </div>
                                <div class="card--bottom">
                                    <a href="./tasks/checked.php?id=<?= $r[0] ?>&done=0" class="btn yellow"><i
                                            class="ti ti-x"></i></a>
                                    <a href="./tasks/edit.php?id=<?= $r[0] ?>" class="btn blue"><i class="ti ti-ballpen"></i></a>
                                    <a href="./tasks/delete.php?id=<?= $r[0] ?>" class="btn red"><i class="ti ti-trash"></i></a>
                                </div>
                            </div>
                            <?php endif; ?>

                        <?php if ($r[2] == 2): ?>
                            <div class="card card__late">
                                <div class="card--top">
                                    <p><span>Treść: </span>
                                        <?= $r[1] ?>
                                    </p>
                                </div>
                                <div class="card--middle">
                                    <p><span>Status: </span> po czasie</p>
                                    <p><span>Priorytet: </span>
                                        <?php if ($r[3] == 3) {
                                        echo 'Wysoki';
                                    } elseif ($r[3] == 2) {
                                        echo "Średni";
                                    } else {
                                        echo "Niski";
                                    } ?>
                                    </p>
                                    <p><span>Data końcowa: </span> <?= $r[4] ?></p>
                                    <p><span>Kategoria: </span>
                                        <?= $r[5] ?>
                                    </p>
                                </div>
                                <div class="card--bottom">
                                    <a href="./tasks/checked.php?id=<?= $r[0] ?>&done=1" class="btn green"><i
                                            class="ti ti-check"></i></a>
                                    <a href="./tasks/edit.php?id=<?= $r[0] ?>" class="btn blue"><i class="ti ti-ballpen"></i></a>
                                    <a href="./tasks/delete.php?id=<?= $r[0] ?>" class="btn red"><i class="ti ti-trash"></i></a>
                                </div>
                            </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                </div>
            </section>
            <?php endif; ?>
    </main>
    <footer class="settings">
        <a href="./add_task.php" class="circle">
            <i class="ti ti-circle-plus"></i>
        </a>
    </footer>
    <script src="../js/main.js"></script>
</body>

</html>