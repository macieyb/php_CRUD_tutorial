<!DOCTYPE HTML>
<html>
<head>
    <title>PDO - Read One Record - PHP CRUD Tutorial</title>

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
        <h1>Read Product</h1>
    </div>

    <!-- dynamic content will be here -->
    <?php
    // get passed parameter value, in this case, the record ID
    // isset() is a PHP function to verify if a value is there or not
    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

    // include db connection
    include_once "config/database.php";

    // read current records's data
    try {
        // prepare select query
        $query = "SELECT id, name, description, price, image FROM products WHERE id=:id LIMIT 0,1";
        $stmt = $conn->prepare($query);

        // bind param
        $stmt->bindParam(':id', $id);

        // execute query
        $stmt->execute();

        // store retrieved row to a variable
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // values to fill up the form
        $name = $row['name'];
        $description = $row['description'];
        $price = $row['price'];
        $image = $row['image'];
    }

    // show error
    catch (PDOException $exception) {
        die('ERROR: ' . $exception->getMessage());
    }

    ?>
    <!--we have our html table here where new user information will be displayed-->
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Name</td>
            <td><?php echo htmlspecialchars($name, ENT_QUOTES);  ?></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></td>
        </tr>
        <tr>
            <td>Price</td>
            <td><?php echo htmlspecialchars($price, ENT_QUOTES);  ?></td>
        </tr>
        <tr>
            <td>Image</td>
            <td>
                <?php echo $image ? "<img src='uploads/{$image}' style='width:300px;' />" : "No image found.";  ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <a href='index.php' class='btn btn-danger'>Back to read products</a>
            </td>
        </tr>
    </table>

</div> <!-- end .container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="libs/jquery-3.2.1.slim.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="libs/bootstrap-4.0.0-beta/js/bootstrap.min.js"></script>

</body>
</html>