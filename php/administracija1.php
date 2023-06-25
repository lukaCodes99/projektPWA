<?php
session_start();
$dbc = mysqli_connect('localhost', 'root', '', 'clanci') or die('Error connecting to MySQL server.' . mysqli_connect_error());

// Check if the user is logged in and their razina value
if (isset($_SESSION['razina']) && $_SESSION['razina'] == 1) {
    $korisnicko_ime = $_SESSION['username'];

    // Function to toggle the "arhiva" value for an article
    function toggleArhiva($articleId, $currentArhivaValue) {
        $newArhivaValue = ($currentArhivaValue == 0) ? 1 : 0;

        // Update the "arhiva" value in the database
        $updateQuery = "UPDATE clanak SET arhiva = $newArhivaValue WHERE id = $articleId";
        mysqli_query($GLOBALS['dbc'], $updateQuery);

        // Reload the page to see the updated values
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }

    // Fetch the data from the "clanak" table
    $query = "SELECT * FROM clanak WHERE kategorija = 'Sport' OR kategorija = 'Kultura' ORDER BY kategorija";
    $result = mysqli_query($dbc, $query);

    // Check if the query executed successfully
    if ($result) {
        // Create an array to hold the articles
        $articles = array();

        // Loop through the fetched data and store it in the array
        while ($row = mysqli_fetch_assoc($result)) {
            $articles[] = $row;
        }

        // Close the database connection
        mysqli_close($dbc);
    } else {
        // Display the SQL error message
        echo 'Error executing the query: ' . mysqli_error($dbc);
        mysqli_close($dbc);
        exit();
    }
} else {
    // User does not have razina 1, display a greeting message
    echo '<header>
            <h1>Luka\'s news</h1>
            <nav>
                <ul>
                    <li><a href="index.php"><span>Naslovna</span></a></li>
                    <li><a href="sport.php"><span>Sport</span></a></li>
                    <li><a href="kultura.php"><span>Kultura</span></a></li>
                    <li><a href="#"><span>Administracija</span></a></li>
                    <li><a href="registracija.php"><span>Registracija</span></a></li>
                </ul>
            </nav>
        </header>';

    echo '<h2>Dobrodošli, ' . $_SESSION['username'] . '!</h2>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Website</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .clanak {
            width: 23%;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        .slika {
            max-width: 100%;
        }
    </style>
    <script>
        // JavaScript function to toggle the "arhiva" value for an article
        function toggleArhiva(articleId, currentArhivaValue) {
            // Send an AJAX request to the server to toggle the value
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Reload the page to see the updated values
                    location.reload();
                }
            };
            xhr.open('POST', 'toggle_arhiva.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('articleId=' + articleId + '&currentArhivaValue=' + currentArhivaValue);
        }
    </script>
</head>
<body>
    <header>
        <h1>Luka's news</h1>
        <nav>
            <ul>
                <li><a href="index.php"><span>Naslovna</span></a></li>
                <li><a href="sport.php"><span>Sport</span></a></li>
                <li><a href="kultura.php"><span>Kultura</span></a></li>
                <li><a href="#"><span>Administracija</span></a></li>
                <li><a href="registracija.php"><span>Registracija</span></a></li>
            </ul>
        </nav>
        <div>
            <button onclick="location.href='brisanje.php'">Brisanje</button>
            <button onclick="location.href='../dodavanje/insert.html'">Dodavanje</button>
        </div>
    </header>

    <div class="container">
        <?php
        // Loop through the articles and display them
        foreach ($articles as $article) {
            echo '<div class="clanak">';
            echo '<img src="' . $article['slika'] . '" alt="Naslovna slika" class="slika">';
            echo '<p>' . $article['sazetak'] . '</p>';

            // Display the toggle button based on the "arhiva" value
            $articleId = $article['id'];
            $arhivaValue = $article['arhiva'];
            $toggleButtonText = ($arhivaValue == 0) ? 'Arhiviraj' : 'Arhivirano';
            echo '<button onclick="toggleArhiva(' . $articleId . ', ' . $arhivaValue . ')">' . $toggleButtonText . '</button>';

            echo '</div>';
        }
        ?>
    </div>

    <footer>
        <p>Luka Maletić</p>
        <p>mail@mail.com</p>
        <p>2023</p>
    </footer>
</body>
</html>
