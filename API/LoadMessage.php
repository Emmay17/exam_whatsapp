<?php
session_set_cookie_params(86400); // 24 heures
session_start();

// Vérification de la session pour le numéro de téléphone
if (!isset($_SESSION['numero'])) {
    echo json_encode(array("etat" => "Error", "message" => "Session expirée ou non connecté"));
    exit;
}

$expediteur = $_SESSION['numero'];
$expe = $_SESSION['numero'];

// Vérification des paramètres de requête
if (!isset($_GET['receveur']) || empty($_GET['receveur'])) {
    echo json_encode(array("etat" => "Error", "message" => "Paramètre receveur manquant"));
    exit;
}

$receveur = $_GET['receveur'];

// Connexion à la base de données
require_once('../API/db.php'); // Assurez-vous de remplacer avec le bon chemin vers votre fichier de connexion

try {
    // Utilisation de requêtes préparées avec PDO
    $stmt = $conn->prepare("SELECT message, date_envoie, expediteur FROM messages WHERE (expediteur = :expediteur AND receveur = :receveur) OR (receveur = :expediteur AND expediteur = :receveur) ORDER BY date_envoie ASC");
    $stmt->bindParam(':expediteur', $expediteur);
    $stmt->bindParam(':receveur', $receveur);
    $stmt->execute();
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);  


    $response = array(
        'etat' => 'Success',
        'messages' => $messages
    );

    echo json_encode($response);
} catch (PDOException $e) {
    $response = array(
        'etat' => 'Error',
        'message' => 'Erreur lors de la récupération des messages : ' . $e->getMessage()
    );

    echo json_encode($response);
} finally {
    // Fermer la connexion et libérer les ressources
    $stmt = null; // Détruire l'objet PDOStatement
    $conn = null; // Fermer la connexion PDO
}
?>
