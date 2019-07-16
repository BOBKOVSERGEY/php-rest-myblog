<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once __DIR__ . '/../../config/Database.php';
include_once __DIR__ . '/../../models/Post.php';

// Instantiate DB & connect

$database = new Database();
$db = $database->connect();

// Instantiate blog post object

$post = new Post($db);

// Get  raw posted data
$data = json_decode(file_get_contents("php://input"));

$post->id = $data->id;

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

// Create a post

if ($post->updatePost()) {
    echo json_encode(['message' => 'Post Updated']);
} else {
    echo json_encode(['message' => 'Post NOT Updated']);
}