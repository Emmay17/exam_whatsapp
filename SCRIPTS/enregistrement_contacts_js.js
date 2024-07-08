// Sélection des éléments du formulaire et des messages d'erreur
const form = document.querySelector('#addContactForm');
const phoneNumberInput = document.querySelector('#phoneNumber');
const contactNameInput = document.querySelector('#contactName');
const ownerPhoneNumberInput = document.querySelector('#ownerPhoneNumber');
const errorMessage = document.querySelector('#errorMessage');

// Fonction pour envoyer les données du formulaire à l'API
const addContact = async () => {
    // Données du formulaire
    const formData = new FormData(form);
    
    try {
        // Appel à l'API avec Fetch
        const response = await fetch('../API/enregistrement_contacts.php', {
            method: 'POST',
            body: formData
        });

        // Vérification du statut de la réponse
        if (!response.ok) {
            throw new Error('Réponse du serveur non valide');
        }

        // Conversion de la réponse en JSON
        const data = await response.json();

        // Vérification du statut de la réponse JSON
        if (data.status === 'success') {
            // Affichage d'un message de succès si tout s'est bien passé
            alert(data.message); // Vous pouvez remplacer alert par une autre méthode d'affichage
        } else {
            // Affichage du message d'erreur reçu de l'API
            errorMessage.textContent = data.message;
            errorMessage.style.display = 'block';
        }
    } catch (error) {
        // Gestion des erreurs de connexion ou autres
        console.error('Erreur lors de la requête :', error);
        errorMessage.textContent = 'Une erreur est survenue, veuillez réessayer.';
        errorMessage.style.display = 'block';
    }
};

// Écouter l'événement de soumission du formulaire
form.addEventListener('submit', (event) => {
    event.preventDefault(); // Empêcher le comportement par défaut du formulaire
    errorMessage.style.display = 'none'; // Cacher le message d'erreur précédent
    addContact(); // Appeler la fonction pour ajouter le contact
});
