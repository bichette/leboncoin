<?php

if (isset($_GET['logout'])) { /* si on avait mis  href="index.php?action=logout" */
    /* il aurait fallu tester if($_GET['action']=='logout') */
    unset($_SESSION);   /* toujours tester $_GET['logout'] en début de programme  */
    session_destroy();
    header('Location: index.php');
    exit();
    /* unset() détruit le contenu des variables de session dans la mémoie du serveur */
}
/* session_destroy() détruit le fichier session */
//par défaut on considère l'utilisateur non connecté

if (!isset($_SESSION['oUser'])) {
    $_SESSION['oUser'] = NULL;
}
print_r($_SESSION);

if (isset($_POST['loginForm'])) {
    $sEmailInput = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $sPasswordInput = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if ($sEmailInput && $sPasswordInput) {
        $oUser = $oUsersManager->getByEmailAndPassword($sEmailInput, $sPasswordInput);
        if ($oUser instanceof User) {
            $_SESSION['oUser'] = $oUser;
        }
    }
}

// Est-ce que le formulaire de dépôt d'annonce a été "soumis" ?
if (isset($_POST['depotAnnonceForm'])) {
    $sTitleInput = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $sDescriptionInput = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $dPriceInput = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

    $sImage = false;
    $aAllowedTypes = array('image/png', 'image/jpg', 'image/jpeg', 'image/gif');


    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK &&
            in_array($_FILES['image']['type'], $aAllowedTypes)) {
        $sImage = $_FILES['image']['tmp_name'];
        //echo 'extension correcte';
    }

    if ($sTitleInput && $sDescriptionInput && $dPriceInput && $sImage) {
        $oAnnonce = new Annonce();
        $oAnnonce->setIdUser($_SESSION['oUser']->getId());
        $oAnnonce->setTitle($sTitleInput);
        $oAnnonce->setDescription($sDescriptionInput);
        $oAnnonce->setPrice($dPriceInput);
        $oAnnonce->setCreatedDate(new DateTime('now'));
        $oAnnonce->setUpdatedDate(new DateTime('now'));
        echo 'id user : ' . $_SESSION['oUser']->getId();


        $oAnnManager->insert($oAnnonce);

        $sExtension = strstr($_FILES['image']['type'], "/");
        $sExtension = str_replace("/", ".", $sExtension);
        $sFileDest = 'image_annonce' . $oAnnonce->getId() . $sExtension;
        /* echo '';
          echo'nom annonce ds userfiles : ' . $sFileDest; */

        if (move_uploaded_file($sImage, 'userfiles/' . $sFileDest)) {
            $oAnnonce->setPicture($sFileDest);
            $oAnnManager->update($oAnnonce);
            echo 'update effectué';
        }
    }
}
// Est-ce que le formulaire de contact a été "soumis" ?
if (isset($_POST['contactForm'])) {
    $sNomInput = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
    $sPrenomInput = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
    $sAdresseInput = filter_input(INPUT_POST, 'adresse', FILTER_SANITIZE_STRING);
    $sTelInput = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_STRING);
    $eMailInput = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $sMessageInput = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    if ($sNomInput && $sPrenomInput && $sAdresseInput && $sTelInput && $eMailInput && $sMessageInput) {
        echo 'Envoi du message : ';
    }
}

if (isset($_GET['delete_ann'])) {
    $oAnnonce = new Annonce();
    $oAnnonce->setId($_GET['delete_ann']);
    $oAnnManager->delete($oAnnonce);
}
?>