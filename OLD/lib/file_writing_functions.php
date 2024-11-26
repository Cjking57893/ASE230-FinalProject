<?php
    //funciton saves books to users list
    function write_book_to_user_list($read_path, $write_path, $book_title): void{
                $content = file_get_contents($read_path);
                    //decode json file and store it
                    $json_array = json_decode($content,true);
                    
                    //loop through json file to find the object we want
                    foreach($json_array as $book){
                        if($book['title'] == $book_title){
                            //put necessary elements into a php array to be encoded and written to a file
                            $data_to_write = [
                                'title' => "$book[title]", 
                                'author' => "$book[author]", 
                                'year' => "$book[year]" , 
                                'description' => "$book[description]"
                            ];
                            break;
                        }
                    }
                     // Only proceed if we found the book to write
                    if ($data_to_write !== null) {
                        // Check if the user's book list already exists
                        if (file_exists($write_path)) {
                            // Read existing user book list
                            $existing_user_books = json_decode(file_get_contents($write_path), true);
                            // Check for duplicates
                            foreach ($existing_user_books as $user_book) {
                                if ($user_book['title'] === $book_title) {
                                    return; // Book already exists in the user's list
                                }
                            }
                            // Add the new book to the existing list
                            $existing_user_books[] = $data_to_write;
                        } else {
                            // Create a new list with the book
                            $existing_user_books = [$data_to_write];
                        }

                        // Write the complete user book list back to the file
                        file_put_contents($write_path, json_encode($existing_user_books, JSON_PRETTY_PRINT));
                    }
            }
            //function to delete books from user list
            function delete_book_from_user_list($write_path, $book_title): void {
                // Check if the user's book list exists
                if (file_exists($write_path)) {
                    // Read existing user book list
                    $existing_user_books = json_decode(file_get_contents($write_path), true);
                    
                    // Create a new array to hold the remaining books
                    $updated_user_books = [];
                    $book_found = false; // Flag to track if the book was found
            
                    // Loop through the existing user books
                    foreach ($existing_user_books as $user_book) {
                        // If the book title matches, we skip adding it to the new array
                        if ($user_book['title'] === $book_title) {
                            $book_found = true; // Mark that we found the book
                            continue; // Skip this book
                        }
                        // Add other books to the updated list
                        $updated_user_books[] = $user_book;
                    }
            
                    // If the book was found, update the file
                    if ($book_found) {
                        // Write the updated user book list back to the file
                        file_put_contents($write_path, json_encode($updated_user_books, JSON_PRETTY_PRINT));
                    }
                }
            }
            //funciton saves clubs to users list
            function write_club_to_user_list($read_path, $write_path, $club_name): void{
                $content = file_get_contents($read_path);
                    //decode json file and store it
                    $json_array = json_decode($content,true);
                    
                    //loop through json file to find the object we want
                    foreach($json_array as $club){
                        if($club['name'] == $club_name){
                            //put necessary elements into a php array to be encoded and written to a file
                            $data_to_write = [
                                'name' => $club['name'], 
                                'leader' => $club['leader'], 
                                'description' => $club['description'] , 
                            ];
                            break;
                        }
                    }
                     // Only proceed if we found the book to write
                    if ($data_to_write !== null) {
                        // Check if the user's book list already exists
                        if (file_exists($write_path)) {
                            // Read existing user book list
                            $existing_user_clubs = json_decode(file_get_contents($write_path), true);
                            // Check for duplicates
                            foreach ($existing_user_clubs as $user_club) {
                                if ($user_club['name'] === $club_name) {
                                    return; // Book already exists in the user's list
                                }
                            }
                            // Add the new book to the existing list
                            $existing_user_clubs[] = $data_to_write;
                        } else {
                            // Create a new list with the book
                            $existing_user_clubs = [$data_to_write];
                        }

                        // Write the complete user book list back to the file
                        file_put_contents($write_path, json_encode($existing_user_clubs, JSON_PRETTY_PRINT));
                    }
            }
            function delete_club_from_user_list($write_path, $club_title): void {
                // Check if the user's book list exists
                if (file_exists($write_path)) {
                    // Read existing user book list
                    $existing_user_club = json_decode(file_get_contents($write_path), true);
                    
                    // Create a new array to hold the remaining books
                    $updated_user_clubs = [];
                    $book_found = false; // Flag to track if the book was found
            
                    // Loop through the existing user books
                    $club_found = false;
                    foreach ($existing_user_club as $user_club) {
                        // If the book title matches, we skip adding it to the new array
                        if ($user_club['name'] === $club_title) {
                            $club_found = true; // Mark that we found the book
                            continue; // Skip this book
                        }
                        // Add other books to the updated list
                        $updated_user_clubs[] = $user_club;
                    }
            
                    // If the book was found, update the file
                    if ($club_found) {
                        // Write the updated user book list back to the file
                        file_put_contents($write_path, json_encode($updated_user_clubs, JSON_PRETTY_PRINT));
                    }
                }
            }