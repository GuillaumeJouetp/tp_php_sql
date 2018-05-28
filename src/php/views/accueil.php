<h1>ISEP</h1>

<section>
    <article>
        <h2>Ecole d'ingénieurs du numérique</h2>
        <p><em>Lorem ipsum dolor sit amet</em>, consectetur adipiscing elit.
            Cras id nisl feugiat mi porta gravida phasellus
            condimentum enim non elit tincidunt porttitor. Nulla a nibh non
            libero facilisis condimentum suspendisse
            tempus varius gravida. Donec lacinia lectus auctor orci euismod lobortis.
        </p>
        <ul>
            <li>Morbi congue at tellus</li>
            <li>Iaculis lorem sed, suscipit</li>
            <li>Vestibulum ante ipsum</li>
            <li>Morbi convallis</li>
        </ul>
        <p>In eget <strong>porta massa</strong>, sit amet cursus elit.</p>

    </article>
    <aside>
        <?php displayConnexion(); ?>
    </aside>
</section>

<section>
    <article>
        <h2>Actualités | ISEP</h2>
        <form action="index.php?cible=mainController&function=postSubject" method="post">
            <label> <span> Votre sujet : </span>
                <br>
                <textarea cols="50" rows="10" name="content">Votre sujet</textarea>
            </label>
            <br>
            <button type="submit">Envoyer</button>
            <br>
        </form>
    </article>
    <aside>
        <h2>Les 4 derniers sujets en cours</h2>
        <?php
        displaySubjects($bdd,4);
        ?>
    </aside>
</section>

