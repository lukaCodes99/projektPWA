<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in
    if (isset($_SESSION['razina'])) {
        // Check if the article ID is provided
        if (isset($_POST['articleId'])) {
            $articleId = $_POST['articleId'];

            // Perform the deletion operation
            $dbc = mysqli_connect('localhost', 'root', '', 'clanci') or die('Error connecting to MySQL server.' . mysqli_connect_error());
            $deleteQuery = "DELETE FROM clanak WHERE id = $articleId";
            $result = mysqli_query($dbc, $deleteQuery);

            // Check if the deletion was successful
            if ($result) {
                echo 'Article deleted successfully.';
            } else {
                echo 'Error deleting the article: ' . mysqli_error($dbc);
            }

            // Close the database connection
            mysqli_close($dbc);
        } else {
            echo 'Article ID is missing.';
        }
    } else {
        echo 'User is not logged in.';
    }
} else {
    echo 'Invalid request.';
}
?>
