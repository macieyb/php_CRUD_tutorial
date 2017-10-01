<?php
// db connection
include_once 'config/database.php';

try{

    // get record ID
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

    // delete query
    $query="DELETE FROM products WHERE id=:id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);

    if($stmt->execute()){
        // redirect to read record page and
        // tell the user record was deleted
        header('Location: index.php?action=deleted');
    }else{
        die('Unable to delete record');
    }
}

// show error
catch (PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}