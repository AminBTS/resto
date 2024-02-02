<form action="modele/bd.contact.inc.php" method="post">

    <!-- Nom et Prénom -->
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>
<br>
    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" required>
    <br>

    <!-- Mail -->
    <label for="mail">Mail :</label>
    <input type="email" id="mail" name="mail" required>
    <br>

    <!-- Objet avec liste déroulante -->
    <label for="objet">Objet :</label>
    <select id="objet" name="objet" onchange="afficherOptions()">
        <option value="Restaurant">Problème ou Suggestion concernant un Restaurant</option>
        <option value="Incident">Signalement d'Incident</option>
        <option value="Conseil">Conseil</option>
        <option value="Autre">Autre</option>
    </select>
    <br>

    <!-- Liste déroulante spécifique pour Restaurant -->
    <div id="restaurantOptions" style="display: none;">
        <label for="restaurantAction">Action pour le Restaurant :</label>
        <select id="restaurantAction" name="restaurantAction">
            <option value="Ajouter">Ajouter un restaurant</option>
            <option value="Signaler">Signaler un problème dans un restaurant</option>
        </select>
    </div>
    <br>

    <!-- Liste déroulante spécifique pour Incident -->
    <div id="incidentOptions" style="display: none;">
        <label for="incidentType">Type d'incident :</label>
        <select id="incidentType" name="incidentType">
            <option value="Problème de livraison">Problème de livraison</option>
            <option value="Mauvaise qualité">Mauvaise qualité des produits</option>
            <option value="Autre">Autre</option>
        </select>
    </div>
    <br>

    <!-- Textarea commun pour Conseil et Autre -->
    <label for="message">Message :</label>
    <textarea id="message" name="message" rows="4" required></textarea>
    <br>

    <!-- Bouton Valider -->
    <input type="submit" value="Valider">

</form>

<script>
    function afficherOptions() {
        var objet = document.getElementById("objet").value;
        var restaurantOptions = document.getElementById("restaurantOptions");
        var incidentOptions = document.getElementById("incidentOptions");

        if (objet === "Restaurant") {
            restaurantOptions.style.display = "block";
            incidentOptions.style.display = "none";
        } else if (objet === "Incident") {
            incidentOptions.style.display = "block";
            restaurantOptions.style.display = "none";
        } else {
            restaurantOptions.style.display = "none";
            incidentOptions.style.display = "none";
        }
    }
</script>

</body>
</html>
