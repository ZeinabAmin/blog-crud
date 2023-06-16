<?php 
//handle-create
session_start();
$conn=mysqli_connect("localhost","root","","blog-crud");

if (isset($_POST['submit'])) {
    $title=trim(htmlspecialchars($_POST['title']));
    $body=trim(htmlspecialchars($_POST['body']));
   // echo $title,$body;
 
   $errors=[];
   if(empty($title)){
       $errors[]="title is required";
   }elseif (!is_string($title)) {
       $errors[]="title must be string";
   }elseif (strlen($title) > 255 ) {
       $errors[]="min length <= 255 length ";
   }
   
   if(empty($body)){
       $errors[]="body is required"; //push
   }elseif (!is_string($body)) {
    $errors[]="body must be string";
}
   
   if(empty($errors)){
     $query="insert into `posts` (title,body,user_id) values ('$title','$body',1)";//true or false //zero or one
    $result=mysqli_query($conn,$query);

 
 if ($result == 1) { //true or false
   header("location: index.php");
 }else {
    //display error msg
    $_SESSION['errors']=["error occured, please try again"];
    header("location:create-post.php");
 }

   }else{
       //print_r($errors);
       $_SESSION['errors']=$errors;
       header("location:create-post.php");
   }
 
}
