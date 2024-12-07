<?php
require('./lib/pdo.php');

// Check if the book id is provided in the URL
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];

    try {
        // Prepare the SQL DELETE query with the book id
        $stmt = $pdo->prepare("DELETE FROM books WHERE book_id = :book_id");

        // Bind the book_id parameter
        $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Redirect back to the admin page after deletion
        header("Location: admin_page.php");
        exit;

    } catch (Exception $e) {
        // Handle any errors
        echo "Error deleting book: " . $e->getMessage();
    }
} else {
    // If no book id is provided in the URL, show an error message
    echo "No book ID specified.";
}
