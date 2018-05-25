<h2>Inscription au forum</h2>
<form action="index.php?cible=mainController&function=inscription" method="post">
    <label> <span> Votre prénom :</span>
        <input type="text" size="75" placeholder="Votre nom" name="name" required>
    </label>
    <br>
    <label> <span> Votre nom :</span>
        <input type="text" size="75" placeholder="Votre prénom" name="last_name" required>
    </label>
    <br>
    <label>  <span> Votre e-mail : </span>
        <input type="email" size="75" placeholder="Votre email" name="mail" required>
    </label>
    <br>
    <label>
        <span> Votre mot de passe </span>
        <input type="password" size="75" placeholder="Votre mot de passe" name="pass" required>
    </label>
    <br>
    <label>
        <span> Confirmation du mot de passe </span>
        <input type="password" size="75" placeholder="Confirmation de mot de passe" name="passConf" required>
    </label>
    <br>
    <button type="submit">Envoyer</button>
</form>