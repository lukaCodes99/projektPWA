<!DOCTYPE html>
<html>

<?php
$dbc = mysqli_connect('localhost', 'root', '', 'korisnici') or die('Error connecting to MySQL server.' . mysqli_connect_error());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $razina = 0;

    // Provjeri postoji li korisničko ime u bazi
    $checkQuery = "SELECT * FROM users WHERE korisnicko_ime = ?";
    $stmt = mysqli_prepare($dbc, $checkQuery);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo "Korisnik s tim korisničkim imenom već postoji";
    } else {
        // Generiraj hash lozinke
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Unesi novog korisnika u bazu
        $insertQuery = "INSERT INTO users (ime, prezime, korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($dbc, $insertQuery);
        mysqli_stmt_bind_param($stmt, "ssssd", $ime, $prezime, $username, $hashedPassword, $razina);
        mysqli_stmt_execute($stmt);

        echo "Registracija je uspješna";
    }
}

mysqli_close($dbc);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Website</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
    <style>
       
        .container {
            text-align: center;
            margin: 0 auto;
            width: 40%;
        }

        h2 {
            margin-bottom: 20px;
        }

        form {
            width: 90%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f5f5f5;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin: 0 auto;
        }

        input[type="submit"] {
            width: 50%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <header>
        <h1>Luka's news</h1>
        <nav>
            <ul>
                <li><a href="index.php"><span>Naslovna</span></a></li>
                <li><a href="sport.php"><span>Sport</span></a></li>
                <li><a href="kultura.php"><span>Kultura</span></a></li>
                <li><a href="administracija.php"><span>Administracija</span></a></li>
                <li><a href="#"><span>Registracija</span></a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h2>Registracija</h2>
        <form method="post" action="registracija.php">
            <label for="ime">Ime:</label>
            <input type="text" name="ime" required><br><br>
            <label for="prezime">Prezime:</label>
            <input type="text" name="prezime" required><br><br>
            <label for="username">Korisničko ime:</label>
            <input type="text" name="username" required><br><br>
            <label for="password">Lozinka:</label>
            <input type="password" name="password" required><br><br>
            <input type="submit" value="Registriraj se">
        </form>
    </div>
</body>


</html>
