<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "WB2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['numero'])) {
    $user_number = $_SESSION['numero'];

    // Sélectionner toutes les informations de l'utilisateur
    $sql = "SELECT * FROM utilisateur WHERE numero_telephone='$user_number'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Retourner toutes les informations de l'utilisateur en JSON
        echo json_encode(['status' => 'success', 'user' => $row]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Utilisateur non trouvé.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Utilisateur non connecté.']);
}

$conn->close();
?>
