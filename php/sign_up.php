<?php
require './components/isLogged.php';
$error = $_GET['error'] ?? NULL;
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
        <section class="login login__signup">
            <div class="box">
                <h1>Zarejestruj się</h1>
                <form method="POST" action="./components/add_account.php" enctype="multipart/form-data">
                    <p>Zdjęcie <span>*</span></p>
                    <input type="file" placeholder="Dodaj zdjęcie" id="image" name="image"
                        accept="image/jpg, image/jpeg, image/png" required />
                    <p>Nazwa użytkownika <span>*</span></p>
                    <input type="text" name="login" id="login" placeholder="Login" minlength="4" maxlength="50"
                        required>
                    <p>Hasło użytkownika <span>*</span></p>
                    <input type="password" name="password" id="password" placeholder="Hasło" minlength="8"
                        maxlength="75" required>
                    <a href="./log_in.php">Masz już konto?</a>
                    <p class="error">
                        <?= $error ?>
                    </p>
                    <button type="submit">Zarejestruj</button>
                </form>
            </div>
        </section>
    </main>
</body>

</html>