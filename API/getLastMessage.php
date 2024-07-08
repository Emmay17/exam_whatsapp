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

if ($_SERVER["REQUEST_METHOD"] === 'GET') {
    if (isset($_GET['receveur']) && !empty($_GET['receveur']) && isset($_GET['expediteur']) && !empty($_GET['expediteur'])) {
        $receveur = $_GET['receveur'];
        $expediteur = $_GET['expediteur'];

        try {
            // Utilisation de requêtes préparées pour éviter les injections SQL
            $stmt = $conn->prepare("
                SELECT message, date_envoie 
                FROM messages 
                WHERE (receveur = :receveur AND expediteur = :expediteur) 
                   OR (expediteur = :receveur AND receveur = :expediteur) 
                ORDER BY date_envoie DESC 
                LIMIT 1
            ");
            $stmt->bindParam(':receveur', $receveur);
            $stmt->bindParam(':expediteur', $expediteur);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $retour['etat'] = 'Success';
                $retour['message'] = $result['message'];
                $retour['date_envoie'] = $result['date_envoie'];
            } else {
                $retour['etat'] = 'Error';
                $retour['message'] = 'Aucun message trouvé';
            }
        } catch (Exception $e) {
            $retour['etat'] = 'Error';
            $retour['message'] = 'Erreur lors de la récupération du message : ' . $e->getMessage();
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
