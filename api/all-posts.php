<?php
//client side rendering
//http://localhost/blog-crud/api/all-posts.php
require_once('../inc/functions.php');
$conn = mysqli_connect("localhost", "root", "", "blog-crud");
header("content-type:Application-json;charset=utf-8");

if ($_SERVER['REQUEST_METHOD'] == "GET") {

  $query = "SELECT * from `posts`";
  $runquery = mysqli_query($conn, $query);
  $result = mysqli_fetch_all($runquery, MYSQLI_ASSOC);
  $postJson = json_encode($result); //ass arr to json //[{"name":"iphone"}]
  echo $postJson;
} else {
  renderError("method not allowed", 405);
  //   $message= "method not allowed";
  //   http_response_code(405); //method not allowed
  // echo $message;
}
