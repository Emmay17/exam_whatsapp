<?php
session_set_cookie_params(86400); // 24 heures
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

// Inclusion du fichier de connexion à la base de données
require_once('../API/db.php');

$retour = array();

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    // Récupérer le contenu JSON de la requête
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['expediteur'], $input['receveur'], $input['message']) && !empty($input['expediteur']) && !empty($input['receveur']) && !empty($input['message'])) {
        $expediteur = $input['expediteur'];
        $receveur = $input['receveur'];
        $message = $input['message'];
        // $date_envoie = date('Y-m-d H:i:s'); // Date et heure actuelles
        $statut = false; // Statut par défaut, vous pouvez ajuster selon vos besoins

        try {
            // Utilisation de requêtes préparées pour éviter les injections SQL
            $stmt = $conn->prepare("INSERT INTO messages (expediteur, receveur, message, date_envoie) VALUES (:expediteur, :receveur, :message, NOW())");
            $stmt->bindParam(':expediteur', $expediteur);
            $stmt->bindParam(':receveur', $receveur);
            $stmt->bindParam(':message', $message);
            // $stmt->bindParam(':statut', $statut, PDO::PARAM_BOOL);

            if ($stmt->execute()) {
                $retour['etat'] = 'Success';
                $retour['message'] = 'Message envoyé avec succès';
            } else {
                $retour['etat'] = 'Error';
                $retour['message'] = 'Erreur lors de l\'envoi du message';
            }
        } catch (Exception $e) {
            $retour['etat'] = 'Error';
            $retour['message'] = 'Erreur lors de l\'envoi du message : ' . $e->getMessage();
        }
    } else {
        $retour['etat'] = 'Error';
        $retour['message'] = 'Veuillez fournir tous les paramètres requis';
    }
} else {
    $retour['etat'] = 'Error';
    $retour['message'] = 'Méthode de requête non valide';
}

echo json_encode($retour);
?>
