<?php
// Line 1: Include DB connection (use relative path, not server root)
include "../admin/db_connect.php"; // Fixed from $_SERVER['DOCUMENT_ROOT']... (Line 1)

// Line 2-8: Get POST data
$name       = filter_input(INPUT_POST, 'name');
$mail       = filter_input(INPUT_POST, 'mail');
$phone      = filter_input(INPUT_POST, 'phone');
$room_type  = filter_input(INPUT_POST, 'room_type');
$adult      = filter_input(INPUT_POST, 'adult');
$children   = filter_input(INPUT_POST, 'children');
$datein     = filter_input(INPUT_POST, 'datein');
$dateout    = filter_input(INPUT_POST, 'dateout');
$days_of_stay = filter_input(INPUT_POST, 'days_of_stay');
$message    = filter_input(INPUT_POST, 'message');
$status     = 0;

// Line 9-15: Generate unique booking reference
do {
    $ref = rand(100000000, 999999999);
    $checked = $conn->query("SELECT id FROM booking WHERE ref_no='$ref'");
} while (mysqli_num_rows($checked) > 0);

// Line 16-22: Generate unique customer ID
do {
    $cus_id = rand(10000000, 99999999);
    $checked = $conn->query("SELECT id FROM customers WHERE customer_id='$cus_id'");
} while (mysqli_num_rows($checked) > 0);

// Line 23-29: Map room_type to room_id
if ($room_type == 'Single Room') {
    $room_id = 1;
} elseif ($room_type == "Double Room") {
    $room_id = 2;
} else {
    $room_id = 3;
}

// Line 30: Use the existing connection $conn from db_connect.php
// Removed duplicate connection $con = new mysqli(...)  

// Line 31-41: Insert booking
$stmt = $conn->prepare(
    "INSERT INTO booking (name, ref_no, mail, phone, room_type, room_id, adult, children, datein, dateout, days_of_stay, status, message) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
);
$stmt->bind_param(
    "sisisiiissiis",
    $name, $ref, $mail, $phone, $room_type, $room_id, $adult, $children, $datein, $dateout, $days_of_stay, $status, $message
);
$stmt->execute();
$stmt->close();

// Line 42-50: Insert customer if not exists
$check_customer = $conn->query("SELECT id FROM customers WHERE phone='$phone'");
if (mysqli_num_rows($check_customer) == 0) {
    $stmt1 = $conn->prepare(
        "INSERT INTO customers(name, customer_id, mail, phone) VALUES (?, ?, ?, ?)"
    );
    $stmt1->bind_param("sisi", $name, $cus_id, $mail, $phone);
    $stmt1->execute();
    $stmt1->close();
}

// Line 51: Redirect after booking
header("Location: book.php");
exit;
?>
