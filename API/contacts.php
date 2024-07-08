<?php
session_set_cookie_params(86400); // 24 heures
session_start();

try {
    // Connexion à la base de données MySQL
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "WB2";

    // Création de la connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérification de la connexion
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Récupération du numéro de téléphone de l'utilisateur connecté
    if (!isset($_SESSION['numero'])) {
        throw new Exception("Numéro de téléphone non trouvé dans la session.");
    }
    $phoneNumber = $_SESSION['numero'];

    // Récupérer les contacts de l'utilisateur avec leurs derniers messages
    $contactsQuery = "
        SELECT c.*, u.photo, m.message, m.date_envoie 
        FROM contacts c 
        JOIN utilisateur u ON c.contact = u.numero_telephone 
        LEFT JOIN messages m ON m.id = (
            SELECT m1.id 
            FROM messages m1 
            WHERE (m1.expediteur = '$phoneNumber' AND m1.receveur = c.contact) 
               OR (m1.expediteur = c.contact AND m1.receveur = '$phoneNumber')
            ORDER BY m1.date_envoie DESC 
            LIMIT 1
        )
        WHERE c.numero_proprio = '$phoneNumber'
        ORDER BY m.date_envoie DESC";

    $contactsResult = $conn->query($contactsQuery);

    if (!$contactsResult) {
        throw new Exception("Erreur lors de l'exécution de la requête: " . $conn->error);
    }

    if ($contactsResult->num_rows > 0) {
        $contacts = array();

        while ($row = $contactsResult->fetch_assoc()) {
            $contact = array(
                'nom_contact' => $row['nom_contact'],
                'numero' => $row['contact'],
                'photo' => $row['photo'],
                'dernier_message' => $row['message'],
                'heure_dernier_message' => $row['date_envoie']
            );
            $contacts[] = $contact;
        }

        echo json_encode(array("status" => "success", "contacts" => $contacts));
    } else {
        echo json_encode(array("status" => "error", "message" => "Aucun contact trouvé"));
    }

    // Fermer la connexion
    $conn->close();
} catch (Exception $e) {
    echo json_encode(array("status" => "error", "message" => $e->getMessage()));
    error_log($e->getMessage(), 0); // Log the error message to the server's error log
}
?>
