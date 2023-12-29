$(document).ready(function() {
    // Add event listener for the Update Book button click
    $('#updateBook').click(function() {
        // Get the form data
        var bookId = $('#editForm input[name="bookid"]').val();
        var isbn = $('#editIsbn').val();
        var title = $('#editTitle').val();
        var classification = $('#editClassification').val();
        var publisher = $('#editPublisher').val();

        // Create the data object for the AJAX request
        var data = {
            bookid: bookId,
            isbn: isbn,
            title: title,
            classification: classification,
            publisher: publisher
        };

        // Make the AJAX request
        $.ajax({
            type: 'POST',
            url: 'updatebook.php', // Adjust the URL based on your project structure
            data: data,
            success: function(response) {
                // Handle success or display an alert
                if (response === 'success') {
                    // Show SweetAlert for success
                    Swal.fire({
                        title: 'Success!',
                        text: 'Book updated successfully',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect or perform any other action as needed
                            window.location.href = 'index.php'; // Adjust the URL based on your project structure
                        }
                    });
                } else {
                    // Optionally show an error message
                    Swal.fire({
                        title: 'Error!',
                        text: 'Error updating book',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });
    });
});
