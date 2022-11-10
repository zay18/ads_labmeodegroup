<?php
require_once "config.php";

$id = $name = $description = $classification = "";
$id_error = $name_error = $description_error = $classification_error = "";

if (isset($_POST["id"]) && !empty($_POST["id"])) {

    $id = $_POST["id"];

        $id = trim($_POST["id"]);
        if (empty($id)) {
            $id_error = "id is required.";
        } elseif (!filter_var($id, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
            $id_error = "id is invalid.";
        } else {
            $id = $id;
        }

        $name = trim($_POST["name"]);

        if (empty($name)) {
            $name_error = "name is required.";
        } elseif (!filter_var($name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
            $name_error = "name is invalid.";
        } else {
            $name = $name;
        }

        $description = trim($_POST["description"]);
        if (empty($description)) {
            $description_error = "description is required.";
        } elseif (!filter_var($description, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
            $description_error = "Please enter a valid description.";
        } else {
            $description = $description;
        }
        $classification = trim($_POST["classification"]);
        if (empty($classification)) {
            $classification_error = "classification is required.";
        } elseif (!filter_var($classification, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
            $classification_error = "Please enter a valid classification.";
        } else {
            $classification = $classification;
        
        }

    if (empty($id_error_err) && empty($name_error) &&
        empty($description_error) && empty($classification_error)) {

          $sql = "UPDATE artist SET name = '$name', description = '$description', classification = '$classification' WHERE id='$id'";

          if (mysqli_query($conn, $sql)) {
              header("location: index.php");
          } else {
              echo "Something went wrong. Please try again later.";
          }

    }

    mysqli_close($conn);
//} else {
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        $id = trim($_GET["id"]);
        $query = mysqli_query($conn, "SELECT * FROM artist WHERE ID = '$id'");

        if ($artist = mysqli_fetch_assoc($query)) {
            $id   = $artist["id"];
            $name    = $artist["name"];
            $classification = $artist["classification"];
            $description       = $artist["description"];
        } else {
            echo "Something went wrong. Please try again later.";
            header("location: edit.php");
            exit();
        }
        mysqli_close($conn);
    }  else {
        echo "Something went wrong. Please try again later.";
        header("location: edit.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
            width: 1200px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update</h2>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="form-group <?php echo (!empty($name_error)) ? 'has-error' : ''; ?>">
                            <label>name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($classification_error)) ? 'has-error' : ''; ?>">
                            <label>classification</label>
                            <input type="text" name="classification" class="form-control" value="<?php echo $classification; ?>">
                            <span class="help-block"><?php echo $classification_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($description_error)) ? 'has-error' : ''; ?>">
                            <label>description</label>
                            <input type="text" name="description" class="form-control" value="<?php echo $description; ?>">
                            <span class="help-block"><?php echo $description_error;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>