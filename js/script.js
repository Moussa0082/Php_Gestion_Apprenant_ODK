
const afficherFormButton = document.getElementById('afficher-form');
const apprenantForm = document.getElementById('apprenant-form');

afficherFormButton.addEventListener('click', function() {
    // Afficher le formulaire
    apprenantForm.style.display = 'block';
});

// Cacher le formulaire après l'envoi des données
const form = document.getElementById('apprenant-form');

form.addEventListener('submit', function() {
    // Cacher le formulaire
    apprenantForm.style.display = 'none';
});



