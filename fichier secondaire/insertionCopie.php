<?php
/**
 * Created by PhpStorm.
 * User: Muriel
 * Date: 17/11/2017
 * Time: 11:21
 */
$maconnexion = new PDO('mysql:host=localhost;dbname=demo', 'root', 'root');



//var_dump($_POST);
//die();



// EXE UNE REQUETE
// Exécuter une requête dans la base à laquelle on est connectée
// (exec s'utilise exclusivement avec des requêtes qui ne retournent pas de résultats : insert, delete, update)
$requete = "INSERT  INTO utilisateur
            VALUES(
                  :civilite/*,
                  :nom
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
                  :id_niveau_niveau*/
              )";

$civilite = 'Mme';
$adresse = 'aaaaaaaaaa';
$adresse_complement = 'bbbbbbbbbb';
$telMobile = '1234567';
$photoProfil = '/photo/ddddd.jpg';
$cv = 'ddddd';
$codeInsee = '788';
$idLangage = '1';
$idNiveau = '8';
$newsLetter = '1';
$cond = '1';
$heure = "12:00:00";

/*
var_dump(array('civilite' => $civilite,
    'nom' => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'date_naissance' => $_POST['dateNaissance'],
    'adresse' => $adresse,
    'adresse_complement' => $adresse_complement,
    'mot_de_passe' => $_POST['mot_de_passe'],
    'email' => $_POST['email'],
    'tel' => $_POST['telephone'],
    'mobile' => $telMobile,
    'photo_profil' => $photoProfil,
    'cv' => $cv,
    'abonnement_newsletter' => $newsLetter,
    'pref_accept_conditions' => $cond,
    'pref_heure_repa' => $heure,
    'date_dispo' => $_POST['dispo_date'],
    'motivation' => $_POST['motivation'],
    'biographie' => $_POST['bio'],
    'philosophie' => $_POST['philosophie'],
    'code_commune_insee_ville' => $codeInsee,
    'id_langage_langage' => $idLangage,
    'id_niveau_niveau' => $idNiveau));

echo 'civilite ', 'nom ', 'prenom ', 'date_naissance ', 'adresse ', 'adresse_complement ', 'mot_de_passe ', 'email ', 'tel ', 'mobile ', 'photo_profil ', 'cv ', 'pref_heure_repas ', 'date_dispo ', 'biographie ', 'philosophie ', 'code_commune_insee_ville ', 'id_langage_langage ', 'id_niveau_niveau ' . '<br/>';
echo 'Mme ', 'ddddd ', 'ddddd ', '2017-01-01 ', 'dddd' , 'ddddd ', 'ddddd ', 'ddddd ', 'ddddd ', 'ddddd ', 'ddddd ', 'ddddd ', '12:01:00 ', '2017-01-01 ', 'eeeeeee ', 'eeeeeeeee ', '788 ', '1 ', '7 ';
*/
//die();



$req = $maconnexion->prepare($requete);
$req->execute(array(
    'civilite'  => $civilite/*,
    'nom'       => $_POST['nom']
    'prenom'    => $_POST['prenom'],
    'date_naissance' => $_POST['dateNaissance'],
    'adresse'   => $adresse,
    'adresse_complement' => $adresse_complement,
    'mot_de_passe' => $_POST['mot_de_passe'],
    'email'     => $_POST['email'],
    'tel'       => $_POST['telephone'],
    'mobile'    => $telMobile,
    'photo_profile' => $photoProfile,
    'cv'        => $cv,
    'abonnement_newsletter' => $newsLetter,
    'pref_accept_conditions' => $cond,
    'pref_heure_repa' => $heure,
    'date_dispo' => $_POST['dispo_date'],
   'motivation' => $_POST['motivation'],
    'biographie' => $_POST['bio'],
    'philosophie' => $_POST['philosophie'],
    'code_commune_insee_ville' => $codeInsee,
    'id_langage_langage' => $idLangage,
    'id_niveau_niveau' => $idNiveau*/
));

/*

// EXE UNE REQUETE
// Exécuter une requête dans la base à laquelle on est connectée
// (exec s'utilise exclusivement avec des requêtes qui ne retournent pas de résultats : insert, delete, update)
$maconnexion->exec("INSERT INTO `utilisateur`( `civilite`, 'nom', `prenom`, `date_naissance`, `adresse`, `adresse_complement`, `mot_de_passe`, `email`, `tel`, `mobile`, `photo_profil`, `cv`, `abonnement_newsletter`, `pref_accept_conditions`, `pref_heure_repas`, `date_dispo`, `motivation`, `biographie`, `philosophie`, `code_commune_insee_ville`, `id_langage_langage`, `id_niveau_niveau`) VALUES ( 'Mme', $_POST['nom'] , 'ddddd', '2017-01-01', 'dddd', 'ddddd', 'ddddd', 'ddddd', 'ddddd', 'ddddd', 'ddddd', 'ddddd', '0', '0', '12:01:00', '2017-01-01','30', 'eeeeeee', 'eeeeeeeee',  '788', '1', '7')
");
*/


// fermeture de la connexion et on libère les ressources | très important | uniquement sur des connexions non persistantes
$maconnexion = null;
