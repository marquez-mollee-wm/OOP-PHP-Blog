<?php

require 'dbconnect.php';

$database = new Database;

$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if(@$post['delete']){
    $delete_id = $_POST['delete_id'];
    $database->query('DELETE FROM posts WHERE id = :id');
    $database->bind(':id', $delete_id);
    $database->execute();
}


if(@$post['update']){
    $id = $post['id'];
    $title = $post['title'];
    $body = $post['body'];

    $database->query('UPDATE posts SET title = :title, body = :body WHERE id =:id');
    $database->bind(':title', $title);
    $database->bind(':id', $id);
    $database->execute();
}
if(@$post['submit']) {
    $title = $post['title'];
    $body = $post['body'];


    $database->query('INSERT INTO posts (title, body) VALUES(:title, :body)');

    $database->bind(':title', $title);
    $database->bind(':body', $body);

    $database->execute();
    if($database->lastInsertId()){
        echo '<p>Post Added!</p>';
    }

    if(@$post['add']){
        $fname = $post['f_name'];
        $lname = $post['l_name'];
        $email = $post['email'];
        $username = $post['username'];

        $database->query('INSERT INTO users (f_name, l_name, email, username) VALUES (:f_name, :l_name, :eamil, :username)');
        $database->bind(':f_name', $fname);
        $database->bind(':l_name', $lname);
        $database->bind(':email', $email);
        $database->bind(':username', $username);
    }
}

$database->query('SELECT p.title, p.body, p.date, u.username FROM posts p LEFT JOIN users u ON p.auth_id = u.id');
$rows = $database->resultset();