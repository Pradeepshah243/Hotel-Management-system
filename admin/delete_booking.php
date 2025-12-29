<?php

$id = $_POST['id'];  // Make sure the 'id' is coming from the form correctly.

$con = new mysqli('localhost', 'root', '', 'myhotel');
if ($con->connect_error) {
    die('Connection Failed: ' . $con->connect_error);
} else {
    // Prepare the query without directly inserting $id in the SQL string
    if ($stmt1 = $con->prepare("DELETE FROM booking WHERE id = ?")) {
        // Use bind_param to bind the $id variable to the query
        $stmt1->bind_param('i', $id);  // 'i' means the type is integer
        $stmt1->execute();
        $stmt1->close();
    } else {
        echo "Error preparing the query.";
    }
}

header("Location: index.php?page=booked");  // Redirect to the booked page
?>
