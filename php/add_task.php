<?php
session_start();
if (!$_SESSION['logged']) {
    header("Location: log_in.php");
}

require './components/connection.php';

$query_str = "SELECT categories.name FROM categories WHERE categories.user_id = {$_SESSION['id']}";
$query = $conn->query($query_str);
$result = $query->fetchAll();

if (!$result) {
    header("Location: ./add_category.php?desc=Najpierw dodaj kategorie!");
}

$description = $_POST['description'] ?? NULL;
$priority = $_POST['priority'] ?? NULL;
$end_date = $_POST['end_date'] ?? NULL;
$task_category = $_POST['task_category'] ?? NULL;

$conn = NULL;

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
                <a href="./tasks.php" class="active">zadania</a>
                <a href="./statistics.php">statystyki</a>
                <a href="./components/log_out.php">wyloguj się</a>
            </div>
            <a href="./profile.php" class="nav--profile">
                <img src="<?="../img/custom/" . $_SESSION['picture'] ?>" alt="">
            </a>
        </div>
        <div class="nav--links nav--links__mobile ">
            <a href="../index.php">home</a>
            <a href="./tasks.php" class="active">zadania</a>
            <a href="#">statystyki</a>
            <a href="#">wyloguj się</a>
        </div>
    </nav>
    <main class="main">
        <section class="add">
            <form method="POST" action="./components/add_task_sys.php">
                <h1>Dodaj zadanie!</h1>
                <p>Treść zadania <span>*</span></p>
                <input type="text" placeholder="Treść zadania" name="description" id="description" required>
                <p>Priorytet <span>*</span></p>
                <select name="priority" id="priority" required>
                    <option value="">Priorytet</option>
                    <option value="1">Niski</option>
                    <option value="2">Średni</option>
                    <option value="3">Wysoki</option>
                </select>
                <p>Data końcowa <span>*</span></p>
                <input type="date" name="end_date" id="end_date" required>
                <p class="">Kategoria<span>*</span></p>
                <select name="task_category" id="task_category" required>
                    <option value="">Kategoria</option>
                    <?php
                    foreach ($result as $r):
                        ?>
                        <option value="<?= $r[0] ?>">
                            <?= $r[0] ?>
                        </option>
                        <?php endforeach ?>
                </select>
                <a href="./add_category.php">Dodaj kategorie</a>
                <button type="submit">Dodaj</button>
            </form>
        </section>
    </main>
    <footer class="settings">
        <a href="#" class="circle">
            <i class="ti ti-circle-plus"></i>
        </a>
    </footer>
    <script src="../js/main.js"> </script>
</body>

</html>