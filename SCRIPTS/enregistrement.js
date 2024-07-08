document.getElementById('enregistrementForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const numero = formData.get('numero');
    const motDePasse = formData.get('mot_de_passe');
    const confirmMotDePasse = formData.get('confirm_mot_de_passe');

    const messageElement = document.getElementById('message');
    messageElement.className = '';  // Reset class

    // Vérifier si les mots de passe correspondent
    if (motDePasse !== confirmMotDePasse) {
        messageElement.innerText = 'Les mots de passe ne correspondent pas.';
        messageElement.classList.add('error');
        return;
    }

    // Vérifier si le numéro existe déjà
    fetch(`../API/verifier_numero.php?numero=${numero}`)
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                messageElement.innerText = 'Ce numéro existe déjà.';
                messageElement.classList.add('error');
            } else {
                // Si le numéro n'existe pas, soumettre le formulaire
                fetch('../API/enregistrement.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    messageElement.innerText = data;
                    messageElement.classList.add(data.includes('Enregistrement réussi') ? 'success' : 'error');

                    if (data.includes('Enregistrement réussi')) {
                        form.reset(); // Réinitialiser le formulaire
                        document.getElementById('imagePreview').style.backgroundImage = 'url(placeholder.jpg)'; // Réinitialiser l'image de prévisualisation

                        // Faire disparaître le message de succès après 2 secondes
                        setTimeout(() => {
                            messageElement.innerText = '';
                            messageElement.className = '';
                        }, 2000);
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    messageElement.innerText = 'Une erreur s\'est produite.';
                    messageElement.classList.add('error');
                });
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            messageElement.innerText = 'Une erreur s\'est produite lors de la vérification du numéro.';
            messageElement.classList.add('error');
        });
});

function previewImage(event) {
    const preview = document.getElementById('imagePreview');
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onloadend = function() {
        preview.style.backgroundImage = `url(${reader.result})`;
    }

    if (file) {
        reader.readAsDataURL(file);
    }
}
