<?php
session_start();

//echo   "We are deleting ID: ".$_POST['id'];
include "../myguests/db.php";

// sql to delete a record
$sql = "DELETE FROM movies WHERE movie_id='{$_POST['movie_id']}'";

//echo $sql;die;

if (mysqli_query($conn, $sql)) {
$_SESSION['message']='moviedeleted';
header("Location: index.php");

} else {
  echo "Error deleting record: " . mysqli_error($conn);
}  

mysqli_close($conn);

?>