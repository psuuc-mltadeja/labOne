<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Add Book</h2>
    <form id="addForm" action="addbook.php" method="post">
        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn">
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="mb-3">
            <label for="classification" class="form-label">Classification</label>
            <input type="text" class="form-control" id="classification" name="classification">
        </div>
        <div class="mb-3">
            <label for="publisher" class="form-label">Publisher</label>
            <input type="text" class="form-control" id="publisher" name="publisher">
        </div>
        <button type="submit" class="btn btn-primary">Add Book</button>
    </form>

    <!-- Book List Table -->
    <h2 class="mt-5">Book List</h2>
    <table id="bookTable" class="display">
        <thead>
            <tr>
                <th>ISBN</th>
                <th>Title</th>
                <th>Classification</th>
                <th>Publisher</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
</div>

<!-- Include scripts -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="main.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        var dataTable = $('#bookTable').DataTable({
            ajax: {
                url: 'getbook.php',
                dataSrc: ''
            },
            columns: [
                { data: 'isbn', type: 'num' },
                { data: 'title', type: 'string' },
                { data: 'classification', type: 'string' },
                { data: 'publisher', type: 'string' },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                            <button class="btn btn-danger delete">Delete</button>
                            <a class="btn btn-primary" href="edit.php?bookid=${data.bookid}">Edit</a>
                        `;
                    }
                }
            ]
        });

        // Add Book - AJAX
        $('#addForm').submit(function(event) {
            event.preventDefault();

            // Check if any required fields are empty before submitting the form
            var isbn = $('#isbn').val();
            var title = $('#title').val();
            var classification = $('#classification').val();
            var publisher = $('#publisher').val();

            if (isbn === '' || title === '' || classification === '' || publisher === '') {
                // Display an error message if any required field is empty
                Swal.fire({
                    title: 'Error!',
                    text: 'Please fill in all required fields',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            } else {
                // Proceed with form submission if all required fields are filled
                $.ajax({
                    type: 'POST',
                    url: 'addbook.php',
                    data: $(this).serialize(),
                    success: function(response) {
                        // Use SweetAlert for displaying success/error message
                        if (response === 'success') {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Book added successfully',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Clear the DataTable and reload data
                                    dataTable.clear().draw();
                                    dataTable.ajax.reload();

                                    // Clear the form
                                    $('#addForm')[0].reset();
                                }
                            });
                        } else if (response === 'error_database') {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Error adding book to the database',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Unexpected error occurred',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    }
                });
            }
        });

        // Fetch Book List - AJAX
        function fetchBookList() {
            dataTable.ajax.reload();
        }

        $('#bookTable tbody').on('click', 'button.delete', function() {
            var data = dataTable.row($(this).parents('tr')).data();

            // Open the delete confirmation modal
            $('#deleteModal').modal('show');

            // Set the data-id attribute of the confirm delete button
            $('#confirmDelete').attr('data-id', data.bookid);
        });

        // Add event listener for confirm delete button click
        $('#confirmDelete').on('click', function() {
            var bookId = $(this).attr('data-id');

            $.ajax({
                type: 'POST',
                url: 'delete.php',
                data: { bookid: bookId },
                success: function(response) {
                    // Handle success or display an alert
                    if (response === 'success') {
                        // Show SweetAlert for success
                        Swal.fire({
                            title: 'Success!',
                            text: 'Book deleted successfully',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                fetchBookList();
                                $('#deleteModal').modal('hide');
                            }
                        });
                    } else {
                        // Optionally show an error message
                        Swal.fire({
                            title: 'Error!',
                            text: 'Error deleting book',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            });
        });
    });
</script>

<!-- Add a modal for delete confirmation -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this book?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>
