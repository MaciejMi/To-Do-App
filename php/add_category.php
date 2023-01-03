<?php
session_start();
if (!$_SESSION['logged']) {
    header("Location: log_in.php");
}

$category = $_POST['category'] ?? NULL;

if (!isset($error)) {
    $error = '';
}

$desc = $_GET['desc'] ?? NULL;

if (isset($category)) {
    try {
        require './components/connection.php';
        $query = "INSERT INTO categories(name, user_id) VALUES('{$category}', {$_SESSION['id']})";
        $result = $conn->query($query);
        $conn = NULL;
        header("Location: add_task.php");
    } catch (PDOException $e) {
        $error = 'Taka kategoria już istnieje!';
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
            <a href="./statistics.php">statystyki</a>
            <a href="./components/log_out.php">wyloguj się</a>
        </div>
    </nav>
    <main class="main">
        <section class="add">
            <form method="POST">
                <h1>Dodaj kategorie!</h1>
                <p class="">Kategoria<span>*</span></p>
                <input type="text" name="category" id="category" placeholder="Kategoria" required>
                <p class="error">
                    <?= $error ?>
                </p>
                <p class="error">
                    <?= $desc ?>
                </p>
                <button type="submit">Dodaj</button>
            </form>
        </section>
    </main>
    <footer class="settings">
        <a href="./add_task.php" class="circle">
            <i class="ti ti-circle-plus"></i>
        </a>
    </footer>
    <script src="../js/main.js"> </script>
</body>

</html>