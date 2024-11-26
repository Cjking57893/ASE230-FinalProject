<?php

function edit_book($book_title, $new_book_title, $new_book_author, $new_book_year, $new_book_description) {
    $filePath = 'data/book_list.json';

    // Reading the JSON file and decoding it into a PHP array
    $jsonData = file_get_contents($filePath);
    $bookArray = json_decode($jsonData, true);

    // Check if JSON decoding was successful
    if ($bookArray === null) {
        die('Error decoding JSON');
    }

    // Flag to track if the book was found
    $bookFound = false;

    // Loop through the array to find the book with the matching title
    foreach ($bookArray as &$book) {
        if (strcasecmp($book['title'], $book_title) == 0) {
            // Book found, update the details
            $book['title'] = $new_book_title;
            $book['author'] = $new_book_author;
            $book['year'] = (int)$new_book_year;
            $book['description'] = $new_book_description;
            $bookFound = true;
            break;
        }
    }

    if (!$bookFound) {
        die('Book not found');
    }

    // Re-encode the array back into JSON
    $newJsonData = json_encode(array_values($bookArray), JSON_PRETTY_PRINT);

    // Saving updated JSON back into the file
    file_put_contents($filePath, $newJsonData);

}

function edit_club($club_name, $new_club_name, $new_club_leader, $new_club_description) {
    $filePath = 'data/book_club_list.json'; 

    // Reading the JSON file and decoding it into a PHP array
    $jsonData = file_get_contents($filePath);
    $clubArray = json_decode($jsonData, true);

    // Check if JSON decoding was successful
    if ($clubArray === null) {
        die('Error decoding JSON');
    }

    // Flag to track if the club was found
    $clubFound = false;

    // Loop through the array to find the club with the matching name
    foreach ($clubArray as &$club) {
        if (strcasecmp($club['name'], $club_name) == 0) {
            // Club found, update the details
            $club['name'] = $new_club_name;
            $club['leader'] = $new_club_leader;
            $club['description'] = $new_club_description;
            $clubFound = true;
            break;
        }
    }

    // If the club was not found, return an error message
    if (!$clubFound) {
        die('Club not found');
    }

    // Re-encode the array back into JSON
    $newJsonData = json_encode(array_values($clubArray), JSON_PRETTY_PRINT);

    // Saving updated JSON back into the file
    file_put_contents($filePath, $newJsonData);

}
