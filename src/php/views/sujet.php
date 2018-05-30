<div class = 'pageWrapper'>
    <div class="forum">
        <h2>Actualités | ISEP</h2>
        <?php displaySubjectsAndResponse($bdd,100);?>
    </div>
    <aside class="filter">
        <h2>Filtrer :</h2>
        <form action="index.php?cibel=mainController&function=filter">
            <label> Par auteur du sujet : <br>
                <select name="filteAauthor">
                    <option value="test1" selected>Tous (<?= getNumSubjects($bdd)[0] ?>)</option>
                    <option value="test2">test2</option>
                    <option value="test3">test3</option>
                </select>
            </label> <br>
            <label> Par catégorie : <br>
                <select name="filterCategory">
                    <option value="test1" selected>Toutes</option>
                    <option value="test2">test2</option>
                    <option value="test3">test3</option>
                </select>
            </label> <br>
            <label> Articles postérieurs la date : <br>
                <input type="date">
            </label> <br>
            <button type="submit">Filtrer</button>
        </form>
    </aside>
</div>
