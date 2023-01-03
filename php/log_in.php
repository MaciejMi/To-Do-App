<?php
require './components/isLogged.php';


$login = $_POST['login'] ?? NULL;
$password = $_POST['password'] ?? NULL;

if (!isset($error)) {
    $error = '';
}

if (isset($login) and isset($password)) {
    require './components/connection.php';
    $query_str = "SELECT users.id,
                         users.login,
                         users.password,
                         users.picture
                    FROM users
                    WHERE users.login = '{$login}' AND users.password = '{$password}'";
    $query = $conn->query($query_str);
    $result = $query->fetch();
    if ($result) {
        $_SESSION['logged'] = true;
        $_SESSION['id'] = $result[0];
        $_SESSION['login'] = $result[1];
        $_SESSION['picture'] = $result[3];
        header('Location:tasks.php');
    } else {
        $error = 'Użytkownik z podanym loginem i hasłem nie istnieje!';
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
    <main class="main">
        <section class="login">
            <div class="box">
                <h1>Zaloguj się</h1>
                <img src="../img/log in.png"
                    alt="Zdjęcie przedstawiającego człowieka z dużym złotym kluczem próbującego włożyć go do kłódki. Kolory tego zdjęcia są zimne.">
                <form method="POST">
                    <p>Nazwa użytkownika <span>*</span></p>
                    <input type="text" placeholder="Login" name="login" id="login" required>
                    <p>Hasło użytkownika <span>*</span></p>
                    <input type="password" placeholder="Hasło" name="password" id="password" required>
                    <a href="./sign_up.php">Nie masz konta?</a>
                    <p class="error">
                        <?= $error ?>
                    </p>
                    <button type="submit">Zaloguj</button>
                </form>
            </div>
        </section>
    </main>
</body>

</html>