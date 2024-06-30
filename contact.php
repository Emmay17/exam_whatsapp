<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, photo, last_message as lastMessage FROM contacts";
$result = $conn->query($sql);

$contacts = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $contacts[] = $row;
    }
}

echo json_encode($contacts);

$conn->close();
?>
