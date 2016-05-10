<?php

session_start(); /* le mettre avant le HTML, ne pas mettre d'espace avant */
include_once('data.php');
include_once ('class/class_annonce.php');
include_once('functions.php');
include_once('traitement.php');

if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case "homeAjax":
            include('view/home.php');
            ;
            break;

        case "contactAjax":
            include('view/contact.php');
            break;

        default:
    }
}
?>