<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $classification = $_POST['classification'];
    $publisher = $_POST['publisher'];

    // Add other form fields as needed

    // Check if any of the required fields are empty
    if ($isbn == "" || $title == "" || $classification == "" || $publisher == "") {
        echo 'error_empty_fields';
    } else {
        // Perform the database insertion
        $sql = "INSERT INTO BookInfo (isbn, title, classification, publisher) VALUES ('$isbn', '$title', '$classification', '$publisher')";

        // Execute the query and handle the response
        if ($conn->query($sql) === TRUE) {
            echo 'success'; // Return a success message
        } else {
            echo 'error_database'; // Return an error message for database insertion
        }
    }
}

$conn->close();
?>
