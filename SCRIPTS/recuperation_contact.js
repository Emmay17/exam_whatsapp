let variableExtern = '';
let externSession = '';
let intervalId = null;

document.addEventListener('DOMContentLoaded', function() {
    fetchContacts();

    function fetchContacts() {
        fetch('../API/contacts.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('La réponse du serveur n\'est pas valide');
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    const contactsContainer = document.querySelector('.liste-contacts');
                    contactsContainer.innerHTML = ''; // Vide le contenu précédent

                    data.contacts.forEach(contact => {
                        const contactElement = document.createElement('div');
                        contactElement.classList.add('contact');
                        contactElement.setAttribute('data-contact-id', contact.numero);

                        const date = new Date(contact.heure_dernier_message);
                        const formattedTime = date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

                        const contact_nom = contact.nom_contact;
                        const contact_image = contact.photo;

                        contactElement.innerHTML = `
                            <div class="contact">
                                <div class="contact-photo">
                                    <img src="${contact.photo}" alt="Photo de profil de ${contact.nom_contact}" class="cover-profil">
                                </div>
                                <div class="contact-message">
                                    <div class="nom-heure">
                                        <h4 class="nom">${contact.nom_contact}</h4>
                                        <p class="heure">${formattedTime}</p>
                                    </div>
                                    <div class="dernier-message">
                                        <p>${contact.dernier_message}</p>
                                    </div>
                                </div>
                            </div>
                        `;

                        contactElement.addEventListener('click', function() {
                            const contactId = this.getAttribute('data-contact-id');
                            variableExtern = contact.numero;

                            // Charger les messages et le dernier message
                            loadMessages(variableExtern);
                            loadLastMessage(localStorage.getItem('myVariable'), variableExtern, contact_nom, contact_image);

                            // Si l'intervalle est déjà défini, le réinitialiser
                            if (intervalId) {
                                clearInterval(intervalId);
                            }

                            // Définir l'intervalle pour charger les messages toutes les secondes
                            intervalId = setInterval(() => {
                                loadMessages(variableExtern);
                                loadLastMessage(localStorage.getItem('myVariable'), variableExtern, contact_nom, contact_image);
                            }, 1000);
                        });

                        contactsContainer.appendChild(contactElement);
                    });
                } else {
                    console.error('Erreur lors de la récupération des contacts:', data.message);
                }
            })
            .catch(error => {
                console.error('Erreur lors de la récupération des contacts:', error.message);
            });
    }

    function loadLastMessage(expediteur, receveur, contact_nom, contact_image) {
        fetch(`../API/getLastMessage.php?receveur=${receveur}&expediteur=${expediteur}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('La réponse du serveur n\'est pas valide');
                }
                return response.json(); // Recevoir la réponse JSON
            })
            .then(data => {
                console.log('Réponse JSON du serveur :', data); // Afficher la réponse JSON pour le débogage
                if (data.etat === 'Success') {
                    const profileContainer = document.querySelector('.profil-contact');
                    profileContainer.innerHTML = '';

                    const profileTop = document.createElement('div');
                    profileTop.classList.add('profileTop');
                    profileTop.innerHTML = `
                        <div class="image-profil">
                            <img src="${contact_image}" alt="image de profil" class="cover-profil" id="myProfileImageChat">
                        </div>
                        <h3 class="nom">${contact_nom}<br><span>---</span></h3>
                    `;

                    profileContainer.appendChild(profileTop);
                } else {
                    console.error('Erreur lors de la récupération du dernier message:', data.message);
                }
            })
            .catch(error => {
                console.error('Erreur loadLastMessage:', error.message);
            });
    }

    function loadMessages(contactId) {
        fetch(`../API/LoadMessage.php?receveur=${contactId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('La réponse du serveur n\'est pas valide');
                }
                return response.json(); // Recevoir la réponse JSON
            })
            .then(data => {
                console.log('Réponse JSON du serveur :', data); // Afficher la réponse JSON pour le débogage
    
                if (data.etat === 'Success') {
                    const chatBody = document.querySelector('.chat-body');
                    chatBody.innerHTML = '';
    
                    data.messages.forEach(message => {
                        // Déterminer la classe CSS en fonction de l'expéditeur
                        const myVariable = localStorage.getItem('myVariable');
                        let messageClass = message.expediteur === myVariable ? 'envoye' : 'recu';
    
                        // Créer l'élément de message en fonction de la classe déterminée
                        const messageElement = document.createElement('div');
                        messageElement.classList.add('message', messageClass);
    
                        messageElement.innerHTML = `
                            <p>${message.message}<br>
                            <span>${new Date(message.date_envoie).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</span></p>
                        `;
    
                        chatBody.appendChild(messageElement);
                    });
    
                    // Faire défiler vers le dernier message
                    const lastMessageElement = chatBody.lastElementChild;
                    if (lastMessageElement) {
                        lastMessageElement.scrollIntoView({ behavior: 'smooth' });
                    }
                } else {
                    console.error('Erreur lors de la récupération des messages:', data.message);
                }
            })
            .catch(error => {
                console.error('Erreur loadMessages:', error.message);
            });
    }
    

    // Envoyer un message
    const messageInput = document.getElementById('message-input');

    messageInput.addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Empêcher le comportement par défaut du formulaire (rechargement de la page)

            const message = messageInput.value.trim(); // Récupérer le message et enlever les espaces inutiles

            if (message !== '') {
                const expediteur = localStorage.getItem('myVariable');
                sendMessage(message, expediteur, variableExtern);
                messageInput.value = ''; // Effacer le champ de texte après l'envoi
            }
        }
    });

    function sendMessage(message, expediteur, receveur) {
        fetch('../API/sendMessage.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                expediteur: expediteur,
                receveur: receveur,
                message: message
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.etat === 'Success') {
                console.log('Message envoyé avec succès');
                fetchContacts(); // Recharger les contacts après l'envoi réussi
            } else {
                console.error('Erreur lors de l\'envoi du message:', data.message);
            }
        })
        .catch(error => {
            console.error('Erreur lors de l\'envoi du message:', error);
        });
    }

    // Vérifier les nouveaux messages toutes les 5 secondes
    setInterval(fetchContacts, 5000);
});
