<?php
/**
 * Created by PhpStorm.
 * User: Muriel
 * Date: 01/12/2017
 * Time: 09:19
 */

// CONNEXION À LA BASE DE DONNÉES ET SELECTION D'UNE BASE DE DONNÉES
$host = 'localhost';
$nameBdd = 'demo';
$userName = 'root';
$passWord = 'root';

try {
    $bdd= new PDO('mysql:host=' . $host . ';dbname='.  $nameBdd , $userName, $passWord);
    $bdd->exec('SET NAMES utf8'); // pour éviter les problèmes d'encodage
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
};