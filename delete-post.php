<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "blog-crud");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "delete from `posts` where id=$id";
    $result = mysqli_query($conn, $query);
    header("location:index.php");
}
