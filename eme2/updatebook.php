<?php
// updatebook.php

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the required parameters are set
    if (isset($_POST['bookid'], $_POST['isbn'], $_POST['title'], $_POST['classification'], $_POST['publisher'])) {
        $bookId = $_POST['bookid'];
        $isbn = $_POST['isbn'];
        $title = $_POST['title'];
        $classification = $_POST['classification'];
        $publisher = $_POST['publisher'];

        // Perform the update query
        $sql = "UPDATE bookinfo SET isbn = '$isbn', title = '$title', classification = '$classification', publisher = '$publisher' WHERE bookid = $bookId";

        if ($conn->query($sql) === TRUE) {
            // Return success if the update is successful
            echo 'success';
        } else {
            // Return an error message if there's an issue with the query
            echo 'error';
        }
    } else {
        // Return an error message if required parameters are not set
        echo 'error';
    }
} else {
    // Return an error message for non-POST requests
    echo 'error';
}

$conn->close();
?>
