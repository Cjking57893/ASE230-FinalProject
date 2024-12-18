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

// Function to update data in a specified table
function update($pdo, $table, $data, $conditions)
{
    global $allowedTables;

    // Check if the table name is valid
    if (!in_array($table, $allowedTables)) {
        throw new Exception("Invalid table name");
    }

    // Prepare the columns and placeholders for the update
    $setPart = implode(", ", array_map(fn($key) => "$key = ?", array_keys($data)));

    // Prepare the conditions and placeholders
    $wherePart = implode(" AND ", array_map(fn($key) => "$key = ?", array_keys($conditions)));

    // Create the SQL query
    $sql = "UPDATE $table SET $setPart WHERE $wherePart";

    // Combine values for the data and conditions
    $values = array_merge(array_values($data), array_values($conditions));

    // Prepare and execute the statement
    $stmt = $pdo->prepare($sql);
    $stmt->execute($values);
}