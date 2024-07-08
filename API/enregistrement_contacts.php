<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_set_cookie_params(86400); // 24 heures
session_start();

// Connexion à la base de données MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "WB2";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die(json_encode(array("status" => "error", "message" => "Connection failed: " . $conn->connect_error)));
}

// Récupération des données du formulaire
if (!isset($_SESSION['numero'])) {
    echo json_encode(array("status" => "error", "message" => "Numéro de téléphone non trouvé dans la session."));
    exit;
}

$phoneNumber = $_SESSION['numero'];
$contactName = $_POST['nom_contact'];
$contact = $_POST['numero_contact'];

try {
    // Vérifier si le propriétaire existe dans la table des utilisateurs
    $checkOwnerQuery = "SELECT * FROM utilisateur WHERE numero_telephone = '$phoneNumber'";
    $ownerResult = $conn->query($checkOwnerQuery);

    if ($ownerResult->num_rows > 0) {
        // Le propriétaire existe, récupérer l'ID du propriétaire
        $ownernumber = $ownerResult->fetch_assoc()['numero_telephone'];

        // Vérifier si l'utilisateur existe dans la table des utilisateurs
        $checkUserQuery = "SELECT * FROM utilisateur WHERE numero_telephone = '$contact'";
        $userResult = $conn->query($checkUserQuery);

        if ($userResult->num_rows > 0) {
            // L'utilisateur existe, vérifier si ce n'est pas le propriétaire lui-même
            $userDetails = $userResult->fetch_assoc();
            $userId = $userDetails['numero_telephone'];

            if ($userId == $ownernumber) {
                // Le contact ne peut pas être le propriétaire lui-même
                echo json_encode(array("status" => "error", "message" => "Vous ne pouvez pas vous ajouter en tant que contact"));
            } else {
                // Vérifier si le contact n'est pas déjà dans les contacts du propriétaire
                $checkContactQuery = "SELECT * FROM contacts WHERE contact = '$userId' AND numero_proprio = '$ownernumber'";
                $contactResult = $conn->query($checkContactQuery);

                if ($contactResult->num_rows > 0) {
                    // L'utilisateur est déjà dans les contacts du propriétaire
                    echo json_encode(array("status" => "error", "message" => "Utilisateur déjà dans vos contacts"));
                } else {
                    // Ajouter l'utilisateur aux contacts du propriétaire
                    $addContactQuery = "INSERT INTO contacts (numero_proprio, contact, nom_contact, date_enregistrement) 
                    VALUES ('$ownernumber', '$userId', '$contactName', NOW())";
                    if ($conn->query($addContactQuery) === TRUE) {
                        echo json_encode(array("status" => "success", "message" => "Utilisateur ajouté aux contacts"));
                    } else {
                        echo json_encode(array("status" => "error", "message" => "Erreur lors de l'ajout de l'utilisateur aux contacts: " . $conn->error));
                    }
                }
            }
        } else {
            // L'utilisateur n'existe pas dans la table des utilisateurs
            echo json_encode(array("status" => "error", "message" => "Cet utilisateur n'a pas WhatsApp"));
        }
    } else {
        // Le propriétaire n'existe pas dans la table des utilisateurs
        echo json_encode(array("status" => "error", "message" => "Propriétaire non trouvé"));
    }
} catch (Exception $e) {
    echo json_encode(array("status" => "error", "message" => "Exception lors de l'ajout de l'utilisateur aux contacts: " . $e->getMessage()));
}

// Fermer la connexion
$conn->close();
?>
