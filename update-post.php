<?php
//handle-edit
session_start();
$conn = mysqli_connect("localhost", "root", "", "blog-crud");

if (isset($_POST['submit'])) {
  $id = $_POST['id'];
  $title = trim(htmlspecialchars($_POST['title']));
  $body = trim(htmlspecialchars($_POST['body']));
  // echo $title,$body;

  $erorrs = [];
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
  // ID does not exist in the database
  //   echo "ID $id does not exist in the database.";
  // }
  //////////////////////////////////////////////////////////
  if (empty($title)) {
    $erorrs[] = "title is required";
  } elseif (!is_string($title)) {
    $erorrs[] = "title must be string";
  } elseif (strlen($title) > 255) {
    $erorrs[] = "min length <= 255 length ";
  }

  if (empty($body)) {
    $erorrs[] = "body is required";
  } elseif (!is_string($body)) {
    $erorrs[] = "body must be string";
  }

  if (empty($erorrs)) {
    $query = "update `posts` set title='$title',body='$body'where id=$id";
    $result = mysqli_query($conn, $query);

    if ($result == 1) { //true or false
      header("location: index.php");
    } else {
      //display error msg
      $_SESSION['erorrs'] = ["error occured, please try again"];
      header("location:edit-post.php?id=$id");
    }
  } else {
    //print_r($erorrs);
    $_SESSION['erorrs'] = $erorrs;
    header("location:edit-post.php?id=$id");
  }
}
