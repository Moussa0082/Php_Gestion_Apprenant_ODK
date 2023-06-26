
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


const  nom_p = document.getElementById('nom_p')
const annee_pro = document.getElementById('annee_pro')
const envoi = document.getElementById('enregistre_pro')

envoi.addEventListener('click', function (){

    if(nom_p.value=='' && annee_pro.value==''){
        envoi.addEventListener ('mouseover' , () =>   {
            alert("Les champs nom et année promotion ne doit pas etre vide ")
        })
    }
    else if(nom_p.value==''){
        envoi.addEventListener ('mouseover' , () =>   {
            alert("Le champ nom promotion ne doit pas etre vide ")
        })
    }
    else if(annee_pro.value==''){
        alert("Le champ anne promotion ne doit pas etre vide ")
    }

})


