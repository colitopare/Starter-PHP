<?php
/**
 * Created by PhpStorm.
 * User: Muriel
 * Date: 17/11/2017
 * Time: 14:35
 */

$maconnexion = new PDO('mysql:host=localhost;dbname=demo', 'root', 'root');

// EXE UNE REQUETE
// Exécuter une requête dans la base à laquelle on est connectée
// (exec s'utilise exclusivement avec des requêtes qui ne retournent pas de résultats : insert, delete, update)

$requete = "INSERT  INTO pays
          VALUES(
              :code_pays,
              :nom_pays
          )";

$req = $maconnexion->prepare($requete);
$req->execute(array(
    'code_pays' => $_POST['codePays'],
    'nom_pays' => $_POST['pays']));

// fermeture de la connexion et on libère les ressources | très important | uniquement sur des connexions non persistantes
$maconnexion = null;

/*
 * INSERT INTO `utilisateur`( `civilite`, `nom`, `prenom`, `date_naissance`, `adresse`, `adresse_complement`, `mot_de_passe`, `email`, `tel`, `mobile`, `photo_profil`, `cv`, `abonnement_newsletter`, `pref_accept_conditions`, `pref_heure_repas`, `date_dispo`, `motivation`, `biographie`, `philosophie`, `code_commune_insee_ville`, `id_langage_langage`, `id_niveau_niveau`) VALUES ( 'Mme', 'ddddd', 'ddddd', '2017-01-01', 'dddd', 'ddddd', 'ddddd', 'ddddd', 'ddddd', 'ddddd', 'ddddd', 'ddddd', '0', '0', '12:01:00', '2017-01-01','30', 'eeeeeee', 'eeeeeeeee',  '788', '1', '7')
 */