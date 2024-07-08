<?php
session_set_cookie_params(86400); // 24 heures
session_start();
?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhatsApp Web</title>
    <link rel="stylesheet" href="../INTERFACES/chat-styles.css">
</head>
<body>
    <h1 class="title">
        <ion-icon name="logo-whatsapp" style="font-size: 30px;"></ion-icon>
        <span style="position:relative; bottom: 5px;">WhatsApp Web 2.0</span>
    </h1>
    <div class="conteneur">
        <div class="sidebar">
            
            <div class="contacts">
                <div class="header">
                    <div class="image-profil">
                        <img id="myProfileImage" src="#" alt="image de profil" class="cover-profil">
                    </div>
                    <h3 style="color: black;" id="sessionName"></h2>
                    <ul class="menu">
                        <li><ion-icon name="scan-circle-outline" id="open-status"></ion-icon></li>
                        <li><ion-icon name="chatbox" id="open-message"></ion-icon></li>
                        <li><ion-icon name="ellipsis-vertical" id="sidebar-menu-toggle"></ion-icon>
                        <div class="sidebar-menu" id="sidebar-menu">
                            <ul>
                                <li>Nouveau groupe</li>
                                <li>Nouvelle communauté</li>
                                <li>Message favori</li>
                                <li>Selectionner les discussions</li>
                                <li><a href="../INTERFACES/contacts.php" target="_blank">Nouveau Contact</a></li>
                                <li>Reglages</li>
                                <li id="toggle-dark-mode">Mode Clair / Sombre</li>
                                <li id="deconnexion">Deconnexion</li>
                            </ul>
                        </div>
                        </li>
                    </ul>
                </div>
                <div class="recherche">
                    <input type="text" placeholder="Rechercher ou demarrer une discussion">
                    <ion-icon name="search-outline"></ion-icon>
                </div>
                <div class="liste-contacts">
                    <!-- <div class="contact actif non-lu">
                        <div class="contact-photo">
                            <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="image de profil" class="cover-profil" id="myProfileImageContacts">
                        </div>
                        <div class="contact-message">
                            <div class="nom-heure">
                                <h4 class="nom">Contact 1</h4>
                                <p class="heure"></p>
                            </div>
                            <div class="dernier-message">
                                <p></p>
                                <b>1</b>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="profile" style="display: none;">
                <div class="header height">
                    <h2 class="section-title"><span><ion-icon name="arrow-back-outline" id="retour-profile"></ion-icon></span>Profil</h2>
                </div>
                <div class="liste-contacts profile-pic">
                    <div class="image">
                        <label for="profileImageInput">
                            <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="modifier votre photo de profil" class="cover" id="myProfileImageInput">
                        </label>
                        <input type="file" id="profileImageInput" accept="image/jpg, image/jpeg, image/png" required>
                    </div>
                </div>
                <div class="info-profile">
                    <h4 class="nom">Votre nom</h4>
                    <input type="text" placeholder="" maxlength="25" id="username" disabled>
                    <span class="char-count-nom" style="display: none;"></span>
                    <ion-icon name="pencil" id="penNom"></ion-icon>
                    <ion-icon name="checkmark-sharp" id="checkNom" style="display: none;"></ion-icon><br>
                    <h4 class="nom">Infos</h4>
                    <input type="text" placeholder="" maxlength="100" id="infos" disabled>
                    <span class="char-count-infos" style="display: none;"></span>
                    <ion-icon name="pencil" id="penInfos"></ion-icon>
                    <ion-icon name="checkmark-sharp" id="checkInfos" style="display: none;"></ion-icon><br>
                    <h4 class="nom">Numéro de téléphone</h4>
                    <input type="text" id="phoneNumber" placeholder="" disabled>
                </div>
            </div>
            <div class="statuts" style="display: none;">
                <div class="header height">
                    <h2 class="section-title"><span><ion-icon name="arrow-back-outline" id="retour-status"></ion-icon></span>Status</h2>
                </div>
                <div class="mon-statut">
                    <h3>MON STATUT</h3>
                    <div class="statut-item">
                        <div class="statut-miniature actif non-vu">
                            <div class="miniature">
                                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="voir le status" class="cover-status">
                            </div>
                            <div class="statut-message">
                                <h4>Mon statut</h4>
                                <p>Aucune mise à jour</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="statut-recent">
                    <h3>RECENTS</h3>
                    <div class="statut-item">
                        <div class="statut-miniature actif non-vu">
                            <div class="miniature">
                                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="voir le statut" class="cover-statut">
                            </div>
                            <div class="statut-message">
                                <h4>Contact 1</h4>
                                <p>Aujourd'hui à 9:31 pm</p>
                            </div>
                        </div>
                    </div>
                    <div class="statut-item">
                        <div class="statut-miniature non-vu">
                            <div class="miniature">
                                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="voir le statut" class="cover-statut">
                            </div>
                            <div class="statut-message">
                                <h4>Contact 2</h4>
                                <p>Aujourd'hui à 10:31 pm</p>
                            </div>
                        </div>
                    </div>
                    <!-- Ajouter d'autres statuts récents ici -->
                </div>
            </div>
            <div class="nouveau-message" style="display: none;">
                <div class="header height">
                    <h2 class="section-title"><span><ion-icon name="arrow-back-outline" id="retour-message"></ion-icon></span>Nouveau message</h2>
                </div>
                <div class="recherche">
                    <input type="text" placeholder="Rechercher nom ou numéro de téléphone">
                    <ion-icon name="search-outline"></ion-icon>
                </div>
                <div class="liste-contacts">
                    <div class="contact statut-miniature">
                        <div class="contact-photo">
                            <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="image de profil" class="cover-profil" id="myProfileImageNewMessage">
                        </div>
                        <div class="contact-infos">
                            <div class="nom-infos">
                                <h4 class="nom">Contact 1</h4>
                                <p class="infos"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="chat">
            <div class="header">
                <div class="profil-contact">
                        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="image de profil" class="cover-profil" id="myProfileImageChat">
                </div>
                <ul class="menu">
                    <li><ion-icon name="videocam-outline"></ion-icon></li>
                    <li><ion-icon name="call-outline"></ion-icon></li>
                    <li><ion-icon name="search-outline"></ion-icon></li>
                    <li><ion-icon name="ellipsis-vertical" id="chat-menu-toggle"></ion-icon>
                    <div class="chat-menu" id="chat-menu">
                        <ul>
                            <li>Information contact</li>
                            <li>Selectionner les messages</li>
                            <li>Fermer la discussion</li>
                            <li>Effacer la discussion</li>
                            <li>Supprimer la discussion</li>
                            <li>Bloquer le contact</li>
                        </ul>
                    </div>
                    </li>
                </ul>
            </div>
            <div class="chat-body" id="chat-body">
                <div>
                    <div class="message recu">
                    </div>
                    <div class="message envoye">
                    </div>
                </div>
            </div>
            <div class="chat-footer">
                <ion-icon name="happy-outline"></ion-icon>
                <ion-icon name="attach-outline"></ion-icon>
                <input type="text" placeholder="Taper un message" id="message-input">
                <ion-icon name="mic" id="mic-button"></ion-icon>
                <ion-icon name="send" id="send-button" style="display: none;"></ion-icon>
            </div>
        </div>
    </div>
    <script src="../SCRIPTS/scripts.js"></script>
    <script src="../SCRIPTS/loadProfile.js"></script>
    <script src="../SCRIPTS/recuperation_contact.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
