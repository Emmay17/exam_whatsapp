<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Contact</title>
    <link rel="stylesheet" href="../INTERFACES/style_contacts.css">
</head>
<body>

<header>
    <img src="../assets/WhatsApp-logo/02_Inline/01_Digital/03_PNG/White/Digital_Inline_White.png" alt="whatsapp logo">
</header>
<main>
    <div class="container">
        <div class="header">
            <h1>Ajouter un Contact</h1>
        </div>
        <form id="addContactForm" class="contact-form">
            <div class="form-group">
                <!-- <label for="nom_contact">Nom:</label> -->
                <input type="text" id="nom_contact" placeholder="Nom contact" name="nom_contact" required>
            </div>
            <div class="form-group">
                <!-- <label for="numero_contact">Numéro de téléphone:</label> -->
                <input type="tel" id="numero_contact" name="numero_contact" placeholder="Numéro de téléphone" pattern="[0-9]{10}" maxlength="10" required>
                <small>Entrez un numéro à 10 chiffres.</small>
            </div>
            <div class="form-group">
                <button type="submit">Ajouter</button>
            </div>
        </form>
        <div id="errorMessage" style="display: none; color: red; margin-top: 10px;"></div>
    </div>
</main>

<script src="../SCRIPTS/enregistrement_contacts_js.js"></script>
</body>
</html>
