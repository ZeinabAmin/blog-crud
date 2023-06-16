<?php
session_start();
$SESSION['isLogin'] = false;
unset($SESSION['userId']);
unset($SESSION['uuserEmail']);

header("location:index.php");
