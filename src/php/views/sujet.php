<div class = 'pageWrapper'>
    <div class="forum">
        <!-- Affichage du nombre de sujets (après filtre) que la page affiche -->
        <h2>Actualités | ISEP  (<?= count(recupereSubjects($bdd, 100,$where)) ?>)</h2>
        <?php displaySubjectsAndResponse($bdd,100,$where);?>
    </div>
    <aside class="filter">
        <h2>Filtrer :</h2>
        <form action="index.php" method="get" id="filter">
            <!-- Les deux prochains inputs me permetent de passer les variables d'appelle au controleur en get (on ne les met pas dans action car cela ne fonctionne pas avec un formulaire envoyé en get) -->
            <input type="hidden" name="cible" value="mainController" />
            <input type="hidden" name="function" value="bouttonActualite" />
            <label> Par auteur du sujet : <br>
                <select name="author">
                    <option value="" selected>Tous </option>
                    <?php displayAuthorsOptions($bdd) ?>
                </select>
            </label> <br>
            <label> Par catégorie : <br>
                <select name="category">
                    <option value="" selected>Toutes</option>
                    <?php displayCategoryOptions($bdd) ?>
                </select>
            </label> <br>
            <label> Articles postérieurs la date : <br>
                <input type="date" name="date">
            </label> <br>
            <button type="submit" >Filtrer</button>
        </form>
    </aside>
</div>

<!-- Utilisation d'ajax avec jQuery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="../js/ajaxFilter.js"></script>
