document.addEventListener('DOMContentLoaded', function() {
    fetch('../API/information_utilisateur.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur HTTP ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'success') {
                const userData = data.user; // Accéder à l'objet user dans les données retournées
                const photoUrl = userData.photo;
                
                // Mettre à jour l'image de profil dans la barre latérale et autres éléments
                const profileImageElements = document.querySelectorAll('#myProfileImage, #myProfileImageContacts, #myProfileImageInput, #myProfileImageNewMessage, #myProfileImageChat');
                profileImageElements.forEach(element => {
                    element.src = photoUrl;
                });

                // Mettre à jour l'image de profil dans le chat
                const chatProfileImage = document.getElementById('myProfileImageChat');
                // chatProfileImage.src = photoUrl;
                chatProfileImage.style.display = 'block';

                // Mettre à jour d'autres informations d'utilisateur si nécessaire
                document.getElementById('username').value = userData.nom_utilisateur;
                document.getElementById('phoneNumber').value = userData.numero_telephone;
                document.getElementById('infos').value = userData.about;
                document.getElementById('sessionName').value = userData.nom_utilisateur;
                const myVariable = userData.numero_telephone;
                localStorage.setItem('myVariable', myVariable);

            } else {
                console.error('Erreur côté serveur :', data.message); // Gérer les erreurs
            }
        })
        .catch(error => console.error('Erreur lors de la récupération des informations utilisateur :', error));
});
