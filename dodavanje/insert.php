<?php
session_start();

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clanci";

// Create connection
$dbc = mysqli_connect($servername, $username, $password, $dbname) or die('Error connecting to MySQL server.' . mysqli_connect_error());

// Check if the user is logged in and their razina value
if (isset($_SESSION['razina']) && $_SESSION['razina'] == 1) {
    $korisnicko_ime = $_SESSION['username'];

    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Get form inputs
        $title = $_POST['title'];
        $summary = $_POST['summary'];
        $content = $_POST['content'];
        $pphoto = $_FILES['pphoto']['name'];
        $category = $_POST['category'];

        // File upload
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["pphoto"]["name"]);
        move_uploaded_file($_FILES["pphoto"]["tmp_name"], $targetFile);

        // Insert data into the "clanak" table
        $insertQuery = "INSERT INTO clanak (datum, naslov, sazetak, tekst, slika, kategorija, arhiva) 
                        VALUES (NOW(), '$title', '$summary', '$content', '$pphoto', '$category', 0)";
        mysqli_query($dbc, $insertQuery);

        // Close the database connection
        mysqli_close($dbc);

        // Redirect to a success page or do further processing
        header('Location: success.php');
        exit();
    }

    // Close the database connection
    mysqli_close($dbc);
} else {
    // User does not have razina 1, display an error message or redirect
    echo 'You do not have sufficient privileges to access this page.';
    exit();
}
?>
