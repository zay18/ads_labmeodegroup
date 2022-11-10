<?php
require_once "config.php";

$name = $classification = $description = "";
$name_error = $classification_error = $description_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);

    if (empty($name)) {
        $name_error = "name is required.";
    }  else {
        $name = $name;
    }

    $classification = trim($_POST["classification"]);
    if(empty($classification)){
        $classification_error = "classification is required.";
    } else {
        $classification = $classification;
    }

    $description = trim($_POST["description"]);
    if (empty($description)) {
        $description_error = "description is required.";
    } else {
        $description = $description;
    }

    if (empty($id_error) && empty($name_error) && empty($classification_error) && empty($description_error) ) {
          $sql = "INSERT INTO artist (name, classification, description) VALUES ('$name', '$classification', '$description')";

          if (mysqli_query($conn, $sql)) {
              header("location: index.php");
          } else {
               echo "Something went wrong. Please try again later.";
          }
      }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Artists</title>
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
                        <h2>Artists</h2>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="form-group <?php echo (!empty($name_error)) ? 'has-error' : ''; ?>">
                            <label>name</label>
                            <input type="text" name="name" class="form-control" value="">
                            <span class="help-block"><?php echo $name_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($classification_error)) ? 'has-error' : ''; ?>">
                            <label>classification</label>
                            <input type="text" name="classification" class="form-control" value="">
                            <span class="help-block"><?php echo $classification_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($description_error)) ? 'has-error' : ''; ?>">
                            <label>description</label>
                            <input type="text" name="description" class="form-control" value="">
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