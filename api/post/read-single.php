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

// Get ID
$post->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get post

$post->readSingle();

// Create array
$post_arr = [
        'id' => $post->id,
        'title' => $post->title,
        'body' => $post->body,
        'author' => $post->author,
        'category_id' => $post->category_id,
        'category_name' => $post->category_name,
];

// Make JSON

// turn to json & output
echo json_encode($post_arr);
