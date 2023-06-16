<?php
require_once('../inc/functions.php');
$conn = mysqli_connect("localhost", "root", "", "blog-crud");
header("content-type:Application-json;charset=utf-8");

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    // $id = $_GET['id'];
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    // echo $id;
    $query = "DELETE FROM `posts` WHERE `id` = '$id'";
    $result = mysqli_query($conn, $query);

    // if ($result) { //true or false
    //     echo json_encode(["post deleted successfully"]);
    // } else {
    //     renderError("failed to delete post", '500'); //internal server error
    // }


    // $result = mysqli_query($connection, $query);
    // if(!$result){
    //     die("ERROR".mysqli_error($connection));
    // }


    if ($result && mysqli_affected_rows($conn) > 0) {
        echo json_encode(["message" => "Post deleted successfully."]);
    } else {
        $error = mysqli_error($conn);
        renderError("failed to delete post", '500'); //internal server error
        // renderError("Failed to delete post: $error", 500); // Internal Server Error with error message

        // $error = mysqli_error($conn);
        // http_response_code(500); // تعيين رمز حالة HTTP إلى 500
        // echo json_encode(["error" => "Failed to delete post: $error"]);
    }
} else {
    renderError("method not allowed", 405);
}
