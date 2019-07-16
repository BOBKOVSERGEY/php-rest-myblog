<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once __DIR__ . '/../../config/Database.php';
include_once __DIR__ . '/../../models/Category.php';

// Instantiate DB & connect

$database = new Database();
$db = $database->connect();

// Instantiate category object

$category = new Category($db);

// Category query
$result = $category->read();

// get row count
$num = $result->rowCount();

// Check if any categories

if ($num > 0) {
    // cat array
    $cat_arr = [];
    $cat_arr['data'] = [];
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $cat_item = [
                'id' => $id,
                'name' => $name,
        ];

        // push to data
        array_push($cat_arr['data'], $cat_item);
    };

    // turn to json & output
    echo json_encode($cat_arr);

} else {
    // No posts
    echo json_encode([
            'message' => 'No Categories Found'
    ]);
}