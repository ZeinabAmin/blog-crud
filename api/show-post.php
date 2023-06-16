<?php
//client side rendering
//http://localhost/blog-crud/api/show-posts.php
require_once('../inc/functions.php');
$conn = mysqli_connect("localhost", "root", "", "blog-crud");
header("content-type:Application-json;charset=utf-8");

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['id']) and $_GET['id'] != '') {
        $id = $_GET['id'];
        $query = "SELECT * from `posts` where `id`=$id;";
        $runquery = mysqli_query($conn, $query);

        if (mysqli_num_rows($runquery) !== 0) {

            $result = mysqli_fetch_assoc($runquery);
            $postJson = json_encode($result); //ass arr to json //[{"name":"iphone"}]
            echo $postJson;
        } else {

            renderError("not found", 404);
            // $message= "not found";
            // http_response_code(404);
            // echo $message;
        }
    }
} else {
    renderError("method not allowed", 405);
    //     $message= "method not allowed";
    //     http_response_code(405); //method not allowed
    //   echo $message;
}
