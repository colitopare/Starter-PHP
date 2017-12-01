<?php
/**
 * Created by PhpStorm.
 * User: Muriel
 * Date: 17/11/2017
 * Time: 16:40
 */
include 'header.php';
include 'fonctions.php';

if (empty($_POST)) {
    echo 'Il y a eu un problème lors de l envoie du formalaire';
} else {

// CONNEXION À LA BASE DE DONNÉES ET SELECTION D'UNE BASE DE DONNÉES
// ouvrir une connexion à notre bdd mysql ET se connecter à la base "demo" | connexion à l'aide de PDO
    try {
        $maconnexion = new PDO('mysql:host=localhost;dbname=demo', 'root', 'root');
        $maconnexion->exec('SET NAMES utf8'); // pour éviter les problèmes d'encodage
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    };

///////////////////////////////////////////////////
// Ajout d utilisateur dans la base de donnée
//////////////////////////////////////////////////
///
///
///Upload des fichiers avant de continuer
///

    $uploadPhotoProfil = upload('avatar', 'images/avatar', 15360, array('png', 'gif', 'jpg', 'jpeg'));

//    if ($uploadPhotoProfil) {

        // EXE UNE REQUETE
// Exécuter une requête dans la base à laquelle on est connectée
// (exec s'utilise exclusivement avec des requêtes qui ne retournent pas de résultats : insert, delete, update)
        $requete = "INSERT  INTO utilisateur(
              civilite,
              nom,
              prenom,
              date_naissance,
              adresse,
              adresse_complement,
              mot_de_passe,
              email,
              tel,
              mobile,
              photo_profil,
              cv,
              abonnement_newsletter,
              pref_accept_conditions,
              pref_heure_repas,
              date_dispo,
              motivation,
              biographie,
              philosophie,
              code_commune_insee_ville,
              id_langage_langage,
              id_niveau_niveau
          )VALUES(
              :civilite,
              :nom,
              :prenom,
              :date_naissance,
              :adresse,
              :adresse_complement,
              :mot_de_passe,
              :email,
              :tel,
              :mobile,
              :photo_profil,
              :cv,
              :abonnement_newsletter,
              :pref_accept_conditions,
              :pref_heure_repas,
              :date_dispo,
              :motivation,
              :biographie,
              :philosophie,
              :code_commune_insee_ville,
              :id_langage_langage,
              :id_niveau_niveau 
          )";


        $req = $maconnexion->prepare($requete);
        $req->execute(array(
            'civilite' => $_POST['civilite'],
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'date_naissance' => $_POST['dateNaissance'],
            'adresse' => $_POST['adresse'],
            'adresse_complement' => $_POST['adresseComplement'],
            'mot_de_passe' => $_POST['motDePasse'],
            'email' => $_POST['email'],
            'tel' => $_POST['telephone'],
            'mobile' => $_POST['telMobile'],
            'photo_profil' => $_POST['photoProfil'],
            'cv' => $_POST['cv'],
            'abonnement_newsletter' => $_POST['newsletter'],
            'pref_accept_conditions' => $_POST['acceptAdmission'],
            'pref_heure_repas' => $_POST['heureRepas'],
            'date_dispo' => $_POST['dispoDate'],
            'motivation' => $_POST['motivation'],
            'biographie' => $_POST['bio'],
            'philosophie' => $_POST['philosophie'],
            'code_commune_insee_ville' => $_POST['codeCommuneInseeVille'],
            'id_langage_langage' => $_POST['idLangage'],
            'id_niveau_niveau' => $_POST['idNiveau']
        ));

