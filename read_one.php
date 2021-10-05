<?php
    require("mysql_connect.php");

    $id = $_GET["id"];
    $sql = "SELECT * FROM notes WHERE id = $id";
    $note = $conn->query($sql);
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Create</title>
    <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">PHP CRUD</a>
        </div>
    </nav>

    <div class="container">
        <div class="row pt-3">
            <div class="col">
                <div class="card">
                    <?php
                    if ($note->num_rows > 0) {
                        while ($row = $note->fetch_assoc()) {
                            $id = $row["id"];
                            $title = $row["title"];
                            $content = $row["content"];
                            $priority = ucfirst($row["priority"]);

                            echo "
                                    <h1 class='card-header text-center'>$id - $title</h1>
                                    <div class='card-body'>
                                        Content:
                                        $content
                                        <hr>
                                        Priority: $priority
                                    </div>
                                ";
                        }
                    }

                    echo '
                        <div class="card-footer">
                            <a class="btn btn-secondary" href="index.php">Back</a>
                            <a class="btn btn-secondary" href="update.php?id='.$id.'">Edit</a>
                            <a class="btn btn-danger" href="delete.php?id='.$id.'">Delete</a>
                        </div>'

                    ?>
                    
                </div>
            </div>
        </div>
    </div>

</body>


</html>