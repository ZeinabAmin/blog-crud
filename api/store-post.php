<?php
//client side rendering
//http://localhost/blog-crud/api/show-post.php
require_once('../inc/functions.php');
$conn = mysqli_connect("localhost", "root", "", "blog-crud");
header("content-type:Application-json;charset=utf-8");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $title = isset($_POST['title']) ? trim(htmlspecialchars($_POST['title'])) : "";
    $body = isset($_POST['body']) ? trim(htmlspecialchars($_POST['body'])) : "";
    // $body = trim(htmlspecialchars($_POST['body']));

    $errors = [];
    if (empty($title)) {
        $errors[] = "title is required";
    } elseif (!is_string($title)) {
        $errors[] = "title must be string";
    } elseif (strlen($title) > 255) {
        $errors[] = "min length <= 255 length ";
    }

    if (empty($body)) {
        $errors[] = "body is required"; //push
    } elseif (!is_string($body)) {
        $errors[] = "body must be string";
    }

    if (empty($errors)) {
        $query = "insert into `posts` (title,body,user_id) values ('$title','$body','1')"; //true or false //zero or one
        $result = mysqli_query($conn, $query);


        // if ($result) { //true or false
        //     echo json_encode(["post stored successfully"]);
        //     // print_r($result);
        // } else {
        //     renderError("failed to store post", 500); //internal server error
        // }

        if ($result && mysqli_affected_rows($conn) > 0) {
            echo json_encode(["message" => "Post stored successfully."]);
        } else {
            renderError("failed to store post", '500'); //internal server error

            // $error = mysqli_error($conn);
            // http_response_code(500); // تعيين رمز حالة HTTP إلى 500
            // echo json_encode(["error" => "Failed to update post: $error"]);
        }

    } else {
        $errorsJson = json_encode($errors);
        echo $errorsJson;
    }
} else {

    renderError("method not allowed", 405);
}
