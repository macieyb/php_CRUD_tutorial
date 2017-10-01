<!DOCTYPE HTML>
<html>
<head>
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="libs/bootstrap-4.0.0-beta/css/bootstrap.min.css"/>

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

<!-- container -->
<div class="container">

    <div class="page-header">
        <h1>Create Product</h1>
    </div>

    <!-- dynamic content will be here -->
    <?php
    if ($_POST) {

        // include database connection
        include_once "config/database.php";

        try {

            // insert query
            $query = "INSERT INTO products SET 
                      name=:name, description=:description,
                      price=:price, created=:created";

            // prepare query for execution
            $stmt = $conn->prepare($query);

            // posted values
            $name = htmlspecialchars(strip_tags($_POST['name']));
            $description = htmlspecialchars(strip_tags($_POST['description']));
            $price = htmlspecialchars(strip_tags($_POST['price']));

            // bind the parameteres
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);

            // specify when this record was inserted to the db
            $created = date('Y-m-s H:i:s');
            $stmt->bindParam(':created', $created);

            // execute the query
            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Record was saved.</div>";
            } else {
                echo "<div class='alert alert-danger'>Unable to save record.</div>";
            }
        } // show error
        catch (PDOException $exception) {
            die ('ERROR: ' . $exception->getMessage());
        }
    }

    ?>
    <!-- html form here where the product information will be entered -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Name</td>
                <td><input type='text' name='name' class='form-control'/></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><textarea name='description' class='form-control'></textarea></td>
            </tr>
            <tr>
                <td>Price</td>
                <td><input type='text' name='price' class='form-control'/></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type='submit' value='Save' class='btn btn-primary'/>
                    <a href='index.php' class='btn btn-danger'>Back to read products</a>
                </td>
            </tr>
        </table>
    </form>

</div> <!-- end .container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="libs/jquery-3.2.1.slim.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="libs/bootstrap-4.0.0-beta/js/bootstrap.min.js"></script>

</body>
</html>