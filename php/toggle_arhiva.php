<?php
session_start();
$dbc = mysqli_connect('localhost', 'root', '', 'clanci') or die('Error connecting to MySQL server.' . mysqli_connect_error());

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['razina']) && $_SESSION['razina'] == 1) {
    $articleId = $_POST['articleId'];
    $currentArhivaValue = $_POST['currentArhivaValue'];

    // Toggle the "arhiva" value
    $newArhivaValue = ($currentArhivaValue == 0) ? 1 : 0;

    // Update the "arhiva" value in the database
    $updateQuery = "UPDATE clanak SET arhiva = $newArhivaValue WHERE id = $articleId";
    $result = mysqli_query($dbc, $updateQuery);

    if ($result) {
        // Success message
        echo 'Toggle successful';
    } else {
        // Error message
        echo 'Error toggling the value: ' . mysqli_error($dbc);
    }
}

mysqli_close($dbc);
?>
