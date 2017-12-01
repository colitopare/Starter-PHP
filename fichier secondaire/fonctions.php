<?php
/**
 * Created by PhpStorm.
 * User: Muriel
 * Date: 19/11/2017
 * Time: 08:41
 */


// Permet de convertir un string (date) du formaulaire en format français
// @param $date string
function convertDate($date)
{
    return date('d/m/Y', strtotime($date));
}

// converti le numéro de téléphone en +336......
// @param $tel int
function convertTelInternationnal($tel)
{
    return "+33" . substr($tel, 1);
}

//function recupererLigne($champ, $table, $idChamp, $postRecup)
//{
//    // CONNEXION À LA BASE DE DONNÉES ET SELECTION D'UNE BASE DE DONNÉES
//    // ouvrir une connexion à notre bdd mysql ET se connecter à la base "demo" | connexion à l'aide de PDO
//    try {
//        $connexionBis = new PDO('mysql:host=localhost;dbname=demo', 'root', 'root');
//        $connexionBis->exec('SET NAMES utf8'); // pour éviter les problèmes d'encodage
//    } catch (Exception $e) {
//        die('Erreur : ' . $e->getMessage());
//    };
//
//    // Je récupère en php le contenue de ma base de données table pays pour faire mon select
//    // RECUPERER DES INFOS DE LA BASE
//    // je récupère dans ligne le jeu de résultats de ma requête
//    $resultatSelect = $connexionBis->query('SELECT "' . $champ . '" FROM "' . $table . '" WHERE "' . $idChamp . '" = "' . $_POST[$postRecup] . '"');
//var_dump($resultatSelect);
//    $ligneRecup = $resultatSelect->fetch();
//    return $ligneRecup[$champ];
//
//}


/////////////////////////////////////////////
/// upload Permet de télécharger des fichiers à partir d'un formulaire
/// //////////////////////////////////////////////

function upload($index ,$destination ,$maxsize=FALSE ,$extensions=FALSE){
    //Test1: fichier correctement uploadé
    if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return FALSE;
    //Test2: taille limite
    if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return FALSE;
    //Test3: extension
    $ext = substr(strrchr($_FILES[$index]['name'],'.'),1);
    if ($extensions !== FALSE AND !in_array($ext,$extensions)) return FALSE;
    //Déplacement
    return move_uploaded_file($_FILES[$index]['tmp_name'],$destination);
}