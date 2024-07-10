document.addEventListener('DOMContentLoaded', function () {
    const toggleDarkModeButton = document.querySelectorAll('#toggle-dark-mode, #toggle-dark-mode-chat');
    const messageInput = document.getElementById('message-input');
    const sendButton = document.getElementById('send-button');
    const micButton = document.getElementById('mic-button');
    const chatBody = document.getElementById('chat-body');
    const deconnecterButton = document.getElementById('deconnexion');
    const sidebarMenuToggle = document.getElementById('sidebar-menu-toggle');
    const chatMenuToggle = document.getElementById('chat-menu-toggle');
    const profileImage = document.getElementById('myProfileImage');
    const openProfileIcon = document.getElementById('myProfileImageChat');
    const openStatusIcon = document.getElementById('open-status');
    const openMessageIcon = document.getElementById('open-message');
    const retourProfileIcon = document.getElementById('retour-profile');
    const retourStatusIcon = document.getElementById('retour-status');
    const retourMessageIcon = document.getElementById('retour-message');
    const penNomButton = document.getElementById('penNom');
    const checkNomButton = document.getElementById('checkNom');
    const penInfosButton = document.getElementById('penInfos');
    const checkInfosButton = document.getElementById('checkInfos');
    const usernameInput = document.getElementById('username');
    const infosInput = document.getElementById('infos');
    const profileImageInput = document.getElementById('profileImageInput');
    const myProfileImageContacts = document.getElementById('myProfileImageContacts');
    const myProfileImageInput = document.getElementById('myProfileImageInput');
    const myProfileImageNewMessage = document.getElementById('myProfileImageNewMessage');
    const attachButton = document.getElementById('attach-button');
    const emojiButton = document.getElementById('emoji-button');
    const emojiMenu = document.getElementById('emoji-menu');
    const emojis = [
        '😀', '😃', '😄', '😁', '😆', '😅', '😂', '🤣', '😊', '😇', '🙂', '🙃', '😉', '😌', '😍', '🥰', '😘', '😗', '😙', '😚', '😋', '😛', '😜', '🤪', '😝',
        '🤑', '🤗', '🤭', '🤫', '🤔', '🤐', '🤨', '😐', '😑', '😶', '😏', '😒', '🙄', '😬', '🤥', '😌', '😔', '😪', '🤤', '😴', '😷', '🤒', '🤕', '🤢',
        '🤮', '🤧', '😵', '🤯', '🤠', '🥳', '😎', '🤓', '🧐', '😕', '😟', '🙁', '😮', '😯', '😲', '😳', '🥺', '😦', '😧', '😨', '😰', '😥', '😢', '😭',
        '😱', '😖', '😣', '😞', '😓', '😩', '😫', '🥱', '😤', '😡', '😠', '🤬', '😈', '👿', '💀', '☠️', '💩', '🤡', '👹', '👺', '👻', '👽', '👾', '🤖',
        '😺', '😸', '😹', '😻', '😼', '😽', '🙀', '😿', '😾', '🙈', '🙉', '🙊', '👀', '👁️', '💋', '💌', '💘', '💝', '💖', '💗', '💓', '💞', '💕', '💟', '❣️', '💔',
        '❤️', '🧡', '💛', '💚', '💙', '💜', '🤎', '🖤', '🤍', '💯', '💢', '💥', '💫', '💦', '💨', '🕳️', '💣', '💬', '👁️‍🗨️', '🗨️', '🗯️', '💭', '💤',
        '🎉', '🎊', '🎂'
    ];


    // Activer / désactiver dark mode
    toggleDarkModeButton.forEach(button => {
        button.addEventListener('click', function () {
            document.body.classList.toggle('dark-mode');
        });
    });

    // Deconnexion
    deconnecterButton.addEventListener('click', function () {
        window.location.href = '../API/deconnexion.php';
    });

    // Envoie message par click
    // sendButton.addEventListener('click', function () {
    //     const messageText = messageInput.value;
    //     if (messageText.trim() !== '') {
    //         const messageElement = createMessageElement(messageText, 'envoye');
    //         chatBody.appendChild(messageElement);
    //         updateLastMessage('Contact 1', messageText, getCurrentTime());
    //         messageInput.value = '';
    //         messageElement.scrollIntoView({ behavior: 'smooth' });
    //         toggleMicSendButton();
    //     }
    // });

    // Envoie message par entrer
    messageInput.addEventListener('keypress', function (event) {
        if (event.key === 'Enter') {
            sendButton.click();
        }
    });

    // Permuter bouton micro / envoyer
    messageInput.addEventListener('input', function () {
        toggleMicSendButton();
    });

    function toggleMicSendButton() {
        if (messageInput.value.trim() !== '') {
            micButton.style.display = 'none';
            sendButton.style.display = 'inline';
        } else {
            micButton.style.display = 'inline';
            sendButton.style.display = 'none';
        }
    }

    // Creer un message
    // function createMessageElement(text, type) {
    //     const messageElement = document.createElement('div');
    //     messageElement.classList.add('message', type);
    //     messageElement.innerHTML = `<p>${text}<br><span>${getCurrentTime()}</span></p>`;
    //     return messageElement;
    // }

    // Obtenir l'heure actuelle
    // function getCurrentTime() {
    //     const now = new Date();
    //     return now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    // }

    // Mettre à jour le dernier message dans le sidebar
    // function updateLastMessage(contactName, messageText, time) {
    //     const contactElement = Array.from(document.querySelectorAll('.contact')).find(contact => 
    //         contact.querySelector('.nom').textContent.trim() === contactName
    //     );
    //     if (contactElement) {
    //         const lastMessageElement = contactElement.querySelector('.dernier-message p');
    //         const timeElement = contactElement.querySelector('.nom-heure .heure');
    //         const unreadBadge = contactElement.querySelector('.dernier-message b');

    //         lastMessageElement.textContent = messageText;
    //         timeElement.textContent = time;

    //         // Marquer comme lu
    //         timeElement.style.color = 'var(--txtColor2)';
    //         if (unreadBadge) {
    //             unreadBadge.remove();
    //         }
    //     }
    // }

    // Sidebar menu permutation
    sidebarMenuToggle.addEventListener('click', function () {
        document.getElementById('sidebar-menu').classList.toggle('visible');
    });

    // Chat menu permutation
    chatMenuToggle.addEventListener('click', function () {
        document.getElementById('chat-menu').classList.toggle('visible');
    });

    // Masquer le menu en cliquant en dehors
    document.addEventListener('click', function (event) {
        if (!event.target.closest('#sidebar-menu') && !event.target.closest('#sidebar-menu-toggle')) {
            document.getElementById('sidebar-menu').classList.remove('visible');
        }
        if (!event.target.closest('#chat-menu') && !event.target.closest('#chat-menu-toggle')) {
            document.getElementById('chat-menu').classList.remove('visible');
        }
    });

    // Afficher le message de bienvenue
    // function displayWelcomeMessage() {
    //     const hours = new Date().getHours();
    //     const isDayTime = hours >= 6 && hours < 18;
    //     const welcomeText = isDayTime 
    //         ? "Bonjour, bienvenue dans Whatsapp Web 2.0 !" 
    //         : "Bonsoir, bienvenue dans Whatsapp Web 2.0 !";
    //     const messageElement = createMessageElement(welcomeText, 'recu');
    //     chatBody.appendChild(messageElement);
    //     updateLastMessage('Contact 1', welcomeText, getCurrentTime());
    //     messageElement.scrollIntoView({ behavior: 'smooth' });
    // }

    // Afficher le message de bienvenue au chargement
    // displayWelcomeMessage();

    // Profile Modification
    profileImageInput.addEventListener('change', function () {
        const reader = new FileReader();
        reader.onload = function(e) {
            myProfileImageInput.src = e.target.result;
            profileImage.src = e.target.result;
            myProfileImageContacts.src = e.target.result;
            openProfileIcon.src = e.target.result;
            myProfileImageNewMessage.src = e.target.result;

            let userData = JSON.parse(localStorage.getItem('userData')) || {};
            userData.profileImage = e.target.result;
            localStorage.setItem('userData', JSON.stringify(userData));
        };
        reader.readAsDataURL(this.files[0]);
    });

    usernameInput.addEventListener('input', function () {
        let userData = JSON.parse(localStorage.getItem('userData')) || {};
        userData.username = this.value;
        document.querySelector('.contact-message .nom').textContent = this.value + ' (Moi)';
        document.querySelector('.profil-contact .nom').textContent = this.value + ' (Moi)';
        document.querySelector('.contact-infos .nom').textContent = this.value + ' (Moi)';
        localStorage.setItem('userData', JSON.stringify(userData));
        updateCharCount(usernameInput);
    });

    infosInput.addEventListener('input', function () {
        let userData = JSON.parse(localStorage.getItem('userData')) || {};
        userData.infos = this.value;
        document.querySelector('.contact-infos .infos').textContent = this.value;
        localStorage.setItem('userData', JSON.stringify(userData));
        updateCharCount(infosInput);
    });

     // Initialisation des variables pour l'enregistrement audio
     let mediaRecorder;
     let audioChunks = [];
 
     // Gérer le bouton micro pour enregistrer l'audio
     micButton.addEventListener('click', function () {
         if (mediaRecorder && mediaRecorder.state === "recording") {
             mediaRecorder.stop();
             micButton.classList.remove('recording');
             micButton.name = 'mic'; // Changer l'icône pour le micro
         } else {
             startRecording();
         }
     });
 
     // Fonction pour démarrer l'enregistrement audio
     function startRecording() {
         navigator.mediaDevices.getUserMedia({ audio: true })
             .then(stream => {
                 mediaRecorder = new MediaRecorder(stream);
                 mediaRecorder.start();
                 micButton.classList.add('recording');
                 micButton.name = 'square'; // Changer l'icône pour indiquer l'arrêt
         
                 mediaRecorder.ondataavailable = event => {
                     audioChunks.push(event.data);
                 };
 
                 mediaRecorder.onstop = () => {
                     const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
                     audioChunks = [];
                     const audioUrl = URL.createObjectURL(audioBlob);
                     const messageElement = createMessageElementAudio(audioUrl);
                     chatBody.appendChild(messageElement);
                     messageElement.scrollIntoView({ behavior: 'smooth' });
 
                     // Réinitialiser l'icône du micro
                     micButton.name = 'mic';
                     micButton.classList.remove('recording');
                 };
             })
             .catch(error => {
                 console.error('Erreur lors de l\'enregistrement audio :', error);
             });
     }
 
     // Fonction pour créer un élément de message audio
     function createMessageElementAudio(audioUrl) {
         const messageElement = document.createElement('div');
         messageElement.classList.add('message', 'envoye');
         messageElement.innerHTML = `<p><audio controls><source src="${audioUrl}" type="audio/wav">Votre navigateur ne supporte pas l'élément audio.</audio><br><span>${getCurrentTime()}</span></p>`;
         return messageElement;
     }
 

    // Attach menu permutation
    attachButton.addEventListener('click', function () {
        document.getElementById('attach-menu').classList.toggle('visible');
    });

    // Gérer les fonctionnalités des pièces jointes
    const attachDocument = document.getElementById('attach-document');
    const attachPhotoVideo = document.getElementById('attach-photo-video');
    const attachCamera = document.getElementById('attach-camera');

    const fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.style.display = 'none';
    document.body.appendChild(fileInput);

    attachDocument.addEventListener('click', function () {
        fileInput.accept = '.pdf,.doc,.docx,.txt';
        fileInput.onchange = function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const messageElement = document.createElement('div');
                    messageElement.classList.add('message', 'envoye');
                    messageElement.innerHTML = `<p><a href="${e.target.result}" download="${file.name}">${file.name}</a><br><span>${getCurrentTime()}</span></p>`;
                    chatBody.appendChild(messageElement);
                    messageElement.scrollIntoView({ behavior: 'smooth' });
                };
                reader.readAsDataURL(file);
            }
        };
        fileInput.click();
    });

    attachPhotoVideo.addEventListener('click', function () {
        fileInput.accept = 'image/*,video/*';
        fileInput.onchange = function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const messageElement = document.createElement('div');
                    messageElement.classList.add('message', 'envoye');
                    if (file.type.startsWith('image/')) {
                        messageElement.innerHTML = `<p><img src="${e.target.result}" alt="${file.name}" style="max-width: 200px;"><br><span>${getCurrentTime()}</span></p>`;
                    } else if (file.type.startsWith('video/')) {
                        messageElement.innerHTML = `<p><video src="${e.target.result}" controls style="max-width: 200px;"></video><br><span>${getCurrentTime()}</span></p>`;
                    }
                    chatBody.appendChild(messageElement);
                    messageElement.scrollIntoView({ behavior: 'smooth' });
                };
                reader.readAsDataURL(file);
            }
        };
        fileInput.click();
    });

    // Ajouter les éléments pour l'aperçu en direct et le bouton de capture
    const livePreviewContainer = document.createElement('div');
    const livePreviewVideo = document.createElement('video');
    const captureButton = document.createElement('button');

    livePreviewContainer.style.display = 'none'; // Masquer l'aperçu en direct par défaut
    livePreviewContainer.style.position = 'fixed'; // Placer l'aperçu en direct au-dessus du contenu
    livePreviewContainer.style.top = '0';
    livePreviewContainer.style.left = '0';
    livePreviewContainer.style.width = '100%';
    livePreviewContainer.style.height = '100%';
    livePreviewContainer.style.backgroundColor = 'rgba(0, 0, 0, 0.8)'; // Fond semi-transparent
    livePreviewContainer.style.zIndex = '1000'; // Placer au-dessus de tout

    livePreviewVideo.style.width = '100%';
    livePreviewVideo.style.height = 'auto';

    captureButton.textContent = 'Capture';
    captureButton.style.position = 'absolute';
    captureButton.style.bottom = '20px';
    captureButton.style.left = '50%';
    captureButton.style.transform = 'translateX(-50%)';
    captureButton.style.padding = '10px 20px';
    captureButton.style.fontSize = '16px';
    captureButton.style.color = '#fff';
    captureButton.style.backgroundColor = '#007bff';
    captureButton.style.border = 'none';
    captureButton.style.borderRadius = '5px';
    captureButton.style.cursor = 'pointer';

    livePreviewContainer.appendChild(livePreviewVideo);
    livePreviewContainer.appendChild(captureButton);
    document.body.appendChild(livePreviewContainer);

    // Attache Caméra
    attachCamera.addEventListener('click', function () {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                livePreviewVideo.srcObject = stream;
                livePreviewContainer.style.display = 'flex';
                livePreviewVideo.play();

                captureButton.onclick = function () {
                    const canvas = document.createElement('canvas');
                    canvas.width = livePreviewVideo.videoWidth;
                    canvas.height = livePreviewVideo.videoHeight;
                    const context = canvas.getContext('2d');
                    context.drawImage(livePreviewVideo, 0, 0, canvas.width, canvas.height);
                    canvas.toBlob(blob => {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const messageElement = document.createElement('div');
                            messageElement.classList.add('message', 'envoye');
                            messageElement.innerHTML = `<p><img src="${e.target.result}" alt="captured image" style="max-width: 100%; height: auto;"><br><span>${getCurrentTime()}</span></p>`;
                            chatBody.appendChild(messageElement);
                            messageElement.scrollIntoView({ behavior: 'smooth' });
                        };
                        reader.readAsDataURL(blob);

                        // Arrêter le flux vidéo et masquer l'aperçu en direct
                        stream.getTracks().forEach(track => track.stop());
                        livePreviewContainer.style.display = 'none';
                    }, 'image/jpeg');
                };
            })
            .catch(error => {
                console.error('Erreur lors de l\'accès à la caméra :', error);
            });
    });

    // Afficher les emojis dans le menu
    emojis.forEach(emoji => {
        const emojiSpan = document.createElement('span');
        emojiSpan.textContent = emoji;
        emojiMenu.appendChild(emojiSpan);

        // Ajouter un événement de clic sur chaque emoji pour l'insérer dans le champ de texte
        emojiSpan.addEventListener('click', function () {
            messageInput.value += emoji;
            messageInput.focus();
        });
    });

    // Afficher/Masquer le menu des emojis
    emojiButton.addEventListener('click', function () {
        if (emojiMenu.style.display === 'none' || emojiMenu.style.display === '') {
            emojiMenu.style.display = 'block';
        } else {
            emojiMenu.style.display = 'none';
        }
    });

    // Masquer les menus en cliquant en dehors
    document.addEventListener('click', function (event) {
        if (!event.target.closest('#sidebar-menu') && !event.target.closest('#sidebar-menu-toggle')) {
            document.getElementById('sidebar-menu').classList.remove('visible');
        }
        if (!event.target.closest('#chat-menu') && !event.target.closest('#chat-menu-toggle')) {
            document.getElementById('chat-menu').classList.remove('visible');
        }
        if (!event.target.closest('#attach-menu') && !event.target.closest('#attach-button')) {
            document.getElementById('attach-menu').classList.remove('visible');
        }
        if (!emojiButton.contains(event.target) && !emojiMenu.contains(event.target)) {
            emojiMenu.style.display = 'none';
        }
    });

    // Appels audio / vidéo
    const videoCallButton = document.querySelector('.chat .menu li ion-icon[name="videocam-outline"]');
    const phoneCallButton = document.querySelector('.chat .menu li ion-icon[name="call-outline"]');

    videoCallButton.addEventListener('click', function () {
        window.location.href = 'calls3_1/videocall.html';
    });
    phoneCallButton.addEventListener('click', function () {
        window.location.href = 'calls3_1/phonecall.html';
    });

    // Afficher settings
    const settingsButton = document.getElementById('settings');

    settingsButton.addEventListener('click', function () {
        window.location.href = 'calls3_1/settings.html';
    });

    // Ouvrir / fermer les onglets
    profileImage.addEventListener('click', openProfile);
    openStatusIcon.addEventListener('click', openStatus);
    openMessageIcon.addEventListener('click', openMessage);
    retourProfileIcon.addEventListener('click', retour);
    retourStatusIcon.addEventListener('click', retour);
    retourMessageIcon.addEventListener('click', retour);


    function openProfile() {
        document.querySelector('.contacts').style.display = 'none';
        document.querySelector('.profile').style.display = 'block';
    }

    function openStatus() {
        document.querySelector('.contacts').style.display = 'none';
        document.querySelector('.statuts').style.display = 'block';
    }

    function openMessage() {
        document.querySelector('.contacts').style.display = 'none';
        document.querySelector('.nouveau-message').style.display = 'block';
    }

    function retour() {
        const inputNom = document.getElementById('username');
        inputNom.disabled = true;
        const inputInfos = document.getElementById('infos');
        inputInfos.disabled = true;
        document.querySelector('.contacts').style.display = 'block';
        document.querySelector('.profile').style.display = 'none';
        document.querySelector('.statuts').style.display = 'none';
        document.querySelector('.nouveau-message').style.display = 'none';
        checkNomButton.style.display = 'none';
        penNomButton.style.display = 'block';
        checkInfosButton.style.display = 'none';
        penInfosButton.style.display = 'block';
        document.querySelector('.char-count-nom').style.display = 'none';
        document.querySelector('.char-count-infos').style.display = 'none';
    }

    // Modifier Nom and Infos
    penNomButton.addEventListener('click', function() {
        modifierNom(usernameInput, penNomButton, checkNomButton);
    });

    checkNomButton.addEventListener('click', function() {
        desactiverNom();
    });

    penInfosButton.addEventListener('click', function() {
        modifierInfos(infosInput, penInfosButton, checkInfosButton);
    });

    checkInfosButton.addEventListener('click', function() {
        desactiverInfos();
    });

    usernameInput.addEventListener('keydown', function(event) {
        if (event.key === "Enter") {
            desactiverNom();
        }
    });

    infosInput.addEventListener('keydown', function(event) {
        if (event.key === "Enter") {
            desactiverInfos();
        }
    });

    function modifierNom(inputElement, penButton, checkButton) {
        inputElement.disabled = false;
        inputElement.focus();
        penButton.style.display = 'none';
        checkButton.style.display = 'block';
        document.querySelector('.char-count-nom').style.display = 'block';
        updateCharCount(inputElement);
    }

    function desactiverNom() {
        usernameInput.disabled = true;
        checkNomButton.style.display = 'none';
        penNomButton.style.display = 'block';
        document.querySelector('.char-count-nom').style.display = 'none';
    }

    function modifierInfos(inputElement, penButton, checkButton) {
        inputElement.disabled = false;
        inputElement.focus();
        penButton.style.display = 'none';
        checkButton.style.display = 'block';
        document.querySelector('.char-count-infos').style.display = 'block';
        updateCharCount(inputElement);
    }

    function desactiverInfos() {
        infosInput.disabled = true;
        checkInfosButton.style.display = 'none';
        penInfosButton.style.display = 'block';
        document.querySelector('.char-count-infos').style.display = 'none';
    }

    // Mettre à jour le compteur de caractères
    function updateCharCount(inputElement) {
        const maxLength = inputElement.maxLength;
        const currentLength = inputElement.value.length;
        const charCountElement = inputElement.nextElementSibling;
        if (charCountElement) {
            charCountElement.textContent = `${currentLength} / ${maxLength}`;
        }
    }
});
