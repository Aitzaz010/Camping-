<?php
// Database connection
$servername = "localhost"; // usually localhost
$username = "root";        // your phpMyAdmin username
$password = "";            // your phpMyAdmin password
$dbname = "data_stored";   // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data safely
$full_name = $conn->real_escape_string($_POST['name']);
$email = $conn->real_escape_string($_POST['email']);
$phone = $conn->real_escape_string($_POST['phone']);
$camping_date = $_POST['date'];
$number_of_people = (int)$_POST['people'];
$additional_notes = $conn->real_escape_string($_POST['notes']);

// Insert data into bookings table
$sql = "INSERT INTO bookings (full_name, email, phone_number, camping_date, number_of_people, additional_notes)
        VALUES ('$full_name', '$email', '$phone', '$camping_date', $number_of_people, '$additional_notes')";

if ($conn->query($sql) === TRUE) {
    echo "Booking successful! Thank you, $full_name.";
} else {
    if ($conn->errno == 1062) {
        echo "Error: This email is already used for a booking.";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
