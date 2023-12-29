<?php
require 'config.php';

$sql = "SELECT * FROM bookinfo order by bookid desc";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $books = array();
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }

    // Return the JSON response
    echo json_encode($books);
} else {
    // Return an empty array if no books found
    echo json_encode(array());
}

$conn->close();
?>
