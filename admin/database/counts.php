<?php
header('Content-Type: application/json');

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bus_reservation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed']));
}

// Fetch the counts
$total_buses = $conn->query("SELECT COUNT(*) AS count FROM buses")->fetch_assoc()['count'];
$total_bookings = $conn->query("SELECT COUNT(*) AS count FROM bookings")->fetch_assoc()['count'];
$total_users = $conn->query("SELECT COUNT(*) AS count FROM users")->fetch_assoc()['count'];

$conn->close();

echo json_encode([
    'total_buses' => $total_buses,
    'total_bookings' => $total_bookings,
    'total_users' => $total_users,
]);
?>
