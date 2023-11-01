<?php

session_start();
include '../myguests/db.php';


$sql = "UPDATE movies SET movie_title='{$_POST['movie_title']}', movie_genre='{$_POST['movie_genre']}' WHERE movie_id='{$_POST['movie_id']}'";


if (mysqli_query($conn, $sql)) {
$_SESSION['message']='movieupdated';
header("Location: index.php");
} else {
  echo "Error updating record: " . mysqli_error($conn);
}


?>