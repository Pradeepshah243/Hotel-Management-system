<?php

$id = $_POST['id']; // Get the room id from POST request

$con = new mysqli('localhost', 'root', '', 'myhotel');
if ($con->connect_error) {
    die('Connection Failed: ' . $con->connect_error);
} else {
    // Prepare the DELETE statement with a placeholder for the id
    $stmt1 = $con->prepare("DELETE FROM rooms WHERE id = ?");
    
    // Bind the parameter (i = integer) to the placeholder
    $stmt1->bind_param('i', $id); // Bind $id as an integer
    
    // Execute the prepared statement
    $stmt1->execute();
    
    // Close the statement
    $stmt1->close();
}

// Redirect to the rooms page after deletion
header("Location: index.php?page=rooms");

?>
