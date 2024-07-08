<?php
session_set_cookie_params(86400); // 24 heures
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tableau_de_bord</title>
    <link rel="stylesheet" href="style_t.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="logo">
            <img id="logo_w" src="../assets/WhatsApp-logo/02_Inline/01_Digital/03_PNG/White/Digital_Inline_White.png" alt="">
        </div>
    </header>

    <main>
        <div class="settings">
            <img id="user-photo" class="user-photo" src="#" alt="Photo de profil" style="display: none;">

            <img class="icons" data-target="message-interface" src="../assets/message.png" alt="">
            <img class="icons" data-target="appel-interface" src="../assets/telephone.png" alt="">
            <img class="icons" data-target="paramettre-interface" src="../assets/paramettre.png" alt="">
            <a class="singOut" href="../API/deconnexion.php">Log out</a>
        </div>

        <div class="interface hidden" id="message-interface">
            <div class="contacts">
                <h2>Contacts</h2>
            </div>
            <div class="interactions">
                Contenu de l'interface de message
            </div>
        </div>

        <div class="interface hidden" id="appel-interface">
            Contenu de l'interface d'appel
        </div>

        <div class="interface hidden" id="paramettre-interface">
            Contenu de l'interface de paramètre
        </div>

        <div class="interface default-interface" data-target="default-interface" id="default-interface">
            <img class="logo-interface" src="../assets/WhatsApp-logo/01_Glyph/01_Digital/03_PNG/Green/Digital_Glyph_Green.png" alt="">
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Examen. Tous droits réservés.</p>
    </footer>

    <script src="../SCRIPTS/fenetre.js"></script>
</body>
</html>
