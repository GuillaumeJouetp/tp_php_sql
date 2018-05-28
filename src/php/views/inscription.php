<h2>Inscription au forum</h2>
<form action="index.php?cible=mainController&function=inscription" method="post" id="myForm">
    <label> <span> Votre prénom :</span>
        <input type="text" size="75" placeholder="Votre prénom" name="name" id="lastName" required>
        <span class="tooltip">Votre prénom doit contenir au moins 2 caractères</span>
    </label>
    <br>
    <label> <span> Votre nom :</span>
        <input type="text" size="75" placeholder="Votre nom" name="last_name" id="firstName" required>
        <span class="tooltip">Votre nom doit contenir au moins 2 caractères</span>
    </label>
    <br>
    <label>  <span> Votre e-mail : </span>
        <input type="email" size="75" placeholder="Votre email" name="mail" id="mail" required>
        <span class="tooltip">Votre email n'est pas valide</span>
    </label>
    <br>
    <label>
        <span> Votre mot de passe </span>
        <input type="password" size="75" placeholder="Votre mot de passe" name="pass" id="pwd1" required>
        <span class="tooltip">Le mot de passe doit contenir au moins 8 caractères, une majuscule et un chiffre</span>
    </label>
    <br>
    <label>
        <span> Confirmation du mot de passe </span>
        <input type="password" size="75" placeholder="Confirmation de mot de passe" name="passConf" id="pwd2" required>
        <span class="tooltip">Les mots de passe ne sont pas identiques</span>
    </label>
    <br>
    <button type="submit">Envoyer</button>
</form>

<!-- Script js permettant de faire du control dynamique coté client sur les formulaires (Attention ce n'est pas de la sécurité)-->
<script type="text/javascript" src="../js/formControl.js"></script>