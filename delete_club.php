<?php
require('./lib/pdo.php');

// Check if the club id is provided in the URL
if (isset($_GET['id'])) {
    $club_id = $_GET['id'];

    try {
        // Prepare the SQL DELETE query with the club id
        $stmt = $pdo->prepare("DELETE FROM book_clubs WHERE club_id = :club_id");

        // Bind the club_id parameter
        $stmt->bindParam(':club_id', $club_id, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Redirect back to the admin page after deletion
        header("Location: admin_page.php");
        exit;

    } catch (Exception $e) {
        // Handle any errors
        echo "Error deleting club: " . $e->getMessage();
    }
} else {
    // If no club id is provided in the URL, show an error message
    echo "No club ID specified.";
}
