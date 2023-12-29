<?php
// deletebook.php

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the bookid parameter is set
    if (isset($_POST['bookid'])) {
        $bookId = $_POST['bookid'];

        // Perform the deletion query
        $sql = "DELETE FROM bookinfo WHERE bookid = $bookId";
        if ($conn->query($sql) === TRUE) {
            // Return success if the deletion is successful
            echo 'success';
        } else {
            // Return an error message if there's an issue with the query
            echo 'error';
        }
    } else {
        // Return an error message if bookid parameter is not set
        echo 'error';
    }
} else {
    // Return an error message for non-POST requests
    echo 'error';
}

$conn->close();
?>
