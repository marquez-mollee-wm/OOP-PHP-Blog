<?php

require 'dbconnect.php';

$database = new Database;

$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if(@$_POST['delete']){
    $delete_id = $post['delete_id'];
    $database->query('DELETE FROM posts WHERE id = :id');
    $database->bind(':id', $delete_id);
    $database->execute();
}


//if(@$post['update']){
//    $id = $post['update_id'];
//    $title = $post['title'];
//    $body = $post['body'];
//
//    $database->query('SELECT title, body FROM posts WHERE id = id');
//    $database->query('UPDATE posts SET title = :title, body = :body WHERE id =:id');
//    $database->bind(':title', $title);
//    $database->bind(':body', $body);
//    $database->bind(':id', $id);
//    $database->execute();
//}

if(@$post['submit']) {
    $title = $post['title'];
    $body = $post['body'];


    $database->query('INSERT INTO posts (title, body) VALUES(:title, :body)');

    $database->bind(':title', $title);
    $database->bind(':body', $body);

    $database->execute();
//    if ($database->lastInsertId()) {
//        echo '<p>Post Added!</p>';
//    }
}

if(@$post['add']){
        $fname = $post['f_name'];
        $lname = $post['l_name'];
        $username = $post['username'];
        $email = $post['email'];

        $database->query('INSERT INTO users (f_name, l_name, username, email) VALUES (:f_name, :l_name, :username, :eamil)');
        $database->bind(':f_name', $fname);
        $database->bind(':l_name', $lname);
        $database->bind(':username', $username);
        $database->bind(':email', $email);
        $database->execute();
    }


$database->query('SELECT p.id, p.title, p.body, p.date, u.username FROM posts p LEFT JOIN users u ON p.auth_id = u.id');
$rows = $database->resultset();