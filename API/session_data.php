<?php
session_start();

if (!isset($_SESSION['numero'])) {
    $_SESSION['numero'] = '1234567890'; // Définir une valeur de test pour la session
    echo 'Session définie';
} else {
    echo json_encode('Numéro de session: ' . $_SESSION['numero']);
}
?>
