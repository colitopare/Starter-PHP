<?php
/**
 * Created by PhpStorm.
 * User: Muriel
 * Date: 17/11/2017
 * Time: 10:23
 */


/* >> EXERCICE 2 <<
 *
 *  Supprimer l'utilisateur numéro 4 en envoyant une requête simple, tout écrit en dur en PHP & SQL, dans un fichier delete.php
 *  (si ça fonctionne, il suffit de l'exécuter une seule fois)... il peut être normal que rien ne s'affiche sur le fichier en cas de succès...
*/

// RECUPERER DES INFOS DE LA BASE
// je récupère dans ligne le jeu de résultats de ma requête
$retourRequete = $maconnexion->query("SELECT * FROM utilisateur WHERE identifiant_utilisateur = 15");

if ($retourRequete->fetch()){
// j'exécute le DELETE
    $maconnexion->query("DELETE FROM utilisateur WHERE identifiant_utilisateur = 15");
//    niveau 2 : afficher une confirmation en cas de succès (solution non présente dans les ressources)
    echo 'L utilisateur a bien été supprimé';

}else{
    echo 'L utilisateur n a pas pu être effacé car il n existait plus dans la base de données' ;

}