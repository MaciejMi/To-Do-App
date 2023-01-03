<?php
session_start();
if (!$_SESSION['logged']) {
    header("Location: ../log_in.php");
}

$task_id = $_GET['id'] ?? NULL;
if (is_null($task_id)) {
    header('Location: ../tasks.php');
}
require '../components/connection.php';
$query_str = "SELECT * FROM tasks WHERE tasks.id = {$task_id} AND tasks.user_id = {$_SESSION['id']}";
$query = $conn->query($query_str);
$result = $query->fetch();

$priority_list = array(array('Niski', 1), array('Średni', 2), array('Wysoki', 3));
$query_str_2 = "SELECT * FROM categories WHERE user_id = {$_SESSION['id']}";
$query_2 = $conn->query($query_str_2);
$result2 = $query_2->fetchAll();

$description = $_POST['description'] ?? NULL;
$priority = $_POST['priority'] ?? NULL;
$end_date = $_POST['end_date'] ?? NULL;
$task_category = $_POST['task_category'] ?? NULL;

if (!is_null($description) and !is_null($priority) and !is_null($end_date) and !is_null($task_category)) {
    $query_str_3 = "UPDATE tasks SET description = '{$description}', priority = '{$priority}', end_date = '{$end_date}', categories_name = '{$task_category}' WHERE tasks.id = {$task_id} AND tasks.user_id = {$_SESSION['id']}";
    $query_3 = $conn->query($query_str_3);
    header('Location: ../tasks/refresh.php');
}

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
    <title>To Do App</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <nav class="nav position-fixed">
        <div class="wrapper">
            <a href="../../index.php" class="nav--title">To Do App</a>
            <button class="nav--menu">
                <div class="bars"></div>
            </button>
            <div class="nav--links nav--links__desktop ">
                <a href=".././tasks.php" class="active">zadania</a>
                <a href=".././statistics.php">statystyki</a>
                <a href=".././components/log_out.php">wyloguj się</a>
            </div>
            <a href=".././profile.php" class="nav--profile">
                <img src="<?="../../img/custom/" . $_SESSION['picture'] ?>" alt="">
            </a>
        </div>
        <div class="nav--links nav--links__mobile ">
            <a href="../../index.php">home</a>
            <a href=".././tasks.php" class="active">zadania</a>
            <a href=".././statistics.php">statystyki</a>
            <a href=".././components/log_out.php">wyloguj się</a>
        </div>
    </nav>
    <main class="main">
        <section class="add">
            <form method="POST">
                <h1>Edytuj zadanie!</h1>
                <p>Treść zadania <span>*</span></p>
                <input type="text" placeholder="Treść zadania" name="description" id="description"
                    value="<?= $result[1] ?>" required>
                <p>Priorytet <span>*</span></p>
                <select name="priority" id="priority" required>
                    <option value="">Priorytet</option>
                    <?php foreach ($priority_list as $p): ?>
                        <?php if ($result[3] == $p[1]): ?>
                            <option value="<?= $p[1] ?>" selected>
                                <?= $p[0] ?>
                            </option>
                            <?php else: ?>
                            <option value="<?= $p[1] ?>">
                                <?= $p[0] ?>
                            </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                </select>
                <p>Data końcowa <span>*</span></p>
                <input type="date" name="end_date" id="end_date" value='<?= $result[4] ?>' required>
                <p class="">Kategoria<span>*</span></p>
                <select name="task_category" id="task_category" required>
                    <option value="">Kategoria</option>
                    <?php foreach ($result2 as $r): ?>
                        <?php if ($r[0] == $result[5]): ?>
                            <option value="<?= $r[0] ?>" selected>
                                <?= $r[0] ?>
                            </option>
                            <?php else: ?>
                            <option value="<?= $r[0] ?>">
                                <?= $r[0] ?>
                            </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                </select>
                <a href=" #">Dodaj kategorie</a>
                <button type="submit">Edytuj</button>
            </form>
        </section>
    </main>
    <footer class="settings">
        <a href="add.html" class="circle">
            <i class="ti ti-circle-plus"></i>
        </a>
    </footer>
    <script src="../../js/main.js"></script>
</body>

</html>