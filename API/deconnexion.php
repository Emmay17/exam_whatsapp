<?php
// Démarre ou restaure la session
session_start();

// Détruit toutes les variables de session
$_SESSION = array();

// Si nécessaire, détruit la session
if (session_status() === PHP_SESSION_ACTIVE) {
    session_destroy();
}

// Redirige vers la page d'accueil (ou une autre page de votre choix)
header("Location: ../INTERFACES/authentification.html");
exit;
?>
