<?php
require('mysql_connect.php');

$id = $_GET['id'];
$title = $content = $priority = "";
$sql_select = "SELECT * FROM notes WHERE id = $id";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = htmlspecialchars($_POST["title"]);
    $content = htmlspecialchars($_POST["content"]);
    $priority = htmlspecialchars($_POST["priority"]);

    if (!empty($title) && !empty($content) && !empty($priority)) {
        $sql_update = "UPDATE notes SET title='$title', content='$content', priority='$priority' WHERE id = $id";

        if ($conn->query($sql_update) === TRUE) {
            echo '<div class="alert alert-success" role="alert">
                    Record updated successfully 😊
                  </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                    An error occurred while updating 😱 <br>
                    Error:  '.$sql.' <br>  '.$conn->error.'
                 </div>';
        }
    }
}

$note = $conn->query($sql_select);
$conn->close();
?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>CRUD - Create</title>
    <link rel='stylesheet' href='assets/css/bootstrap/bootstrap.min.css'>
</head>

<body>

    <nav class='navbar navbar-expand-lg navbar-light bg-light'>
        <div class='container-fluid'>
            <a class='navbar-brand' href='index.php'>PHP CRUD</a>
        </div>
    </nav>

    <div class='container'>
        <div class='row pt-3'>
            <div class='col'>
                <div class='card'>
                    <span>
                        <a class='m-2' href='index.php'>Back</a>
                        <h1 class='card-title text-center'>CREATE A NEW NOTE</h5>
                    </span>
                    <div class='card-body'>
                        <form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?id=$id"); ?>' method='post'>

                            <?php
                            if ($note->num_rows > 0) {
                                while ($row = $note->fetch_assoc()) {
                                    $title = $row['title'];
                                    $content = $row['content'];
                                    $priority = $row['priority'];

                                    echo "
                                        <div class='mb-3'>
                                        <label for='title' class='form-label'>Title</label>
                                        <input type='text' class='form-control' id='title' name='title' placeholder='An indecredible title' value='$title' required />
                                        </div>
                                        <div class='mb-3'>
                                            <label for='content' class='form-label'>Content</label>
                                            <textarea class='form-control' id='content' name='content' placeholder='Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita, iusto!' rows='3' required>$content</textarea>
                                        </div>
        
                                        <label for='priority' class='form-label'>Prority</label>
                                    
                                        ";
                                }
                            }
                            ?>

                            <select class='form-select' name='priority' required>
                                <option hidden>Select priority</option>
                                <option value='low' <?php if ($priority == 'low') {echo 'selected';} ?>>Low</option>
                                <option value='middle' <?php if ($priority == 'middle') {echo 'selected';} ?>>Middle</option>
                                <option value='high' <?php if ($priority == 'high') {echo 'selected';} ?>>High</option>
                            </select>

                            <div class='d-grid gap-2 pt-4'>
                                <button class='btn btn-primary' type='submit'>Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>


</html>