/////////////////////////////////////////////////
/// AFFICHAGE DES SAISIE DU FORMULAIRE ENVOYER
/// ////////////////////////////////////////////
        ?>
        <div class="columns is-centered">
            <div class="section">
                <div class="column box">
                    <div class="card-header-title">
                        <h3 class="button is-primary">A propos de vous</h3>
                    </div>
                    <div class="card-content">
                        <p><?php echo $_POST['civilite']; ?></p>
                        <p><?php echo strtoupper($_POST['nom']); ?></p>
                        <p><?php echo ucfirst($_POST['prenom']); ?></p>
                        <!--                    <p>--><?php //echo $_POST['age']; ?><!--</p>-->
                        <p><?php echo convertDate($_POST['dateNaissance']); ?></p>
                    </div>
                </div>
            </div>
            <div class="section">
                <div class="column box">
                    <div class="card-header-title">
                        <h3 class="button is-primary">Vos coordonnées</h3>
                    </div>
                    <div class="card-content">
                        <p><a href="mailto:"><?php echo filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ?></a></p>
                        <p><a href="tel:"> <?php echo convertTelInternationnal($_POST['telephone']) ?></a></p>
                        <p><a href="tel:"> <?php echo convertTelInternationnal($_POST['telMobile']) ?></a></p>
                    </div>
                </div>
            </div>
            <div class="section">
                <div class="column box">
                    <div class="card-header-title">
                        <h3 class="button is-primary">Vos identifiants</h3>
                    </div>
                    <div class="card-content">
                        <!--                    <p>--><?php //echo $_POST['identifiant'] ?><!--</p>-->
                        <?php if ($uploadPhotoProfil) "Upload de l'icone réussi!<br />"; ?>
                        <p><?php echo convertTelInternationnal($_POST['telephone']) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="columns is-centered">
            <div class="section">
                <div class="column box">
                    <div class="card-header-title">
                        <h3 class="button is-primary">Vos préférences</h3>
                    </div>
                    <div class="card-content">
                        <?php
                        // Je récupère en php le contenue de ma base de données table pays pour faire mon select
                        // RECUPERER DES INFOS DE LA BASE
                        // je récupère dans ligne le jeu de résultats de ma requête
                        $resultatSelectLangage = $maconnexion->query('SELECT nom_langage FROM langage WHERE id_langage = "' . $_POST['idLangage'] . '"');
                        $ligneLangage = $resultatSelectLangage->fetch();
                        ?>
                        <p><?php echo $ligneLangage['nom_langage'] ?></p>
                    </div>
                </div>
            </div>
            <div class="section">
                <div class="column box">
                    <div class="card-header-title">
                        <h3 class="button is-primary">Votre niveau</h3>
                    </div>
                    <div class="card-content">
                        <?php
                        // Je récupère en php le contenue de ma base de données table pays pour faire mon select
                        // RECUPERER DES INFOS DE LA BASE
                        // je récupère dans ligne le jeu de résultats de ma requête
                        $resultatSelectNiveau = $maconnexion->query('SELECT description_niveau FROM niveau WHERE id_niveau = "' . $_POST['idNiveau'] . '"');
                        $ligneNiveau = $resultatSelectNiveau->fetch();
                        ?>
                        <p><?php echo $ligneNiveau['description_niveau'] ?></p>
                    </div>
                </div>
            </div>

            <?php if (isset($_POST['newsletter'])) {
                $message = 'Merci de vous être abonné à notre newsletter';
                mail($_POST['newsletter'], 'Newsletter', $message);
                ?>
                <div class="section">
                    <div class="column box">
                        <div class="card-header-title">
                            <h3 class="button is-primary">Lettre d'information</h3>
                        </div>
                        <div class="card-content">
                            <p><?php echo $_POST['newsletter'] ?></p>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="section">
                    <div class="column box">
                        <div class="card-header-title">
                            <h3 class="button is-primary">Lettre d'information</h3>
                        </div>
                        <div class="card-content">
                            <p> NON </p>
                        </div>
                    </div>
                </div>
                <?php
            } ?>

        </div>

        <div class="columns is-centered">
            <div class="section">
                <div class="column box">
                    <div class="card-header-title">
                        <h3 class="button is-primary">Un peu plus sur vous ...</h3>
                    </div>
                    <div class="card-content">
                        <p><?php echo $_POST['bio'] ?></p>
                        <p><?php echo $_POST['philosophie'] ?></p>
                    </div>
                </div>
            </div>
            <div class="section">
                <div class="column box">
                    <div class="card-header-title">
                        <h3 class="button is-primary">Par rapport à la formation</h3>
                    </div>
                    <div class="card-content">
                        <p><?php echo $_POST['motivation']; ?></p>
                        <p><?php echo convertDate($_POST['dispoDate']); ?></p>
                    </div>
                </div>
            </div>
            <div class="section">
                <div class="column box">
                    <div class="card-header-title">
                        <h3 class="button is-primary">Divers</h3>
                    </div>
                    <div class="card-content">
                        <p><?php echo $_POST['heureRepas'] ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php
////////////////////////////////////////////////////////
// Vérifie si le fichier a été téléchargé sans erreurs
////////////////////////////////////////////////////////
//
//    if (isset ($_FILES['photoProfil']) && $_FILES['photoProfil']["erreur"] == 0) {
//        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
//        // Cette valeur tableau spécifie le nom d'origine du fichier, y compris l'extension du fichier. Il n'inclut pas le chemin du fichier.
//        $filename = $_FILES['photoProfil']["nom"];
//        // Cette valeur de tableau spécifie le type MIME du fichier.
//        $filetype = $_FILES['photoProfil']["type"];
//        // Cette valeur de tableau spécifie la taille du fichier, en octets.
//        $filesize = $_FILES['photoProfil']["size"];
//
//        // Vérifier l'extension de fichier
//        $ext = pathinfo($filename, PATHINFO_EXTENSION);
//        if (!array_key_exists($ext, $allowed)) die ("Erreur: Veuillez sélectionner un format de fichier valide.");
//
//        // Vérifier la taille du fichier - 5 Mo maximum
//        $maxsize = 5 * 1024 * 1024;
//        if ($filesize > $maxsize) die ("Erreur: la taille du fichier est supérieure à la limite autorisée.");
//
//        // Vérifier le type MYME du fichier
//        if (in_array($filetype, $autorise)) {
//            // Vérifie si le fichier existe avant de le télécharger
//            if (file_exists("images/" . $_FILES['photoProfil']["nom"])) {
//                echo $_FILES['photoProfil']["nom"] . " est déjà existant.";
//            } else {
//                move_uploaded_file($_FILES['photoProfil']["tmp_name"], "images/" . $_FILES['photoProfil']["nom"]);
//                echo "Votre fichier a été importé avec succès.";
//            }
//        } else {
//            echo "Erreur: Un problème est survenu lors du chargement de votre fichier. Veuillez réessayer.";
//        }
//    } else {
//        echo "Erreur:" . $_FILES['photoProfil']["erreur"];
//    }


//    } else {
//        ?>
<!--        <form action="affichage.php">-->
<!--            <p>Il y a eu un problème dans le téléchargement de votre fichier</p>-->
<!--            <p><input type="submit" value="Retour"/></p>-->
<!--        </form>-->
<!--        --><?php
//    }

// fermeture de la connexion et on libère les ressources | très important | uniquement sur des connexions non persistantes
    $maconnexion = null;

}
