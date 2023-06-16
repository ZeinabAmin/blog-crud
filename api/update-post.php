<?php
//client side rendering
//http://localhost/blog-crud/api/show-post.php
require_once('../inc/functions.php');
$conn = mysqli_connect("localhost", "root", "", "blog-crud");
header("content-type:Application-json;charset=utf-8");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // $id = $_POST['id'];
    $id = isset($_POST['id']) ? $_POST['id'] : "";

    $title = isset($_POST['title']) ? trim(htmlspecialchars($_POST['title'])) : "";
    $body = isset($_POST['body']) ? trim(htmlspecialchars($_POST['body'])) : "";
    // $title = trim(htmlspecialchars($_POST['title']));
    // $body = trim(htmlspecialchars($_POST['body']));

    $errors = [];
    // Validate the ID
    //required
    //int
    //exist in db
    // Check if the ID exists in the database
    // $id = 123;
    // $sql = "SELECT * FROM my_table WHERE id = $id";
    // $result = $conn->query($sql);

    // if ($result->num_rows > 0) {
    // ID exists in the database
    //   echo "ID $id exists in the database.";
    // } else {
    // ID does not exist in the database //404
    //   echo "ID $id does not exist in the database.";
    // }
    //////////////////////////////////////////////////////////
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
        $query = "update `posts` set title='$title',body='$body'where `id`='$id'";
        $result = mysqli_query($conn, $query);


        // if ($result) { //true or false
        //     echo json_encode(["post updated successfully"]);
        // } else {
        //     renderError("failed to update post", 500); //internal server error
        // }

        if ($result && mysqli_affected_rows($conn) > 0) {
            echo json_encode(["message" => "Post updated successfully."]);
        } else {
            renderError("failed to update post", '500'); //internal server error

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
