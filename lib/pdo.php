<?php
$host='localhost';
$db='bookclubmanagementsystem';
$user='root';
$pass='';
$charset='utf8';
$dsn="mysql:host=$host;dbname=$db;charset=$charset";
$opt=[
    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES=>false,
];

$pdo = new PDO($dsn, $user, $pass, $opt);

// Whitelisted table names to prevent SQL injection
$allowedTables = ['books', 'book_clubs', 'club_features', 'users', 'user_books']; 

function query($pdo, $query, $data=[]){
    $query=$pdo->prepare($query);
    $query->execute($data);
    return $query;
}

// Function to insert data into a specified table
function insert($pdo, $table, $data)
{
    global $allowedTables;

    // Check if the table name is valid
    if (!in_array($table, $allowedTables)) {
        throw new Exception("Invalid table name");
    }

    // Prepare the keys (columns) and values for the insert
    $columns = implode(", ", array_keys($data));
    $placeholders = implode(", ", array_fill(0, count($data), "?"));

    // Create the SQL query
    $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";

    // Prepare and execute the statement
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array_values($data));
}
