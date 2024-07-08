document.getElementById('connexionForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const numero = formData.get('numero');
    const motDePasse = formData.get('mot_de_passe');

    const messageElement = document.getElementById('message');
    messageElement.className = '';  // Reset class

    // Soumettre le formulaire
    fetch('../API/connexion.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        messageElement.innerText = data.message;
        messageElement.classList.add(data.success ? 'success' : 'error');

        if (data.success) {
            setTimeout(() => {
                window.location.href = '../INTERFACES/chat.php';  // Rediriger vers la page de tableau de bord après connexion réussie
            }, 2000);
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        messageElement.innerText = 'Une erreur s\'est produite.';
        messageElement.classList.add('error');
    });
});
