<?php

$id = $_POST['id'];  // Ensure the 'id' is coming correctly from the form

$con = new mysqli('localhost', 'root', '', 'myhotel');
if ($con->connect_error) {
    die('Connection Failed: ' . $con->connect_error);
} else {
    // Prepare the DELETE query with a placeholder for the 'id'
    if ($stmt1 = $con->prepare("DELETE FROM customers WHERE id = ?")) {
        // Bind the 'id' to the query
        $stmt1->bind_param('i', $id);  // 'i' for integer parameter

        // Execute the query
        $stmt1->execute();

        // Close the statement
        $stmt1->close();
    } else {
        echo "Error preparing the query.";
    }
}

header("Location: index.php?page=customers");  // Redirect to the customers page after deletion
?>
