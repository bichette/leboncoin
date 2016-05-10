<?php
include_once('class/class_annonce.php');
include_once('class/class_annonces_manager.php');
include_once('class/class_user.php');
include_once('class/class_users_manager.php');
include_once('class/class_annonces_manager_pdo.php');
include_once('class/class_users_manager_pdo.php');

/* le mettre avant le HTML, ne pas mettre d'espace avant */
session_start(); //démarre une session

include_once('functions.php');

//connectDB();
$oPDO = connectDB_PDO();
/* print_r($oPDO);
  die(); */
$oAnnManager = new Annonces_Manager($oPDO);
$oUsersManager = new Users_Manager($oPDO);

//include_once('data.php');
include_once('traitement.php');

//on enregistre la connexion de l'utilisateur
logIp();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Le Bon Coin</title>
        <meta charset="UTF-8">
        <script src="jquery-2.2.3.js"></script>
        <link rel="stylesheet" type="text/css" href="leboncoin.css"/>
        <!-- Feuille de style pour Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
        <script type="text/javascript">
            $(document).ready(function () {
                $('#homeAjax').click(function () {
                    xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                $('#vue').html(xhr.responseText);
                            }
                        }
                    }

                    xhr.open('GET', 'ajax.php?page=homeAjax');
                    xhr.send();
                });

                $('#contactAjax').click(function () {
                    xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                $('#vue').html(xhr.responseText);
                            }
                        }
                    }

                    xhr.open('GET', 'ajax.php?page=contactAjax');
                    xhr.send();
                });
            });
        </script>
    </head>

    <body>
        <header>
            <?php
            include('header.php');
            ?>
        </header>

        <div id="vue">
            <?php
            //print_r($_GET);
            $page = NULL;
            if (isset($_GET['page'])) {
                $page = 'view/' . $_GET['page'] . '.php';
            }

            if (!file_exists($page)) {
                $page = 'view/home.php';
            }
            include($page);
            ?>
        </div>

        <footer>
            <?php
            include('footer.php');
            ?>
        </footer>

    </body>
</html>
<?php closeDB_PDO(); ?>
