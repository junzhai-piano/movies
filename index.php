<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Movies</h1>

                <?php
                if (isset($_SESSION['message'])) {
                    if ($_SESSION['message'] == 'movieadded') {
                        echo '<div class="alert alert-success">
                        <strong>Success!</strong> Movie added!
                      </div>';
                    }

                    if ($_SESSION['message'] == 'movieupdated') {
                        echo '<div class="alert alert-info">
                       <strong>Success!</strong> Movie Updated.
                     </div>';
                    }


                    if ($_SESSION['message'] == 'moviedeleted') {
                        echo '<div class="alert alert-danger">
                       <strong>Success!</strong> Movie Deleted.
                     </div>';
                    }

                    unset($_SESSION['message']);
                }

                ?>

                <?php
                if (isset($_POST['editmovie'])) {
                    echo '<form action="updatemovie.php" method="POST">';
                } else {
                    echo '<form action="addmovie.php" method="POST">';
                }
                ?>

                <div class="form-group">
                    <label>Movie Title</label>
                    <input type="text" class="form-control" name="movie_title" value="<?=$_POST['movie_title']?>" placeholder="Movie Title"  required>
                </div>

                <div class="form-group">
                    <label>Genre</label>

                    <select name="movie_genre" class="form-control" required>
                        <option value=""></option>
                        <?php
                        $genres = array("Action", "Comedy", "Kids and Family", "Drama", "Fantasy", "Other");
                        foreach ($genres as $genre) {
                            echo '<option value="' . $genre . '">' . $genre . '</option>';
                        }
                        ?>
                    </select>
                </div>


                <?php
                if (isset($_POST['editmovie'])) {
                    echo '<input type="hidden" name="movie_id" value="' . $_POST['movie_id'] . '">';
                    echo '<button type="submit" name="updatemovie" class="btn btn-info">Update movie</button>';
                } else {
                    echo '<button type="submit" name="addmovie" class="btn btn-success">Add movie</button>';
                }
                ?>

                </form>

                <br><br>
                <table class="table table-hover table-striped table boredered">
                    <tr>
                        <th>ID</th>
                        <th>Movie</th>
                        <th>Genre</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php

                    include '../myguests/db.php';

                    $sql = "SELECT * FROM movies";
                    $result = mysqli_query($conn, $sql);
                    
                    if (mysqli_num_rows($result) > 0) {
                      // output data of each row
                      while($row = mysqli_fetch_assoc($result)) {
                     ?>   

                            <tr>
                                <td> <?= $row["movie_id"] ?> </td>
                                <td> <?= $row["movie_title"] ?> </td>
                                <td> <?= $row["movie_genre"] ?> </td>

                                <td>
                                    <form action="index.php" method="POST">
                                        <input type="hidden" name="movie_id" value="<?= $row['movie_id'] ?>">
                                        <input type="hidden" name="movie_title" value="<?= $row['movie_title'] ?>">
                                        <input type="hidden" name="movie_genre" value="<?= $row['movie_genre'] ?>">
                                        <button type="submit" name="editmovie" class="btn btn-xs btn-success">edit</button>
                                    </form>
                                </td>

                                <td>
                                    <form action="deletemovie.php" method="POST">
                                        <input type="hidden" name="movie_id" value="<?= $row['movie_id'] ?>">
                                        <button type="submit" name="deletemovie" class="btn btn-xs btn-danger">X</button>
                                    </form>
                                </td>


                            </tr>
                    <?php
                        }
                    } else {
                        echo "0 results";
                    }
                    mysqli_close($conn);
                    ?>
                </table>

            </div>
        </div>
    </div>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</body>
<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</html>