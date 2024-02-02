<!-- Affiche le nom du restaurant -->
<h1><?= $unResto['nomR']; ?>

    <!-- Condition : Affiche l'image "j'aime" ou "je n'aime pas" en fonction de la variable $aimer -->
    <?php if ($aimer != false) { ?>
        <a href="./?action=aimer&idR=<?= $unResto['idR']; ?>" ><img class="aimer" src="images/aime.png" alt="j'aime ce restaurant"></a>
    <?php } else { ?>
        <a href="./?action=aimer&idR=<?= $unResto['idR']; ?>" ><img class="aimer" src="images/aimepas.png" alt="je n'aime pas encore ce restaurant"></a>
    <?php } ?>

</h1>

<!-- Section pour afficher la note du restaurant -->
<span id="note">
    <?php for ($i = 1; $i <= 5; $i++) { ?>
        <!-- Boucle : Affiche une série d'images "like" ou "neutre" en fonction de la note moyenne -->
        <a class="aimer" href="./?action=noter&note=<?= $i ?>&idR=<?= $unResto['idR']; ?>" >
            <?php if ($i <= $noteMoy) { ?>
                <img class="note" src="images/like.png" alt="">
            <?php } else { ?>
                <img class="note" src="images/neutre.png" alt="line neutre">
            <?php } ?>
        </a>
    <?php } ?>
</span>

<!-- Section pour afficher les types de cuisine -->
<section>
    Cuisine <br />
    <ul id="tagFood">		
        <?php for ($j = 0; $j < count($lesTypesCuisine); $j++) { ?>
            <!-- Boucle : Affiche les types de cuisine sous forme de tags -->
            <li class="tag"><span class="tag">#</span><?= $lesTypesCuisine[$j]["libelleTC"] ?></li>
        <?php } ?>
    </ul>
</section>

<!-- Section principale avec la première photo et la description du restaurant -->
<p id="principal">
    <?php if (count($lesPhotos) > 0) { ?>
        <img src="photos/<?= $lesPhotos[0]["cheminP"] ?>" alt="photo du restaurant" />
    <?php } ?>
    <br />
    <?= $unResto['descR']; ?>
</p>

<!-- Section pour afficher l'adresse du restaurant -->
<h2 id="adresse">
    Adresse
</h2>
<p>
    <?= $unResto['numAdrR']; ?>
    <?= $unResto['voieAdrR']; ?><br />
    <?= $unResto['cpR']; ?>
    <?= $unResto['villeR']; ?>
</p>

<!-- Section pour afficher les photos du restaurant -->
<h2 id="photos">
    Photos
</h2>
<ul id="galerie">
    <?php for ($i = 0; $i < count($lesPhotos); $i++) { ?>
        <!-- Boucle : Affiche les photos du restaurant -->
        <li> <img class="galerie" src="photos/<?= $lesPhotos[$i]["cheminP"] ?>" alt="" /></li>
    <?php } ?>
</ul>

<!-- Section pour afficher les horaires du restaurant -->
<h2 id="horaires">
    Horaires
</h2> 
<?= $unResto['horairesR']; ?>

<!-- Section pour afficher les critiques -->
<h2 id="crit">Critiques</h2>
<?php if (isLoggedOn()){ ?>
    <!-- Formulaire pour ajouter une critique -->
    <form action="" method="post">
        <label for="commentaire">Commentaire:</label>
        <input type="text" id="commentaire" name="commentaire" required>
        <br>
        <label for="note">Note (1-5):</label>
        <input type="number" id="notes" name="note" min="1" max="5" required>
        <input type="hidden" name="idR" value="<?= $unResto['idR']; ?>">
        <br>
        <input type="submit" value="Ajouter Critique">
    </form>
<?php } else { 
    // Affiche un message si l'utilisateur n'est pas connecté
    echo "Vous devez vous connecter pour mettre un commentaire";
} ?>

<!-- Liste des critiques du restaurant -->
<ul id="critiques">
    <?php for ($i = 0; $i < count($critiques); $i++) { ?>
        <li>
            <span>
                <?= $critiques[$i]["mailU"] ?> 
                <!-- Affiche un lien pour supprimer la critique si l'utilisateur est le propriétaire -->
                <?php if ($critiques[$i]["mailU"] == $mailU) { ?>
                    <a href='./controleur/SupprimerCritique.php?idR=<?= $critiques[$i]["idR"]; ?>&mailU=<?= $critiques[$i]["mailU"]; ?>'>Supprimer</a>
                <?php } ?>
                    <!-- Affiche un lien pour modifier la critique si l'utilisateur est le propriétaire -->
                <?php if ($critiques[$i]["mailU"] == $mailU) { ?>
                    <a href='./controleur/modifierCritique.php?idR=<?= $critiques[$i]["idR"]; ?>&mailU=<?= $critiques[$i]["mailU"]; ?>'>Modifier</a>
                <?php } ?>
            </span>
            <div>
                <span>
                    <?php
                    // Affiche la note de la critique
                    if ($critiques[$i]["note"]) {
                        echo $critiques[$i]["note"] . "/5";
                    }
                    ?>
                </span>
                <span><?= $critiques[$i]["commentaire"] ?> </span>
            </div>
        </li>
    <?php } ?>
</ul>

