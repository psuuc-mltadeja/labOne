<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Book</h2>
    <?php 
        require 'config.php';
        if(isset($_GET['bookid'])){
            $id = $_GET['bookid'];
            $stmt = "SELECT * FROM bookinfo WHERE bookid = $id";
            $container = $conn->query($stmt);

            while ($bookDetails = $container->fetch_assoc()) {
    ?>
    <form id="editForm" action="javascript:void(0);" method="post">
        <input type="hidden" name="bookid" value="<?php echo $id ?>">
        <div class="mb-3">
            <label for="editIsbn" class="form-label">ISBN</label>
            <input type="text" class="form-control" id="editIsbn" name="isbn" value="<?php echo $bookDetails['isbn']; ?>">
        </div>
        <div class="mb-3">
            <label for="editTitle" class="form-label">Title</label>
            <input type="text" class="form-control" id="editTitle" name="title" value="<?php echo $bookDetails['title']; ?>">
        </div>
        <div class="mb-3">
            <label for="editClassification" class="form-label">Classification</label>
            <input type="text" class="form-control" id="editClassification" name="classification" value="<?php echo $bookDetails['classification']; ?>">
        </div>
        <div class="mb-3">
            <label for="editPublisher" class="form-label">Publisher</label>
            <input type="text" class="form-control" id="editPublisher" name="publisher" value="<?php echo $bookDetails['publisher']; ?>">
        </div>
        <button type="button" class="btn btn-primary" id="updateBook">Update Book</button>
    </form>
    <?php
            }
        }
    ?>
</div>

<!-- Include scripts -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="updatebook.js"></script> <!-- Assuming you have a separate JS file for updatebook -->
</body>
</html>
