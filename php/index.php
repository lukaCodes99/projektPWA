<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Website</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
</head>
<body>
    <header> 
        <h1>Luka's news</h1>  
        <nav >        
                <ul >
                    <li><a href="#"><span>Naslovna</span></a></li>
                    <li><a href="sport.php"><span>Sport</span></a></li>
                    <li><a href="kultura.php"><span>Kultura</span></a></li>
                    <li><a href="administracija.php"><span>Administracija</span></a></li>
                    <li><a href="registracija.php"><span>Registracija</span></a></li>
                </ul>       
        </nav>
    </header>
    <main>
    <div class="clanci">
            <h2>Sport</h2>
            <div class="holder">
                <?php
                // Connect to the database
                $dbc = mysqli_connect('localhost', 'root', '', 'clanci') or die('Error connecting to MySQL server.' . mysqli_connect_error());

                // Fetch the data from the "articles" table
                $query = "SELECT * FROM clanak WHERE kategorija = 'Sport' AND arhiva = 0 LIMIT 4";
                $result = mysqli_query($dbc, $query);

                // Check if the query executed successfully
                if ($result) {
                    // Loop through the fetched data and display it
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="clanak">';
                        echo '<img src="' . $row['slika'] . '" alt="Naslovna slika" class="slika">';
                        echo '<p>' . $row['sazetak'] . '</p>';
                        echo '</div>';
                    }
                } else {
                    // Display the SQL error message
                    echo 'Error executing the query: ' . mysqli_error($dbc);
                }

                // Close the database connection
                mysqli_close($dbc);

                ?>
            </div>
        </div>

        <div class="clanci">
            <h2>Kultura</h2>
            <div class="holder">
                <?php
                // Connect to the database
                $dbc = mysqli_connect('localhost', 'root', '', 'clanci') or die('Error connecting to MySQL server.' . mysqli_connect_error());

                // Fetch the data from the "articles" table
                $query = "SELECT * FROM clanak WHERE kategorija = 'Kultura' AND arhiva = 0 LIMIT 4";
                $result = mysqli_query($dbc, $query);

                // Check if the query executed successfully
                if ($result) {
                    // Loop through the fetched data and display it
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="clanak">';
                        echo '<img src="' . $row['slika'] . '" alt="Naslovna slika" class="slika">';
                        echo '<p>' . $row['sazetak'] . '</p>';
                        echo '</div>';
                    }
                } else {
                    // Display the SQL error message
                    echo 'Error executing the query: ' . mysqli_error($dbc);
                }

                // Close the database connection
                mysqli_close($dbc);

                ?>
            </div>
        </div>

        
    </main>
    <footer>
        <p>Luka Maletić</p>
        <p>mail@mail.com</p>
        <p>2023</p>
    </footer>
</body>
</html>
