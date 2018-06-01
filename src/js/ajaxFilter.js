/* On sélectionne le formulaire par son identifiant et on execute la fonction a l'envoie du formulaire */
$(document).ready(function() {
    $("#filter").change(function (e) {
        /* On empêche le navigateur d'envoyer le formulaire dans le cas d'un event handler submit */
        e.preventDefault();
        /* On récupère les données du formulaire */
        var donnees = $(this).serialize();
        console.log(donnees);
        $.ajax({
            url: 'index.php',
            type: 'GET',
            data: donnees,
            dataType: 'html',

            success: function (data) {
                $("#testAjax").innerHTML = 'test';
            }

        });

    });
});

