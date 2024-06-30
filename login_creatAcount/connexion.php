<?php
session_start();

// Connexion à la base de données
include_once("bd.php");

// Récupérer les informations du formulaire
$phone_number = $_POST['phone_number'];
$password = $_POST['password'];

// Requête pour vérifier les informations d'identification
$sql = "SELECT * FROM users WHERE phone_number = $phone_number";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $phone_number);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // L'utilisateur existe, vérifier le mot de passe
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Mot de passe correct, créer la session
        $_SESSION['phone_number'] = $phone_number;
        header("Location: ../principal.html");
        exit();
    } else {
        // Mot de passe incorrect
        echo "Invalid password.";
    }
} else {
    // Utilisateur non trouvé
    echo "No user found with that phone number.";
}

$stmt->close();
$conn->close();
?>
