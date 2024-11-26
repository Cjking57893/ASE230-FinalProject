<?php
// Modified version of functions for admin page
function read_book_list_admin($file_path): void{

    $file = fopen($file_path,'r');
    //loop runs as long as there is data to read from file
    if(file_exists($file_path)){
        
            $content = file_get_contents($file_path);
            //decode json file and store it
            $json_array = json_decode($content,true);
                
            //write html to page
            foreach($json_array as $book){
            '<br>';
            echo "<tr>
                    <th scope=\"row\"><img src=\"images\book.jpg\" alt=\"Book\" style=\"width: 100px; height: 100px;\"></th>
                        <td class=\"align-middle\"><a href=\"book_detail_admin.php?title=$book[title]\">$book[title]</a></td>
                        <td class=\"align-middle\">$book[author]</td>
                        <td class=\"align-middle\">$book[year]</td>
                        <td class=\"align-middle\">
                            <form method=\"post\">
                                <input type=\"hidden\" name=\"book_title\" value=\"" . htmlspecialchars($book['title']) . "\">
                                <a href=\"edit_book.php?book_title=" . urlencode($book['title']) . "\" class=\"btn btn-secondary\" style=\"display:inline-block;\">Edit</a>
                                <input class=\"btn btn-danger\" name=\"delete\" type=\"submit\" value=\"Delete\">
                            </form>
                        </td>        
                    </tr>
                    
                    ";
                    

            }
    }
}

function read_club_list_admin($file_path){
    $file = fopen($file_path,'r');
    //loop runs as long as there is data to read from file
    if(file_exists($file_path)){
            $content = file_get_contents($file_path);
            //decode json file and store it
            $json_array = json_decode($content,true);
            //write html to page
            foreach($json_array as $club){
            //write html to page
            '<br>';
            echo "<div class=\"col\">
                            <div class=\"card mt-2 mb-2\" style=\"width: 25rem;\">
                                <div class=\"card-body\">
                                    <h5 class=\"card-title\">$club[name]</h5>
                                    <h6 class=\"card-subtitle mb-2 text-body-secondary\">Point of Contact: $club[leader]</h6>
                                    <p class=\"card-text\">$club[description]</p>
                                    <form method=\"post\">
                                        <input type=\"hidden\" name=\"club_name\" value=\"" . htmlspecialchars($club['name']) . "\">
                                        <a href=\"edit_club.php?club_name=" . urlencode($club['name']) . "\" class=\"btn btn-secondary\" style=\"display:inline-block;\">Edit</a>
                                    </form>
                                    <form method=\"post\">
                                        <input type=\"hidden\" name=\"club_name\" value=\"" . htmlspecialchars($club['name']) . "\">
                                        <input class=\"mt-2 btn btn-danger\" type=\"submit\" value=\"Delete\">
                                    </form>
                                </div>
                            </div>
                        </div>";
        }
    }
}

function read_book_details_admin($file_path, $book_title){
$content = file_get_contents($file_path);
    //decode json file and store it
    $json_array = json_decode($content,true);
        
    //write html to page
    foreach($json_array as $book){
        if($book['title'] == $book_title){
            echo "<h1 class=\"mt-2 ms-2\">$book[title]</h1>
                    <p class=\"mt-2 ms-2\"> Written By: $book[author]</p>
                    <p class=\"mt-2 ms-2\">Published in: $book[year]</p>
                    <p class=\"mt-2 ms-2\"> $book[description]</p>";
            break;
        }
    }
}