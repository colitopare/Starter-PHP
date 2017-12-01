<?php
/**
 * Created by PhpStorm.
 * User: Muriel
 * Date: 17/11/2017
 * Time: 10:09
 */

include "header.php";
/* >> EXERCICE 1 <<
 *
 * afficher sur une page (que l'on appellera affichage.php) le prénom et le nom de l'utilisateur
 * dont l'identifiant (identifiant_utilisateur) est égal à 11.
 * Utiliser PHP et SQL
 *
 *  pré-requis :
 * 		a) réussir à se connecter à la base en php
 * */

// CONNEXION À LA BASE DE DONNÉES ET SELECTION D'UNE BASE DE DONNÉES
// ouvrir une connexion à notre bdd mysql ET se connecter à la base "demo" | connexion à l'aide de PDO
try {
    $maconnexion = new PDO('mysql:host=localhost;dbname=demo', 'root', 'root');
    $maconnexion->exec('SET NAMES utf8'); // pour éviter les problèmes d'encodage
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// RECUPERER DES INFOS DE LA BASE
// je récupère dans ligne le jeu de résultats de ma requête
$jeuderesultat = $maconnexion->query("SELECT nom, prenom FROM utilisateur WHERE identifiant_utilisateur = 11");

// je récupère dans tableau la ligne suivante d'un jeu de résultats
$lignesousformedetableau = $jeuderesultat->fetch();
echo $lignesousformedetableau[1] . ' ' . $lignesousformedetableau[0] . '<br />';


include 'delete.php';


/* >> EXERCICE 3 <<
 *
 * à l'aide du formulaire html de l'exercice précédent, et dans un fichier insertion.php,
 * insérer les données envoyées par le formulaire dans la base de données "demo", dans la table "utilisateur"
 *
 * niveau 1 : insérer uniquement les données présentes dans le formulaire initial
 */

?>
    <main class="container">
        <form class="form-horizontal" method="post" action="insertionPays.php">

            <p class="form-group">
                <label for="cp">Code Pays :</label>
                <input type="text" name="codePays" id="cp" required aria-required="true"/>
            </p>

            <p class="form-group">
                <label for="p">Pays :</label>
                <input type="text" name="pays" id="p" required aria-required="true"/>
            </p>

            <p><input type="submit" value="Envoyer"/></p>
        </form>

        <!--    Le formulaire nécessite également l'attribut suivant: enctype = "multipart/form-data".
        Il spécifie le type de contenu à utiliser lors de la soumission du formulaire
        "multipart/form-data", qui spécifie
        que le formulaire envoie des données binaires (fichier) et du texte (champs de formulaire) -->
        <form class="form-horizontal" method="post" action="insertion.php" enctype="multipart/form-data">
            <input type="hidden" value="stagiaire" id="type_utilisateur" name="type_utilisateur">
            <fieldset class="field">

                <legend>À propos de vous</legend>
                <div class="field">
                    Civilité:
                    <div class="control">
                        <label class="label" for="M.">
                        <input class="radio" type="radio" name="civilite" value="M." id="M.">
                            M.</label>
                        <label class="label" for="Mlle">
                        <input class="radio" type="radio" name="civilite" value="Mlle" id="Mlle">
                            Mlle</label>
                        <label class="label" for="Mme">
                        <input class="radio" type="radio" name="civilite" value="Mme" id="Mme">
                            Mme</label>
                    </div>
                </div>



                <p class="form-group">
                    <label class="col-xs-3 control-label" for="nom">Nom :</label>
                    <input type="text" name="nom" id="nom" title="Nom" required aria-required="true"/>
                </p>
                <p class="form-group">
                    <label for="prenom">Prénom :</label>
                    <input type="text" name="prenom" id="prenom" required aria-required="true"/>
                </p>
                <p class="form-group">
                    <label for="dateNaissance">Date de naissance : </label>
                    <input type="date" name="dateNaissance" id="dateNaissance">
                </p>
                <p><label for="photo">Photos :</label>
                    <input type="file" name="photoProfil" id="photo">

                </p>
                <p><label for="cv">Cv :</label>
                    <input type="texte" name="cv" id="cv" required>
                </p>
            </fieldset>
            <fieldset>
                <legend>Vos coordonnées</legend>
                <p><label for="adresse">Adresse :</label>
                    <input type="texte" name="adresse" id="adresse" required>
                </p>
                <p><label for="adresseComplement">Complément d'adresse :</label>
                    <input type="texte" name="adresseComplement" id="adresseComplement" required>
                </p>

                <?php
                // Je récupère en php le contenue de ma base de données table ville pour faire mon select
                // RECUPERER DES INFOS DE LA BASE
                // je récupère dans ligne le jeu de résultats de ma requête
                $resultatSelectVille = $maconnexion->query("SELECT * FROM ville ");
                ?>
                <p><label for="ville">Ville :</label>
                    <select id="ville" name="codeCommuneInseeVille">
                        <option value="#" selected>Sélectionner votre ville</option>
                        <?php
                        // je parcours mon tableau
                        while ($lignesVille = $resultatSelectVille->fetch()) {
                            ?>
                            <option value="<?php echo $lignesVille['code_commune_insee'] ?>">
                                <?php echo $lignesVille['code_postal'] . ' ' . $lignesVille['nom_ville'] ?>
                            </option>
                            <?php
                        }
                        ?>

                    </select>
                </p>
                <?php
                // Je récupère en php le contenue de ma base de données table pays pour faire mon select
                // RECUPERER DES INFOS DE LA BASE
                // je récupère dans ligne le jeu de résultats de ma requête
                $resultatSelectPays = $maconnexion->query("SELECT * FROM pays ");
                ?>
                <p><label for="pays">Pays :</label>
                    <select id="pays" name="codePays">
                        <option value="#" selected>Sélectionner votre pays</option>
                        <?php
                        // je parcours mon tableau
                        while ($lignesPays = $resultatSelectPays->fetch()) {
                            ?>
                            <option value="<?php echo $lignesPays['code_pays'] ?>">
                                <?php echo $lignesPays['nom_pays'] ?>
                            </option>
                            <?php
                        }
                        ?>

                    </select>
                </p>
                <p><label for="email">e-mail :</label>
                    <input type="email" name="email" id="email" required aria-required="true">
                </p>
                <p><label for="telephone">Téléphone :</label>
                    <input type="tel" name="telephone" id="telephone" required aria-required="true">
                </p>
                <p><label for="telMobile">Mobile :</label>
                    <input type="tel" name="telMobile" id="telMobile">
                </p>
            </fieldset>
            <fieldset>
                <legend>Vos identifiants</legend>
                <p><label for="mot_de_passe">Mot de passe :</label>
                    <input type="password" name="motDePasse" id="mot_de_passe" pattern=".{6,}" autocomplete="off"
                           required
                           aria-required="true">
                </p>
            </fieldset>

            <fieldset>
                <legend>Vos préférences</legend>
                <?php
                // Je récupère en php le contenue de ma base de données table pays pour faire mon select
                // RECUPERER DES INFOS DE LA BASE
                // je récupère dans ligne le jeu de résultats de ma requête
                $resultatSelectLangage = $maconnexion->query("SELECT * FROM langage ");
                ?>
                <p><label for="langage">Quel langage préférez-vous ? </label>
                    <select id="langage" name="idLangage">
                        <option value="#" selected>Sélectionner votre langue préférée</option>
                        <?php
                        // je parcours mon tableau
                        while ($lignesLangage = $resultatSelectLangage->fetch()) {
                            ?>
                            <option value="<?php echo $lignesLangage['id_langage'] ?>">
                                <?php echo $lignesLangage['nom_langage'] ?>
                            </option>
                            <?php
                        }
                        ?>

                    </select>
                </p>
            </fieldset>
            <fieldset>
                <legend>Votre niveau</legend>
                <?php
                // Je récupère en php le contenue de ma base de données table pays pour faire mon select
                // RECUPERER DES INFOS DE LA BASE
                // je récupère dans ligne le jeu de résultats de ma requête
                $resultatSelectNiveau = $maconnexion->query("SELECT * FROM niveau ");
                ?>
                <p><label for="niveau">Quel niveau avez-vous ? </label>
                    <select id="niveau" name="idNiveau">
                        <option value="#" selected>Sélectionner votre niveau</option>
                        <?php
                        // je parcours mon tableau
                        while ($lignesNiveau = $resultatSelectNiveau->fetch()) {
                            ?>
                            <option value="<?php echo $lignesNiveau['id_niveau'] ?>">
                                <?php echo $lignesNiveau['description_niveau'] ?>
                            </option>
                            <?php
                        }
                        ?>

                    </select>
                </p>
            </fieldset>
            <fieldset>
                <legend>Lettre d'information</legend>
                <p><input type="checkbox" name="newsletter" id="newsletter" value="1">
                    <label for="newsletter">Je souhaite m'inscrire à la lettre d'information</label>
                </p>
            </fieldset>
            <fieldset>
                <legend>Un peu plus sur vous...</legend>
                <p><label for="bio">Biographie</label><br/>
                    <textarea name="bio" id="bio" cols="60" rows="8" minlength="10" maxlength="50" required
                              aria-required="true"></textarea>
                </p>
                <p><label for="philosophie">Philosophie</label><br/>
                    <textarea name="philosophie" id="philosophie" cols="40" rows="4"
                              placeholder="Petite aide à l'utilisateur qui disparaît quand on écrit..."></textarea>
                </p>
            </fieldset>
            <fieldset>
                <legend>Par rapport à la formation</legend>
                <p><label for="motivation">Ma motivation (gauche = aucune ; droite = pleine) : </label><br/>
                    <input type="range" name="motivation" id="motivation" min="0" max="100" step="10" value="0">
                </p>
                <p><label for="dispo_date">Date de disponibilité : </label>
                    <input type="date" name="dispoDate" id="dispo_date">
                </p>
            </fieldset>
            <fieldset>
                <legend>Divers</legend>
                <label for="time">Votre heure préférée du repas : </label>
                <input type="time" name="heureRepas" id="time" min="11:00" max="14:00" step="900" value="12:30">
            </fieldset>
            <fieldset>
                <legend>Validation</legend>
                <p><input type="checkbox" name="acceptAdmission" id="accept_admission" value="1">
                    <label for="accept_admission">J'ai lu et j'accepte les conditions d'admission.</label>
                </p>
                <p><input type="submit" value="Envoyer"/></p>
            </fieldset>
        </form>

    </main>
<?php
// fermeture de la connexion et on libère les ressources | très important | uniquement sur des connexions non persistantes
$maconnexion = null;
