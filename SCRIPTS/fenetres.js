// document.addEventListener('DOMContentLoaded', function() {
//     const icons = document.querySelectorAll('.icons');
//     const interfaces = document.querySelectorAll('.interface');
//     const defaultInterface = document.querySelector('#default-interface');

//     // Afficher l'interface par défaut au chargement de la page
//     defaultInterface.classList.remove('hidden');

//     icons.forEach(icon => {
//         icon.addEventListener('click', function() {
//             // Récupérer l'ID de l'interface cible depuis l'attribut data-target de l'icône
//             const targetId = icon.getAttribute('data-target');
//             const targetInterface = document.getElementById(targetId);

//             // Masquer l'interface par défaut si l'interface cible est différente de l'interface par défaut
//             if (targetInterface !== defaultInterface) {
//                 defaultInterface.classList.add('hidden');
//             }

//             // Masquer toutes les interfaces sauf l'interface cible
//             interfaces.forEach(interface => {
//                 if (interface !== targetInterface) {
//                     interface.classList.add('hidden');
//                 }
//             });

//             // Afficher l'interface correspondante au clic sur l'icône
//             targetInterface.classList.remove('hidden');
//         });
//     });
// });

// Fonction pour récupérer les informations de l'utilisateur depuis l'API PHP
function fetchUserInfo() {
    fetch('../API/information_utilisateur.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Si la réponse est un succès, afficher la photo de l'utilisateur
                const photoUrl = data.photo;
                const photoElement = document.getElementById('myProfileImageChat');
                photoElement.src = photoUrl;
                photoElement.style.display = 'block'; // Assurez-vous que l'élément est visible
            } else {
                // Gérer les erreurs ou les cas où l'utilisateur n'est pas connecté
                console.error(data.message); // Correction ici
            }
        })
        .catch(error => console.error('Erreur lors de la récupération des informations utilisateur :', error));
}

// Appeler la fonction pour récupérer les informations de l'utilisateur au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    fetchUserInfo();
});


