<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "WB2"; // Remplacez par le nom de votre base de données

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = $_POST['numero'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $sql = "SELECT * FROM utilisateur WHERE numero_telephone = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $numero);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($mot_de_passe, $user['mot_de_passe'])) {
            // Mot de passe correct, ouvrir une session
            // $_SESSION['user_id'] = $user['id'];
            $_SESSION['numero'] = $user['numero_telephone'];
            echo json_encode(["success" => true, "message" => "Connexion réussie."]);
        } else {
            // Mot de passe incorrect
            echo json_encode(["success" => false, "message" => "Mot de passe incorrect."]);
        }
    } else {
        // Numéro de téléphone non trouvé
        echo json_encode(["success" => false, "message" => "Numéro de téléphone non trouvé."]);
    }

    $stmt->close();
}

$conn->close();
?>
