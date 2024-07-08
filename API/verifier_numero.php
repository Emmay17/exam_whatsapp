<?php
// Configuration de la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "WB2";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Vérifiez la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}

// Récupérer le numéro de téléphone de la requête GET
if (isset($_GET['numero_telephone'])) {
    $numero_telephone = $_GET['numero_telephone'];

    // Préparer et exécuter la requête SQL
    $stmt = $conn->prepare("SELECT numero_telephone FROM utilisateur WHERE numero_telephone = ?");
    $stmt->bind_param("s", $numero_telephone);
    $stmt->execute();
    $stmt->store_result();

    // Vérifier si le numéro existe déjà
    if ($stmt->num_rows > 0) {
        echo json_encode(array("exists" => true));
    } else {
        echo json_encode(array("exists" => false));
    }

    // Fermer la déclaration et la connexion
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(array("error" => "Veuillez fournir un numero_telephone"));
}
?>
