/*
* Ce script est appelé ciblant un formulaire html et permet d'appliquer des vérification intéractives sur celui-ci
* Sources du script avant modification personnelles :
* https://openclassrooms.com/courses/dynamisez-vos-sites-web-avec-javascript/tp-un-formulaire-interactif-1
*/

/*
* Fonction de désactivation de l'affichage des "tooltips"
* Les tooltips de la page html du formulaire s'activent lorsque l'erreur est détectée
*/

function deactivateTooltips() {

    var tooltips = document.querySelectorAll('.tooltip'),
        tooltipsLength = tooltips.length;

    for (var i = 0; i < tooltipsLength; i++) {
        tooltips[i].style.display = 'none';
    }

}


/* La fonction ci-dessous permet de récupérer la "tooltip" qui correspond à notre input */

function getTooltip(elements) {

    while (elements = elements.nextSibling) {
        if (elements.className === 'tooltip') {
            return elements;
        }
    }

    return false;

}


// Fonctions de vérification du formulaire, elles renvoient "true" si tout est ok

var check = {}; // On met toutes nos fonctions dans un objet littéral



check['lastName'] = function(id) {

    var name = document.getElementById(id),
        tooltipStyle = getTooltip(name).style;

    if (name.value.length >= 2) {
        name.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    } else {
        name.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }

};

/* La fonction pour le prénom est la même que celle du nom */
check['firstName'] = check['lastName'];

check['mail'] = function() {
    const mailRegex = new RegExp( /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
    var mail = document.getElementById('mail'),
        tooltipStyle = getTooltip(mail).style;

    if (mailRegex.test(mail.value)) {
        mail.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    } else {
        mail.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }

};

check['pwd1'] = function() {
    const passRegex = new RegExp(/(?=.*[0-9])[A-Z]|(?=.*[A-Z])[0-9]/);
    var pwd1 = document.getElementById('pwd1'),
        tooltipStyle = getTooltip(pwd1).style;

    if (passRegex.test(pwd1.value)) {
        pwd1.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    } else {
        pwd1.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }

};

check['pwd2'] = function() {

    var pwd1 = document.getElementById('pwd1'),
        pwd2 = document.getElementById('pwd2'),
        tooltipStyle = getTooltip(pwd2).style;

    if (pwd1.value == pwd2.value && pwd2.value != '') {
        pwd2.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    } else {
        pwd2.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }

};


/* Mise en place des événements */

/* Utilisation d'une IIFE pour éviter les variables globales. */
(function() {

    var myForm = document.getElementById('myForm'),
        inputs = document.querySelectorAll('input[type=text], input[type=password],input[type=email]'),
        inputsLength = inputs.length;

    for (var i = 0; i < inputsLength; i++) {
        inputs[i].addEventListener('keyup', function(e) {
            check[e.target.id](e.target.id); // "e.target" représente l'input actuellement modifié
        });
    }

    myForm.addEventListener('submit', function(e) {

        var result = true;

        for (var i in check) {
            result = check[i](i) && result;
        }

        if (result) {
            e.submit();
        }
        else{
            alert("Le formulaire envoyé n'est pas correct !")
        }

        e.preventDefault();

    });

})();


/* Maintenant que tout est initialisé, on peut désactiver les "tooltips" */

deactivateTooltips();