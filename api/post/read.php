<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once __DIR__ . '/../../config/Database.php';
include_once __DIR__ . '/../../models/Post.php';

// Instantiate DB & connect

$database = new Database();
$db = $database->connect();

// Instantiate blog post object

$post = new Post($db);

// Blog post query
$result = $post->read();

// get row count
$num = $result->rowCount();

// Check if any posts

if ($num > 0) {
    // post array
    $posts_arr = [];
    $posts_arr['data'] = [];
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = [
                'id' => $id,
                'title' => $title,
                'body' => html_entity_decode($body),
                'author' => $author,
                'category_id' => $category_id,
                'category_name' => $category_name
        ];

        // push to data
        array_push($posts_arr['data'], $post_item);
    };

    // turn to json & output
    echo json_encode($posts_arr);

} else {
    // No posts
    echo json_encode([
            'message' => 'No Posts Found'
    ]);
}