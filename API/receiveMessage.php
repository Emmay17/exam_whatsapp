<?php
session_set_cookie_params(86400); // 24 heures
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Inclusion du fichier de connexion à la base de données
require_once('../API/db.php');

$retour = array();

// Vérification des paramètres expéditeur et destinataire
if (isset($_SESSION['numero'], $_GET['receveur']) && !empty($_SESSION['numero']) && !empty($_GET['receveur'])) {
    $expediteur = $_SESSION['numero']; // Récupération du numéro de téléphone de l'expéditeur depuis la session
    $receveur = $_GET['receveur'];

    try {
        // Utilisation de requêtes préparées pour éviter les injections SQL
        $stmt = $conn->prepare("SELECT expediteur, receveur, message, date_envoie FROM messages WHERE (expediteur = :expediteur AND receveur = :receveur) OR (expediteur = :receveur AND receveur = :expediteur) ORDER BY date_envoie DESC");
        $stmt->bindParam(':expediteur', $expediteur);
        $stmt->bindParam(':receveur', $receveur);
        $stmt->execute();
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $retour['etat'] = 'Success';
        $retour['messages'] = $messages;
        $retour['expediteur'] = $expediteur; // Ajout du numéro de l'expéditeur à la réponse
    } catch (PDOException $e) {
        $retour['etat'] = 'Error';
        $retour['message'] = 'Erreur lors de la récupération des messages : ' . $e->getMessage();
    }
} else {
    $retour['etat'] = 'Error';
    $retour['message'] = 'Veuillez fournir les paramètres expéditeur et receveur';
}

// Assurer que la sortie est JSON valide
echo json_encode($retour);
?>
